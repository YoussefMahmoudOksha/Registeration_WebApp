<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reguser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;



class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'fullname' => 'required',
                'username' => 'required|unique:regusers',
                'birthdate' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required',
                'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$/',
                //'image' => 'mimes:png,jpeg,jpg|max:2048',
            ]);

            Log::debug('after validate: ');

            $filePath = public_path('uploads');
            $insert = new reguser();
            $insert->fullname = $request->fullname;
            $insert->username = $request->username;
            $insert->birthdate = $request->birthdate;
            $insert->phone = $request->phone;
            $insert->address = $request->address;
            $insert->email = $request->email;
            $insert->password = bcrypt($request->password); // Encryption

            Log::debug('before if: ');
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $file_name = time() . $file->getClientOriginalName();

                if ($file->isValid()) {
                    Log::debug('No Error Image: ');
                    $file_name = time() . $file->getClientOriginalName();
                    $file->move($filePath, $file_name);
                    $insert->image = $file_name;
                } else {
                    Log::debug('Error uploading file: ' . $file->getErrorMessage());
                }
            }


            Log::debug('Debug message from UserController: ' . $insert->fullname);
            Log::debug('Debug message from UserController: ' . $insert->username);
            Log::debug('Debug message from UserController: ' . $insert->birthdate);
            Log::debug('Debug message from UserController: ' . $insert->phone);
            Log::debug('Debug message from UserController: ' . $insert->address);
            Log::debug('Debug message from UserController: ' . $insert->email);
            Log::debug('Debug message from UserController: ' . $insert->password);
            Log::debug('Debug message from UserController image: ' . $insert->image);



            $insert->save();
            Session::flash('success', 'User registered successfully');

            try {
                // Pass the new user to the MailController
                $mailController = new MailController();
                $mailController->sendEmail($insert);
                // return response()->json(['message' => 'Great! Please check your email for verification.']);
            } catch (\Exception $e) {
                // Log or handle the error
                return response()->json(['error' => 'Failed to create MailController instance: ' . $e->getMessage()]);
            }



        }catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessage = reset($errors)[0]; // Get the first error message
            Session::flash('error', $errorMessage);
            Log::debug('Validation error: ' . $errorMessage);
        }

        return redirect()->back()->withInput();

    }

}
