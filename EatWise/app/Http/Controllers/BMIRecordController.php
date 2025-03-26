<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BMIRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BMIRecordController extends Controller
{
    //
    public function store($bmi_id, $BMI, $height, $weight, $category)
    {
        try {
            BMIRecord::create([
                'bmi_id' => $bmi_id,
                'BMI' => $BMI,
                'height' => $height,
                'weight' => $weight,
                'category' => $category,
                'token' => Str::uuid()
            ]);

            $data = [
                'status' => true,
                'message' => 'BMI record have been stored'
            ];
        } catch (\Exception $e) {
            $data = [
                'status' => false,
                'message' => 'Failed to store BMI record',
                'error' => $e
            ];
        }
        return $data;
    }
}
