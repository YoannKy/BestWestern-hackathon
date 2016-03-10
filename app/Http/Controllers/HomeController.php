<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Users\IlluminateUserRepository;
use TBMsg;

class HomeController extends Controller {

/** @var Cartalyst\Sentinel\Users\IlluminateUserRepository */
	protected $userRepository;

	public function __construct() {
		// Dependency Injection
		$this->userRepository = app()->make('sentinel.users');
	}

	public function index() {
		$numberOfMessages = 0;
		$ambassadors = $this->userRepository->where('ambassador', 1)->get();
		foreach ($ambassadors as $ambassador) {
			$convs = TBMsg::getUserConversations($ambassador->id);
			if (count($convs) > 0) {
				foreach ($convs as $conv) {
					$numberOfMessages += count($conv->getAllMessages());
				}
			}
		}
		return view('centaur.dashboard', ['count' => $numberOfMessages]);
	}

}
