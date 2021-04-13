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
                ["text" => ", pamietaj o wizycie w naszym salonie jutro o godzinie: "],
                [
                    "variable" => [
                        "model" => "work",
                        "name"=> "start_hour",
                    ],
                ],
            ]
        ]);

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
                ["text" => ", jutro o "],
                [
                    "variable" => [
                        "model" => "work",
                        "name"=> "start_hour",
                    ],
                ],
                ["text" => " masz wizyte w naszym salonie. Wrazie problemow prosimy o kontakt: "],
                [
                    "variable" => [
                        "model" => "user",
                        "name"=> "phone",
                    ],
                ],
            ]
        ]);

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
                ["text" => ", jutro o "],
                [
                    "variable" => [
                        "model" => "work",
                        "name"=> "start_hour",
                    ],
                ],
                ["text" => " masz wizyte w salonie "],
                [
                    "variable" => [
                        "model" => "user",
                        "name"=> "name",
                    ],
                ],
                ["text" => ". Wrazie problemow prosimy o kontakt: "],
                [
                    "variable" => [
                        "model" => "user",
                        "name"=> "phone",
                    ],
                ],
            ]
        ]);


    }
}
