<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Hostel extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hostels';


    public static function getHostels() {
        return Hostel::select('city')->distinct()->get();
    }
}
