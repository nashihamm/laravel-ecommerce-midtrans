<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access your dashboard.');
        }

        $products = Product::all();

        return view('customer.index', compact('user', 'products'));
    }

    public function showProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access your profile.');
        }

        $orders = $user->orders; 
        $products = Product::all();

        return view('customer.profile.index', compact('user', 'orders', 'products'));
    }
}
