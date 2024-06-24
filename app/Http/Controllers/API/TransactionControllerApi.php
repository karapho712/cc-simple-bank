<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use DB;
use Illuminate\Http\Request;

class TransactionControllerApi extends Controller
{

    private static function isMultipleOfFive(int $number): bool
    {
        return $number % 5 === 0;
    }

    public function history(Request $request)
    {
        $data = DB::table('transactions')->where('user_id', '=', $request->user_id);
        return dataTables()->of($data)
            ->editColumn('created_at', function ($item) {
                return date("d-m-Y H:i:s", strtotime($item->created_at));
            })
            ->editColumn('status', function ($item) {
                if ($item->status === "1") {
                    return 'Success';
                } else {
                    return 'Failed';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function deposit(TransactionRequest $request)
    {
        $validatedData = $request->all();
        $validatedData['transaction_type'] = 'deposit';

        $latest = Transaction::latest()->first();

        if ($latest && self::isMultipleOfFive($latest->id + 1)) {
            $validatedData['status'] = 2; //Failed transaction
            $validatedData['description'] = 'failed because id multiple of five';
            $transaction = Transaction::create_deposit($validatedData);
            return response()->json(['message' => 'failed because id multiple of five'], 422);
        } else {
            $validatedData['status'] = 1; //Success transaction
            $transaction = Transaction::create_deposit($validatedData);
            return response()->json($transaction, 201);
        }
    }

    public function withdrawal(TransactionRequest $request)
    {
        $validatedData = $request->all();
        $validatedData['transaction_type'] = 'withdrawal';

        $latest = Transaction::latest()->first();

        if ($latest && self::isMultipleOfFive($latest->id + 1)) {
            $validatedData['status'] = 2; //Failed transaction
            $validatedData['description'] = 'failed because id multiple of five';
            $transaction = Transaction::create_withdrawal($validatedData);
            return response()->json(['message' => 'failed because id multiple of five'], 422);
        } else {
            $validatedData['status'] = 1; //Success transaction
            $transaction = Transaction::create_withdrawal($validatedData);
            return response()->json($transaction, 201);
        }

        return response()->json($transaction, 201);
    }
}
