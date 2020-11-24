<?php

use App\Models\User\Wallet;
use App\Models\User\WalletTransaction;
use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $wallet = Wallet::create([
            'owner_id' => 2,
            'money' => 0,
        ]);

        WalletTransaction::create([
            'wallet_id' => '1',
            'money_flow_type' => 'ADD',
            'money' => 100,
        ]);

        $wallet->money = 100;
        $wallet->save();
    }
}
