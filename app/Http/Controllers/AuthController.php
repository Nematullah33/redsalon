<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    
    public function auth(Request $f){

            $px=DB::getTablePrefix();
            $username=$f->input("txtUsername");
            $password=md5($f->input("txtPassword")); 
            $u = DB::select("select u.id,u.username,u.email,u.role_id,r.name role_name,u.photo from {$px}users u, {$px}roles r where r.id=u.role_id and (username='$username' or email='$username') and password='$password'");

            if(count($u)==1){
                $session_id=session()->getId();
                session(['sess_id'=>$session_id,
                        'sess_user_id'=>$u[0]->id,
                        'sess_user_name'=>$u[0]->username,
                        'sess_email'=>$u[0]->email,
                        'sess_role_id'=>$u[0]->role_id,
                        'sess_role_name'=>$u[0]->role_name,
                        'sess_img_photo'=>$u[0]->photo
                ]);

                return Redirect::route('home');
            }else{
                return back()->with('warning','Username or Password Invalid !');
                //return Redirect::route('/');
            }

    }

    
     public function logout(){
        session()->forget(['sess_id','sess_user_id','sess_user_name','sess_email','sess_role_id','sess_role_name','sess_img_photo']);
        session()->flush();
        session()->regenerate();
        return redirect("/");
    } 


    // change password
    public function changePassword(Request $request) {
        
        if($request->isMethod('post')){

            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required',
                'password_confirmation' => 'required|same:new_password',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (!empty(session('sess_user_id'))) {
                $user_id = session('sess_user_id');
            }

            $user = User::where('id', $user_id)->first();

            if (md5($data['current_password']) != $user->password) {
                return back()->with('error_message', 'Current password does not match!');
            }

            $user->password = md5($data['new_password']);
            $user->update();

            return back()->with('message', 'Password changed successfully');
        }
        return view("pages.user.changepassword");
    }


}
