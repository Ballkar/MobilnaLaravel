<?php

use App\Models\Message\Plans\RemindPlanSchema;
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
        RemindPlanSchema::create([
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
