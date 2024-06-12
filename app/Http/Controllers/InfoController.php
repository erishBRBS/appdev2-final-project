<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    //Get all users
    public function getAllUsers()
    {
        $users = UserAccount::all();
        return response()->json(['users' => $users], 200);
    }
    //Get all users with their orders
        public function getAllUsersWithOrders()
        {
            $users = UserAccount::with('orders')->where('role_id', 1)->get();
            return response()->json(['users' => $users], 200);
        }
}
