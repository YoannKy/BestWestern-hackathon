<?php
/**
 * Created by PhpStorm.
 * User: alberish
 * Date: 10/03/16
 * Time: 10:50
 */

namespace App\Http\Controllers;

use App\Models\Hostel;

class HostelController extends Controller
{
    public function index() {
        $hostels = Hostel::all();
        return view('map', ['hostels' => $hostels, 'count' => 1]);
    }

}

