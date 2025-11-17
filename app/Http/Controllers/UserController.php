<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Create new user
    public function create (Request $request) {
        
        // Validating user entries
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string|max:30',
            'middlename' => 'nullable|string|max:30',
            'surname' => 'required|string|max:30',
            'email' => 'required|email',
            'password' => 'required|string|min:8|same:confirm|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/',
            'phone' => 'required|regex:/^0[789][01]\d{8}$/',
            'gender' => 'required|in:Male,Female,Others',
            'user_role' =>'required|in:admin,vendor,user',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Registration Failed',
            ], 400); 
        }

        return "Hello Ikorodu";
    }
}
