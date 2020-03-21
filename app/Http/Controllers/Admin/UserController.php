<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $users = User::orderBy('name', 'asc')
                ->when($request->query('name'), function($query) use ($request) {
                    return $query->where('name', 'like', '%'.$request->query('name').'%');
                })
                ->when($request->query('email'), function($query) use ($request) {
                    return $query->where('email', 'like','%'.$request->query('email').'%');
                })
                ->when($request->query('phone'), function($query) use ($request) {
                    return $query->where('phone', 'like','%'.$request->query('phone').'%');
                })
                ->paginate(10);

            return view('admin.users.index', [
                'users' => $users,
                'request' => $request,
            ]);
        } else {
            return redirect()->route('admin.home.index')->with('unauthorized','Unauthorized Action');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            $user = new User;

            return view('admin.users.create', [
                'user' => $user
            ]);

        } else {
            return redirect()->route('admin.home.index')->with('unauthorized','Unauthorized Action');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|numeric',
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6'
            ]);
    
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->save();
    
            return redirect()->route('admin.user.index');

        } else {
            return redirect()->route('admin.home.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('isAdmin')) {
            $user = User::find($id);
            if(!$user) throw new ModelNotFoundException;

            return view('admin.users.edit', [
                'user' => $user
            ]);
        } else {
            return redirect()->route('admin.home.index')->with('unauthorized','Unauthorized Action');
        }
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
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|numeric',
            ]);
    
            $user = User::find($id);
            if(!$user) throw new ModelNotFoundException;
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->save();
    
            return redirect()->route('admin.user.index');
        } else {
            return redirect()->route('admin.home.index');
        }
    }
}
