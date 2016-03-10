<?php

namespace App\Http\Controllers;
use App\Models\Hostel;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;
use Sentinel;

class AmbassadorController extends Controller {

	/** @var Cartalyst\Sentinel\Users\IlluminateUserRepository */
	protected $userRepository;

	public function __construct() {
		// Dependency Injection
		$this->userRepository = app()->make('sentinel.users');
	}

	public function index() {
		$user = Sentinel::getUser();
		$cities = Hostel::getHostels();
		if ($user) {
			$users = $this->userRepository->createModel()->where('id', '!=', $user->id)->where('ambassador', '=', '1')->get();
		} else {
			$users = $this->userRepository->createModel()->where('ambassador', '=', '1')->get();
		}
		return view('Ambassador.index', ['users' => $users, 'cities' => $cities]);
	}
}
