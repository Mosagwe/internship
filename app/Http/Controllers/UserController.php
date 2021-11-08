<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(User $user)
    {
        $this->user=$user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }
    public function getAll()
    {

        $users=User::latest()->with('station')->get();
        $users->transform(function ($user){
            $user->role=$user->getRoleNames()->first();
            $user->userPermissions=$user->getPermissionNames();
            return $user;
        });

        return response()->json(['users'=>$users],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string',
            'phone'=>'required',
            'password'=>'required|alpha_num|min:6',
            'role'=>'required',
            'email'=>'required|email|unique:users',
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->station_id=$request->station_id;
        $user->password=bcrypt($request->password);

        $user->assignRole($request->role);
        /*if ($request->has('permissions'))
        {
            $user->givePermissionTo($request->permissions);
        }*/
        $user->save();

        return response()->json('Created Successfully',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|string',
            'phone'=>'required',
            'password'=>'nullable|alpha_num|min:6',
            'role'=>'required',
            'email'=>'required|email|unique:users,email,'.$id
        ]);
        $user=User::findOrFail($id);

        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->station_id=$request->station_id;

        if ($request->has('password')){
            $user->password=bcrypt($request->password);
        }

        if ($request->has('role')){
            $userRole=$user->getRoleNames();
            foreach ($userRole as $role){
                $user->removeRole($role);
            }
            $user->assignRole($request->role);
        }

        $user->save();

        return response()->json('User Updated successfully',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return response()->json('User deleted!',200);
    }
    public function search(Request $request)
    {
        $searchWord=$request->get('s');
        $users=User::where(function ($query) use ($searchWord){
            $query->where('name','LIKE',"%$searchWord%")
                ->orWhere('email','LIKE',"%$searchWord%");
        })->latest()->get();

        $users->transform(function ($user){
            $user->role=$user->getRoleNames()->first();
            $user->userPermissions=$user->getPermissionNames();
            return $user;
        });

        return response()->json([
            'users'=>$users
        ],200);

    }
}
