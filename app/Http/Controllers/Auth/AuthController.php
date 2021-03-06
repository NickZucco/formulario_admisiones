<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Configuracion as Configuracion;
use Illuminate\Http\Request;
use App\ActivationService as ActivationService;
use App\Pin as Pin;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $loginPath = '/'; // 
    protected $redirectTo = 'datos';
    protected $activationService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService) {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->activationService = $activationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'pin' => 'required|max:255',
					'document' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'g-recaptcha-response' => 'required',
        ]);
    }
	
	protected function authenticated($request, $user) {
		if (!$user->activated) {
			$this->activationService->sendActivationMail($user);
			auth()->logout();
			return back()->with('warning', 'Necesita confirmar su registro. Hemos enviado un código de activación a 
			su correo, por favor verifíquelo.');
		}
		else {
			if($user->isadmin) {
				return redirect('admin/candidatos');
			}
			else {
				$configuracion = Configuracion::where('llave', '=', 'limit_date')->first();
				$data = [];
				if (strtotime($configuracion['valor']) > time()) {
					return redirect('datos');
				} else {
					$data = array(
						'limit_date' => $configuracion['valor']
					);
					return view('auth/timeout', $data);
				}
			}
		}
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
		$pin = Pin::where('pin', '=', $data['pin'])->first();
        return User::create([
                    'name' => $pin->nombre,
					'lastname' => $pin->apellido,
					'document' => $pin->documento,
					'document_type' => $pin->tipos_documento_id,
					'program' => $pin->programa_posgrado_id,
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogout() {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }

    public function getLogin() {
        return view('auth/login');
    }

    public function register(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }
		$pin = Pin::where('pin', '=', $request['pin'])->first();
		if ($pin) {
			if ($pin->documento == $request['document']) {
				$user = $this->create($request->all());
				$this->activationService->sendActivationMail($user);
				return redirect('auth/login')->with('status', 'Hemos enviado el enlace de activación a su cuenta de correo. Por favor, verifíque su email.');
			}
			else {
				return redirect('auth/register')->with('warning', 'El documento de identidad ingresado no se encuentra registrado. Intente nuevamente.');
			}
		}
		else {
			return redirect('auth/register')->with('warning', 'El PIN ingresado no se encuentra registrado. Intente nuevamente.');
		}
    }

    public function activateUser($token) {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

}
