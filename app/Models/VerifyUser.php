<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'verify_users';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
