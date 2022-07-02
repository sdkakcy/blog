<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view user'), 403);

        $users = User::all();

        return view('panel.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create user'), 403);

        $permissions = Permission::all()->pluck('name');

        return view('panel.user.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create user'), 403);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'permission' => 'nullable|array',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->givePermissionTo($request->permission);

            return redirect()->route('panel.users.index')->with([
                'status' => [
                    'success' => true,
                    'message' => __('Kullanıcı eklendi')
                ]
            ]);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return redirect()->back()->with(['status' => $result])->withInput();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('update user'), 403);

        $permissions = Permission::all()->pluck('name');

        return view('panel.user.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_if(!auth()->user()->can('update user'), 403);

        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'permission' => 'nullable|array',
            'password' => 'nullable|min:6|confirmed',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->update();

            $user->syncPermissions($request->permission);

            return redirect()->back()->with([
                'status' => [
                    'success' => true,
                    'message' => __('Kullanıcı güncellendi')
                ]
            ]);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return redirect()->back()->with(['status' => $result])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(!auth()->user()->can('delete user'), 403);

        if (auth()->user()->id === $user->id) {
            return redirect()->back()->with([
                'status' => [
                    'success' => false,
                    'message' => __('Kendinizi silemezsiniz')
                ]
            ]);
        }

        try {
            $user->delete();

            return redirect()->back()->with([
                'status' => [
                    'success' => true,
                    'message' => __('Kullanıcı silindi')
                ]
            ]);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return redirect()->back()->with(['status' => $result])->withInput();
        }
    }
}
