<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Transaction extends Model
{
    protected $table = 'transactions';

    public $timestamps = true;

    protected $fillable = [
        'amount',
        'transaction_type',
        'user_id',
        'order_id',
        'status',
        'description',
    ];

    protected $hidden = ['created_at', 'updated_at', 'transaction_type', 'user_id', 'description'];

    protected function casts(): array
    {
        return [
            'transaction_date' => 'datetime',
        ];
    }

    public static function create_deposit($request)
    {
        DB::beginTransaction();
        try {
            $user = DB::table('users')
                ->where('id', '=', $request['user_id'])
                ->lockForUpdate()
                ->first();

            if (!$user) {
                throw ValidationException::withMessages(['user_id' => 'User not found.']);
            }

            $transaction = self::create($request);

            if ($transaction->status != 2) {
                DB::table('users')
                    ->where('id', '=', $request['user_id'])
                    ->update(['balance' => $user->balance + $transaction->amount]);
            }

            DB::commit();
            return $transaction;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public static function create_withdrawal($request)
    {
        DB::beginTransaction();
        try {
            $user = DB::table('users')
                ->where('id', '=', $request['user_id'])
                ->lockForUpdate()
                ->first();

            if (!$user) {
                throw ValidationException::withMessages(['user_id' => 'User not found.']);
            }

            $newBalance = $user->balance - $request['amount'];

            if ($newBalance < 0) {
                throw ValidationException::withMessages(['amount' => 'Insufficient balance for withdrawal.']);
            }

            $transaction = self::create($request);

            if ($transaction->status != 2) {
                DB::table('users')
                    ->where('id', '=', $request['user_id'])
                    ->update(['balance' => $newBalance]);
            }

            DB::commit();
            return $transaction;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
