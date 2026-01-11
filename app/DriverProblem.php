<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverProblem extends Model
{
    protected $fillable = [
        'driver_id',
        'vehicle_number', 
        'type',
        'severity',
        'description',
        'place',
        'occurrence_date',
        'cost',
        'status',
        'admin_note',
        'proof_image'
    ];

    protected $dates = [
        'occurrence_date',
        'created_at',
        'updated_at'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
