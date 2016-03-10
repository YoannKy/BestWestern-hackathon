<?php

namespace App\Http\Controllers\Auth;


use Sentinel;
use TBMsg;
use Session;
use App\Http\Controllers\Controller;
use Centaur\AuthManager;
use Illuminate\Http\Request;

class SessionController extends Controller {
	/** @var Centaur\AuthManager */
	protected $authManager;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(AuthManager $authManager) {
		$this->middleware('sentinel.guest', ['except' => 'getLogout']);
		$this->authManager = $authManager;
	}

	/**
	 * Show the Login Form
	 * @return View
	 */
	public function getLogin() {
		return view('Centaur::auth.login');
	}

	/**
	 * Handle a Login Request
	 * @return Response|Redirect
	 */
	public function postLoginProspect(Request $request) {
		// Validate the Form Data
		$result = $this->validate($request, [
			'email' => 'required|email',
			'pseudo' => 'required',
			'password' => 'required',
		]);

		// Assemble Login Credentials
		$credentials = [
			'pseudo' => trim($request->get('pseudo')),
			'email' => trim($request->get('email')),
			'password' => $request->get('password'),
		];
		$remember = (bool) $request->get('remember', false);

		// Attempt the Login
		$result = $this->authManager->authenticate($credentials, $remember);
		if (Sentinel::getUSer()) {
			$path = session()->pull('url.intended', route('ambassadors'));
		} else {
			$path = session()->pull('url.intended', route('dashboard'));
		}
		// Return the appropriate response
		return $result->dispatch($path);
	}

	public function postLogin(Request $request) {
		// Validate the Form Data
		$result = $this->validate($request, [
			'email' => 'required',
			'password' => 'required',
		]);

		// Assemble Login Credentials
		$credentials = [
			'email' => trim($request->get('email')),
			'password' => $request->get('password'),
		];
		$remember = (bool) $request->get('remember', false);

		$result = $this->authManager->authenticate($credentials, $remember);

		// Attempt the Login
		$path = session()->pull('url.intended', route('dashboard'));
		// Return the appropriate response
        $id = Sentinel::getUser()->id;
        $conv = TBMsg::getNumOfUnreadMsgs($id);
        Session::put('conv', $conv);
        $path = session()->pull('url.intended', route('dashboard',array('conv'=>$conv)));
        return $result->dispatch($path);
    }

	/**
	 * Handle a Logout Request
	 * @return Response|Redirect
	 */
	public function getLogout(Request $request) {
		// Terminate the user's current session.  Passing true as the
		// second parameter kills all of the user's active sessions.
		$result = $this->authManager->logout(null, null);

		// Return the appropriate response
		return $result->dispatch(route('dashboard'));
	}
}
