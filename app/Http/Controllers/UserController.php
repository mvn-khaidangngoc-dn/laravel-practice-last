<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile')->get();
        // dd($users);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        // dd($request->all());
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        if($request->hasFile('avatar')){
            $file = $request->get('avatar');
            $image = Carbon::now(). $file->getClientOriginalName();
            $link = $file->move('public/images/',$image);
            $data['avatar'] = $link;
        };
        $user = User::create($data);
        if($user){
            return redirect()->route('user.index')->with('success','Add New User Successfully!!');
        }else{
            return redirect()->route('user.index')->with('fails','Add New User Fail!!');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::where('user_id', $id)->with('users')->get();
        return view('users.show',compact('comments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $userDetail = User::where('id',$id)->with('profile')->first();
        // dd($userDetail);
        $users = User::where('id', $id)->with('comments','posts')->get();
        return view('users.detail',compact('users','userDetail'));
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
        //
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
}
