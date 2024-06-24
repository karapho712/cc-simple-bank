<?php
namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function deposit_index()
    {
        $latest = Transaction::where('user_id', auth()->user()->id)->latest()->first();

        return view('deposit.index', compact('latest'));
    }

    public function withdraw_index()
    {
        $latest = Transaction::where('user_id', auth()->user()->id)->latest()->first();

        return view('withdraw.index', compact('latest'));
    }
}
