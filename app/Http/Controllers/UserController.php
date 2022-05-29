<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function index(){
        $px=DB::getTablePrefix();
        $users = DB::select("select u.id,u.username,u.email,r.name role,u.photo,u.password from {$px}users u , {$px}roles r where r.id=u.role_id");
        // $user=new User();
        // $users=$user->get_users();
        return view("pages.user.manage_user",["users"=>$users]);
    }   

    public function create(){
        $px=DB::getTablePrefix();
        $roles = DB::select("select id,name from {$px}roles");       
        return view("pages.user.create_user",["roles"=>$roles]);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'cmbRole' => 'required',
            'txtUsername' => 'required|unique:users,username',
            'txtEmail' => 'required|unique:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user=new User;
        $user->role_id=$request->cmbRole;
        $user->username=$request->txtUsername;
        $user->email=$request->txtEmail;
        $user->password=md5($request->txtPassword);
        $user->save();
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $user->photo=$imageName;
                $user->update();
                $request->filePhoto->move(public_path('/img/user'),$imageName);
            }
        return back()->with('save_user','User Added successfully');

    }

    public function show($id)
    {
        $px=DB::getTablePrefix();
        $user = DB::select("select u.id,u.username,u.email,r.name role,u.photo from {$px}users u , {$px}roles r where r.id=u.role_id and u.id='$id'");
       
        return view("pages.user.details_user",["user"=>$user]);
    }

    public function edit($id){
        $roles = DB::select('select id,name from lc_roles');
        $user= DB::table("users")->where('id', $id)->first();
        return view("pages.user.edit_user",["user"=>$user,"roles"=>$roles]);
    }

    public function update($id,Request $request){
        $user=User::find($id);
        $user->role_id=$request->cmbRole;
        $user->username=$request->txtUsername;
        $user->email=$request->txtEmail;
        $user->password=md5($request->txtPassword);
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $user->photo=$imageName;
                
                $request->filePhoto->move(public_path('/img/user'),$imageName);
            }
        $user->update();
        return back()->with('update_user','User Updated successfully');
    }
    public function userDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $user = User::find($data['id']);
            if (!is_null($user)) {
                $user->delete();
            }
            return response()->json([
                'success' => true
            ]);
        }

    }
    public function destroy($id){

    }

    

}