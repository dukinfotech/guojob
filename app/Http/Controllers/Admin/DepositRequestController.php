<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestDeposit;
use App\Models\User;
use Yajra\Datatables\Datatables;

class DepositRequestController extends Controller
{
    public function index()
    {
        return view('deposit_requests.index');
    }

    public function getDepositRequestData()
    {
        if (auth()->user()->isSupperAdmin()) {
            $datatable = Datatables::of(RequestDeposit::with(['user', 'payment']));
        } else {
            $childIds = User::where('parent_id', auth()->user()->id)->pluck('id')->toArray();
            $datatable = Datatables::of(RequestDeposit::where('isPaid', true)->whereIn('user_id', $childIds)->with(['user', 'payment']));
        }

        return $datatable->addColumn('isPaid', function ($data) {
            return $data->isPaid ? '<div class="badge badge-success">Đã thanh toán</div>' : '<div class="badge badge-danger">Chưa thanh toán</div>';
        })
        ->addColumn('action', function ($data) {
            $html = '';

            if (! auth()->user()->isSupperAdmin()) {
                return $html;
            }

            if (! $data->isPaid) {
                $html .=
                '<form class="d-inline" method="post" action="/admin/deposit-requests/'.$data->id.'" id="depositProccessForm'.$data->id.'">
                    <input type="hidden" name="_token" value="'. csrf_token() .'" />
                    <input type="hidden" name="_method" value="put" />
                    <button type="button" class="btn btn-success" onclick="depositProccess('.$data->id.')">Thanh toán</button>
                </form>';
            }
            $html .= '<form class="d-inline" method="post" action="/admin/deposit-requests/'.$data->id.'" id="deleteDepositRequestForm'.$data->id.'">
                <input type="hidden" name="_token" value="'. csrf_token() .'" />
                <input type="hidden" name="_method" value="delete" />
                <button type="button" class="btn btn-danger" onclick="deleteDepositRequest('.$data->id.')">Xóa</button>
            </form>';

            return $html;
        })
        ->escapeColumns([])
        ->make(true);
    }

    public function depositProccess($id)
    {
        $reqDeposit = RequestDeposit::findOrFail($id);

        if ($reqDeposit->isPaid || !auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $reqDeposit = RequestDeposit::findOrFail($id);
        $reqDeposit->isPaid = true;
        $reqDeposit->save();

        return back();
    }

    public function delete($id)
    {
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $reqDeposit = RequestDeposit::findOrFail($id);
        $reqDeposit->delete();

        return back();
    }
}
