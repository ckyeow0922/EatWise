<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BMIRecord extends Model
{
    //
    use HasFactory;

    protected $table = 'bmi_records';
    // Mass assignable fields
    protected $fillable = [
        'bmi_id',
        'BMI',
        'token'
    ];

    /**
     * Define the relationship with the BMI model.
     */
    public function bmi()
    {
        return $this->belongsTo(BMI::class, 'bmi_id');
    }
}
