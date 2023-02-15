<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpSupportMessage extends Model
{
    use HasFactory;

    protected $table ='help_support_messages';

    protected $guarded = ['id'];
}
