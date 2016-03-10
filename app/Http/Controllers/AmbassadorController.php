<?php

namespace App\Http\Controllers;
use App\Models\Hostel;
use App\Models\User;
use Sentinel;

class AmbassadorController extends Controller {

	public function index($name = null) {
		$user = Sentinel::getUser();
		$cities = Hostel::getHostels();
		if ($user) {
			$users = User::where('id', '!=', $user->id)->where('ambassador', '=', '1')->get();
		} else {
			$users = User::where('ambassador', '=', '1')->get();
		}
		$hostel = Hostel::getHostel($name);
		$city = "";
		if (isset($hostel[0]) && isset($hostel[0]->city)) {
			$city = $hostel[0]->city;
		}
		return view('Ambassador.index', ['users' => $users, 'cities' => $cities, 'cityDefault' => $city, 'name' => $name]);
	}
}
