<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index()
    {

        $products = Product::with("user")->get();
        return view('index', compact('products'));
    }
    public function becomeSeller(Request $request){
        $validated = $request->validate([
            "kkiapay_id" => "string|required|min:5"
        ]);
        Auth::user()->update([
            "kkipay_key" => $validated["kkiapay_id"],
            'role' => "seller"
        ]);
        return back();
    }
}
