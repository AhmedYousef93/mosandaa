<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\DataTables\OrganizationDataTable;
use App\DataTables\RequestsDataTable;
use App\DataTables\SellerDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUser;
use App\Http\Requests\Admin\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('users',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(UserDataTable $users)
    {
        return $users->render('admin.users.index');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

}
