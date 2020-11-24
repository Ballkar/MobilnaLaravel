<?php

use App\Http\Controllers\Api\v1\Message\PlansController;
use App\Models\Message\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Message\Schema;
use App\Models\Message\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::create([
            'owner_id' => '2',
            'name' => 'Przywitanie',
            'body' => [
                [
                    'text' => "Hejo"
                ]
            ],
            'clear_diacritics' => true,
        ]);
        Schema::create([
            'owner_id' => '2',
            'name' => 'Przypomnienie',
            'body' => [
                [
                    'text' => "Witam, zapraszam na wizytę",
                ]
            ],
            'clear_diacritics' => true,
        ]);
        Schema::create([
            'owner_id' => '2',
            'name' => 'Odmowa wiyzty',
            'body' => [
                [
                    'text' => "Sory, "
                ],
                [
                    "model" => "customer",
                    "variable" => "name",
                ],
                [
                    "text" => " nie dam dziś rady"
                ]
            ],
            'clear_diacritics' => false,
        ]);
        Message::create([
            'owner_id' => '2',
            'customer_id' => '1',
            'name' => 'Odmowa wiyzty',
            'text' => 'sory no nie dam rady dziś',
        ]);
        Message::create([
            'owner_id' => '2',
            'customer_id' => '2',
            'name' => 'Odmowa wiyzty',
            'text' => 'sory no nie dam rady dziś',
        ]);

        Plan::create([
            'owner_id' => 2,
            'schema_id' => 2,
            'hour' => 9,
            'minute' => 0,
            'time_type' => PlansController::$time_type_same_day,
            'active' => true
        ]);
    }
}
