<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'nid_number',
        'nid_img',
        'license_number',
        'driving_license_img',
        'license_expiration_date',
        'dob',
        'experience',
        'blood_group',
        'city',
        'district',
        'address',
        'image',
        'status'
    ];
}
