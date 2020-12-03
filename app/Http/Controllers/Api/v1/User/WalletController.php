<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\WalletTransactionCollection;
use App\Models\User\Wallet;
use App\Models\User\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    use ApiCommunication;

    public function get(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $wallet = Wallet::where('owner_id', Auth::id())->first();
        $transactions = WalletTransaction::where('wallet_id', $wallet->id)->paginate($limit);
        return $this->sendResponse(new WalletTransactionCollection($transactions), 'User wallet transactions returned');
    }
}
