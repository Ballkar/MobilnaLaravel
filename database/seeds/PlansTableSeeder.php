<?php

use App\Http\Controllers\Constants\PlanTypes;
use App\Models\Message\Plans\PlanSchema;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanSchema::create([
            'type' => PlanTypes::REMIND,
            'body' => [
                ["text" => "Witaj "],
                [
                    "variable" => [
                        "model" => "customer",
                        "name"=> "name",
                    ],
                ],
                ["text" => ", pamiętaj o wizycie w naszym salonie jutro o godzinie: "],
                [
                    "variable" => [
                        "model" => "work",
                        "name"=> "start_hour",
                    ],
                ],
            ]
        ]);


    }
}
