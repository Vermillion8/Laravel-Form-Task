<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests;

class FormController extends Controller
{
  public function index()
  {
    return view('form');
  }

  public function show(Request $request)
  {
    $request->validate([
      'floating_email' => 'required|email',
      'floating_password' => [
        'required', Password::min(8)
          ->letters()
          ->mixedCase()
          ->numbers()
          ->symbols()
          ->uncompromised(),
      ],
      'floating_repeat_password' => 'required|same:floating_password',
      'floating_first_name' => 'required',
      'floating_last_name' => 'required',
      'floating_age' => 'required|numeric|between:2.50,99.99',
      'floating_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $request->floating_image->storeAs('public/images', $request->floating_image->getClientOriginalName());

    $submissions = [
      'Email' => $request->floating_email,
      'Password' => $request->floating_password,
      'First Name' => $request->floating_first_name,
      'Last Name' => $request->floating_last_name,
      'Age' => $request->floating_age,
      'Image' => $request->floating_image->getClientOriginalName(),
    ];

    return redirect('/submission')->with(['submissions' => $submissions, 'status' => 'success']);
  }

  public function submission()
  {
    $submissions = session()->get('submissions');

    return view ('submission', ['submissions' => $submissions]);
  }
}
