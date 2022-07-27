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
        return $datatable->addColumn('active', function ($data) {
                            switch ($data->active) {
                                case -1:
                                    return '<div class="badge badge-danger">Khóa vĩnh viễn</div>';
                                    break;
                                case 0:
                                    return '<div class="badge badge-danger">Khóa tạm thời</div>';
                                    break;
                                default:
                                    return '<div class="badge badge-success">Kích hoạt</div>';
                                    break;
                            }
                        })
                        ->addColumn('action', function ($data) {
                            return '<a href="/admin/users/'.$data->id.'" class="btn btn-warning">Sửa</a>
                            <form class="d-inline" method="post" action="/admin/users/'.$data->id.'" id="deleteUserForm'.$data->id.'">
                                <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                <input type="hidden" name="_method" value="delete" />
                                <button type="button" class="btn btn-danger" onclick="deleteUser('.$data->id.')">Xóa</button>
                            </form>';
                        })
                        ->escapeColumns([])
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

    public function update(Request $userReq, $id)
    {
        $validatedData = $userReq->all();
        $user = User::findOrFail($id);
        if (!auth()->user()->isSupperAdmin()) {
            if ($user->parent_id !== auth()->user()->id) {
                abort(403);
            }
        }
        $user->name = $validatedData['name'];
        $user->phone = $validatedData['phone'];
        $user->level = $validatedData['level'];
        $user->commission = $validatedData['commission'];
        $user->active = $validatedData['active'];
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

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if (!auth()->user()->isSupperAdmin()) {
            if ($user->parent_id !== auth()->user()->id) {
                abort(403);
            }
        }

        $user->delete();

        return back();
    }
}
