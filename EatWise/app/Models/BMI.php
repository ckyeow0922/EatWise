<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BMI extends Model
{
    //
    use HasFactory;

    protected $table = 'bmi';

    // Specify the fillable fields
    protected $fillable = [
        'user_id',
        'token'
    ];

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bmiRecords()
    {
        return $this->hasMany(BMIRecord::class, 'bmi_id');
    }
}
