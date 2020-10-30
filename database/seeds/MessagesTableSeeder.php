<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Message\MessageSchema;
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
        MessageSchema::create([
            'owner_id' => '2',
            'name' => 'Przywitanie',
            'text' => 'Hejo',
        ]);
        MessageSchema::create([
            'owner_id' => '2',
            'name' => 'Odmowa wiyzty',
            'text' => 'sory no nie dam rady dziś',
        ]);
        Message::create([
            'owner_id' => '2',
            'schema_id' => '2',
            'customer_id' => '1',
            'name' => 'Odmowa wiyzty',
            'text' => 'sory no nie dam rady dziś',
        ]);
        Message::create([
            'owner_id' => '2',
            'schema_id' => '2',
            'customer_id' => '2',
            'name' => 'Odmowa wiyzty',
            'text' => 'sory no nie dam rady dziś',
        ]);
    }
}
