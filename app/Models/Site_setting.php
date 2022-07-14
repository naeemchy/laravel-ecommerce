<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site_setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_one',
        'email_two',
        'phone_one',
        'phone_two',
        'address_one',
        'address_two',
        'city',
        'country',
        'logo',
        'about',
    ];
}
