<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BMI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BMIController extends Controller
{
    //
    public function showBMIPage()
    {
        $getUser = new UserController();
        $user = $getUser->getUser();
        $userBMI = $this->getBMI(); // May be null at first

        // If $userBMI is null, use an empty collection.
        $bmiRecords = $userBMI ? $userBMI->bmiRecords : collect();

        // Convert the collection to JSON
        $bmiDataJson = $bmiRecords->map(function ($record) {
            return [
                'bmi'        => $record->BMI,
                'created_at' => $record->created_at->format('Y-m-d'),
            ];
        })->toJson();

        return view('user.bmi_tracker', [
            'user'        => $user,
            'BMIRecords'   => $userBMI ? $userBMI->bmiRecords : null,
            'bmiDataJson' => $bmiDataJson,
        ]);
    }


    public function getBMI()
    {
        $user = Auth::user();
        $userBMI = BMI::where('user_id', $user->id)->with('bmiRecords')->first();
        if (!$userBMI) {
            return null;
        }
        return $userBMI;
    }

    public function createBMI(Request $request)
    {
        //check whether the token match
        $user = Auth::user();
        if ($user->token === $request->token) {
            $existingBMI = BMI::where('user_id', $user->id)->first();
        } else {
            return redirect('/auth/login');
        }
        //check existing BMI
        if (!$existingBMI) {
            BMI::create([
                'user_id' => $user->id,
                'token' => Str::uuid()
            ]);
        }
        $validator = $this->validateBMI($request);
        //validation
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $bmi = $request->BMI; // Assuming $request->bmi contains the BMI value


        if ($bmi < 18.5) {
            $category = 'UNDERWEIGHT';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $category = 'NORMAL_WEIGHT';
        } elseif ($bmi >= 25 && $bmi < 30) {
            $category = 'OVERWEIGHT';
        } else {
            $category = 'OBESE';
        }
        try {
            $BMIRecordController = new BMIRecordController();
            $existingBMI = BMI::where('user_id', $user->id)->first();
            $BMIRecord = $BMIRecordController->store($existingBMI->id, $request->BMI, $request->height, $request->weight, $category);
            if ($BMIRecord['status']) {
                $data = [
                    'status' => true,
                    'message' => 'Your BMI Record has been stored successfully'
                ];
            }
        } catch (\Exception $e) {
            $data = [
                'status' => false,
                'message' => 'Your BMI Record has failed to be stored',
                'error' => $e->getMessage()
            ];
        }

        return $data;
    }

    private function validateBMI(Request $request)
    {
        $rules = [
            'BMI' => 'required|numeric|min:0',
        ];

        $messages = [
            'BMI.required' => 'BMI is required.',
            'BMI.numeric'  => 'BMI must be a numeric value.',
            'BMI.min'      => 'BMI must be at least 0.',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
