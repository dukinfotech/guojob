<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestRecharge;
use App\Models\User;
use Yajra\Datatables\Datatables;

class ChargeRequestController extends Controller
{
    public function index()
    {
        return view('charge_requests.index');
    }

    public function getChargeRequestData()
    {
        if (auth()->user()->isSupperAdmin()) {
            $datatable = Datatables::of(RequestRecharge::with(['user', 'payment']));
        } else {
            $childIds = User::where('parent_id', auth()->user()->id)->pluck('id')->toArray();
            $datatable = Datatables::of(RequestRecharge::where('isPaid', true)->whereIn('user_id', $childIds)->with(['user', 'payment']));
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
                '<form class="d-inline" method="post" action="/admin/charge-requests/'.$data->id.'" id="chargeProccessForm'.$data->id.'">
                    <input type="hidden" name="_token" value="'. csrf_token() .'" />
                    <input type="hidden" name="_method" value="put" />
                    <button type="button" class="btn btn-success" onclick="chargeProccess('.$data->id.')">Thanh toán</button>
                </form>';
            }
            $html .= '<form class="d-inline" method="post" action="/admin/charge-requests/'.$data->id.'" id="deleteChargeRequestForm'.$data->id.'">
                <input type="hidden" name="_token" value="'. csrf_token() .'" />
                <input type="hidden" name="_method" value="delete" />
                <button type="button" class="btn btn-danger" onclick="deleteChargeRequest('.$data->id.')">Xóa</button>
            </form>';

            return $html;
        })
        ->escapeColumns([])
        ->make(true);
    }

    public function delete($id)
    {
        $reqRecharge = RequestRecharge::findOrFail($id);
        if (!auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $reqRecharge->delete();

        return back();
    }

    public function chargeProccess($id)
    {
        $reqRecharge = RequestRecharge::findOrFail($id);
        $user = User::findOrFail($reqRecharge->user_id);

        if ($reqRecharge->isPaid || !auth()->user()->isSupperAdmin()) {
            abort(403);
        }

        $reqRecharge->isPaid = true;
        $user->balance = $user->balance + $reqRecharge->money;

        $reqRecharge->save();
        $user->save();

        return back();
    }
}
