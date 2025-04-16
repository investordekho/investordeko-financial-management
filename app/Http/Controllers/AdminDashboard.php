<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminDashboard extends Controller
{
    public function callAdminDashboard()
    {
        // $employeedata= DB::('users')->where(id,(DB:table(users_role)->role_id,2)->get());
        // $employeedata= User::whereHas('role_id',2)->get();

            
        // $employeedata = DB::table('users')
        // ->join('user_roles', 'users.id','=','user_roles.user_id')
        // ->where('user_roles.role_id',2)
        // ->select('users.*')
        // ->get();

        $employeedata = User::whereHas('roles',fn($data)=>$data->where('role_id',2))->get();
        
        return view('dashboards.admindashboard',compact('employeedata'));
    }
}
