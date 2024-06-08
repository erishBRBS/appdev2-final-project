<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    //--------------------------------------GET ALL USERS--------------------------------------//
    public function getAllUsers()
    {
        // Retrieve all users
        $users = UserAccount::all();
        // Return the users as a JSON response
        return response()->json(['users' => $users], 200);
    }
    //--------------------------------------GET ALL ORDERS--------------------------------------//
        public function getAllOrders()
        {
            // Retrieve all orders
            $orders = OrderList::all();
            // Return the users as a JSON response
            return response()->json(['orders' => $orders], 200);
        }
    //----------------------------GET ALL USERS ALONG WITH THEIR ORDERS---------------------------//
        public function getAllUsersWithOrders()
        {
            // Retrieve all users along with their orders
            $users = UserAccount::with('orders')->where('role_id', 1)->get();
    
            // Return the users with their orders as a JSON response
            return response()->json(['users' => $users], 200);
        }
}
