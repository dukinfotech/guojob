<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserData()
    {
        if (auth()->user()->isSupperAdmin()) {
            $datatable = Datatables::of(User::query());
        } else {
            $datatable = Datatables::of(User::where('parent_id', auth()->user()->id));
        }
        return $datatable->addColumn('action', function ($data) {
                            return '<a href="/admin/users/'.$data->id.'" class="btn btn-warning">Sửa</a>';
                        })
                        ->make(true);
    }

    public function showEdit($id)
    {
        $user = User::findOrFail($id);
        if (!auth()->user()->isSupperAdmin()) {
            if ($user->parent_id !== auth()->user()->id) {
                abort(403);
            }
        }

        return view('users.edit')->with('user', $user);
    }

    public function update(UserRequest $userReq, $id)
    {
        $validatedData = $userReq->validated();
        $user = User::findOrFail($id);
        if (!auth()->user()->isSupperAdmin()) {
            if ($user->parent_id !== auth()->user()->id) {
                abort(403);
            }
        }
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->phone = $validatedData['phone'];
        $user->balance = $validatedData['balance'];
        $user->role = $validatedData['role'];

        if ($validatedData['password']) {
            $user->password = password_hash($validatedData['password'], PASSWORD_DEFAULT);
        }

        if ($validatedData['passcode']) {
            $user->passcode = password_hash($validatedData['passcode'], PASSWORD_DEFAULT);
        }

        $user->save();

        return back()->with('success', true);
    }
}
