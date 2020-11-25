<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WalletTransactionRequest;
use App\Models\User\User;
use App\Models\User\WalletTransaction;

class WalletTransactionController extends Controller
{
    use ApiCommunication;

    public function add(WalletTransactionRequest $request)
    {
        $this->authorize('create', WalletTransaction::class);

        $user = User::find($request->get('user_id'));
        $transaction = WalletTransaction::create([
            'money_flow_type' => $request->get('money_flow_type'),
            'money' => $request->get('money'),
            'wallet_id' => $user->wallet->id,
        ]);

        return $this->sendResponse($transaction, 'User returned');
    }

}
