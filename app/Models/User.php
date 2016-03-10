<?php
/**
 * Created by PhpStorm.
 * User: alberish
 * Date: 10/03/16
 * Time: 18:13
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function hostels() {
        return $this->belongsToMany('App\Models\Hostel', 'user_hostel', 'user_id', 'hostel_id');
    }

    public static function getUsers() {
        return Hostel::all();
    }

}