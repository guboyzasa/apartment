<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_super_admin', 0)->get();
        $companies = Company::all();
        return view('admins.users.index', compact('users', 'companies'));
    }

    public function list(Request $req)
    {
        $data = User::query()->with('company')->orderBy('id', 'asc')->where('is_super_admin', 0);

        if (isset($req->search_company)) {
            $data->where('company_id', $req->search_company);
        }

        if (isset($req->search_user)) {
            $data->where('id', $req->search_user);
        }

        return datatables()->of($data)->toJson();
    }

    public function store(Request $req)
    {
    }

    public function destroy(Request $req)
    {
    }

    public function setActive(Request $req)
    {

        $id = $req->id;

        DB::beginTransaction();

        $status = 0;
        $com = User::find($id);
        if ($com == null) {
            $data = [
                'title' => 'error!',
                'msg' => 'not found company',
                'status' => 'error',
            ];

            return $data;
        }
        $oldStatus = $com->is_active;

        if ($oldStatus == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $com->is_active = $status;
        $com->save();

        DB::commit();

        $data = [
            'title' => 'success!',
            'msg' => 'chage status success',
            'status' => 'success',
        ];

        return $data;
    }
}
