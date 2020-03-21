<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;

class ChangePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Where to redirect users after password is changed.
     *
     * @var string $redirectTo
     */
    protected $redirectTo = '/change_password';

     public function resetForm()
     {
         $user = Auth::getUser();

         return view('user.change_password', compact('user'));
     }

     public function changePassword(Request $request)
     {
        $user = Auth::getUser();
        $request->validate([
          'current_password' => 'required',
          'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
          'confirm_password' => 'min:6'
        ]);

        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = bcrypt($request->get('new_password'));
            $user->save();

            return redirect($this->redirectTo)->with('success', 'Password change successfully!');
        }
        else {
            return redirect($this->redirectTo)->withErrors('Current password is incorrect');
        }
     }
}
