<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;

        if ($role === 'admin') {
            $transactions = Checkout::latest()
                ->when(request()->q, function ($query) {
                    $query->where('title', 'like', '%' . request()->q . '%');
                })
                ->paginate(10);
        } else {
            $transactions = Checkout::where('user_id', Auth::id())
                ->latest()
                ->when(request()->q, function ($query) {
                    $query->where('title', 'like', '%' . request()->q . '%');
                })
                ->paginate(10);
        }


        return view('admin.transaction.index', compact('transactions'));
    }
}
