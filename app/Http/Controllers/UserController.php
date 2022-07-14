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
        $users = User::with('profile')->simplePaginate(6);
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

        dd($request->all());
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        if($request->hasFile('avatar')){
            $file= $request->file('avatar');
            $extention = $file->getClientOriginalExtension();
            $filename= time().'.'.$extention;
            $file-> move('public/image/', $filename);
            $link = 'public/image/';
            $data['avatar']= $link.$filename;
        }
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

    public function indexAjax(){
        return view('users.indexAjax');
    }

    public function getDataTable(Request $request){
        $sort = !empty($request['sort']) ? $request['sort'] : '';
        $sort_ID = !empty($request['sort_ID']) ? $request['sort_ID'] : '';
        if (!empty($sort_ID)) {
            $data = User::with('posts', 'comments','profile')->orderBy('id' , $sort_ID)->get();
        }elseif(!empty($sort)){
            $data = User::with('posts', 'comments','profile')->orderBy('name',$sort)->get();
        }else {
            $data = User::with('posts', 'comments','profile')->get();
        }
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function searchDataName(Request $request)
    {
        $name = $request->all();
        $user = User::with('posts', 'comments')->where('name', 'LIKE', "%{$name['name']}%")->get();
        return response()->json(['status' => true, 'data' => $user]);
    }

    public function searchDataPost(Request $request)
    {
        $users = User::with('posts', 'comments')->get();
        $data = [];
        $count = $request->all();
        foreach ($users as $user_key => $user_value) {
            if (count($user_value->posts) == $count['count']) {
                $data[$user_key] = $user_value;
            }
        }

        return response()->json(['status' => true, 'data' => $data]);
    }

    public function searchDataComment(Request $request)
    {
        $users = User::with('posts', 'comments')->get();
        $data = [];
        $count = $request->all();
        foreach ($users as $user_key => $user_value) {
            if (count($user_value->comments) == ($count['count'])) {
                $data[$user_key] = $user_value;
            }
        }
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function storeAjax(Request $request)
    {
        $action = $request->get('action');
        if($action == 'create'){
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            if($request->hasFile('avatar')){
                $file= $request->file('avatar');
                $extention = $file->getClientOriginalExtension();
                $filename= time().'.'.$extention;
                $file-> move('public/image/', $filename);
                $link = 'public/image/';
                $data['avatar']= $link.$filename;
            }
            $user = User::create($data);
            if($user){
                return json_encode('Add New User Successfully !!');
            }else {
                return json_encode('Add New User Failed !!');
            }
        }else{
            return false;
        }
    }

    public function deleteAjax(Request $request){
        $id = $request->get('id');
        $user = User::where('id',$id)->delete();
        if($user){
            return json_encode(['error' => 0,'message' =>'Delete User Successfully !!']);
        }else {
            return json_encode(['error' => 1,'message' =>'Delete User Failed !!']);
        }
    }

    public function getDataEdit(Request $request){
        $id = $request->get('id');
        // dd($id);
        $user = User::find($id);
        if($user){
            return json_encode($user);
        }else {
            return json_encode(['error' => 1,'data' =>'Get User Failed !!']);
        }
    }

    public function updateUser(Request $request){
        dd($request->all());
        $data = [
            'name'  => !empty($request->get('name_update')) ? $request->get('name_update') : '',
            'email'  => !empty($request->get('email_update')) ? $request->get('email_update') : '',
            'birthday'  => !empty($request->get('birthday_update')) ? $request->get('birthday_update') : '',
            'status'  => !empty($request->get('status_update')) ? $request->get('status_update') : 1,
            'avatar'  => !empty($request->get('avatar_update')) ? $request->get('avatar_update') : '',
        ];
        $id = $request->get('id_update');
        if($request->hasFile('avatar_update')){
            $file= $request->file('avatar_update');
            $extention = $file->getClientOriginalExtension();
            $filename= time().'.'.$extention;
            $file-> move('public/image/', $filename);
            $link = 'public/image/';
            $data['avatar']= $link.$filename;
        }
        $user = User::where('id',$id)->update($data);
        if($user){
            return json_encode(['error' => 0,'message' =>'Update User Successfully !!']);
        }else {
            return json_encode(['error' => 1,'message' =>'Update User Failed !!']);
        }
    }
}
