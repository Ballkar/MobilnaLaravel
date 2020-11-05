<?php

namespace App\Console\Commands\import;

use App\Imports\CitiesImport as CitiesImport;
use App\Models\City;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Locating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command locating cities form db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $cities = City::all();
        $bar = $this->output->createProgressBar(count($cities));
        $bar->start();

        $client = new  Client([
            'base_uri' => 'https://eu1.locationiq.com/v1/'
        ]);
        foreach (City::all() as $city){
            if($city->id < 1809) continue;
            $name = $city->name;
            $district = $city->district;
            $voivodeship = $city->voivodeship;
            $polishChars = array('ą','Ą', 'ć','Ć', 'ę','Ę', 'ł','Ł', 'ń','Ń', 'ó','Ó', 'ś', 'Ś', 'ż', 'Ż', 'ź', 'Ź');
            $replace     = array('a','A', 'c','C', 'e','E', 'l', 'L', 'n','N', 'o','O', 's', 'S', 'z', 'Z', 'z', 'Z');
            $name = str_replace($polishChars, $replace, $name);
            $district = str_replace($polishChars, $replace, $district);
            $voivodeship = str_replace($polishChars, $replace, $voivodeship);
//            dump($name.', '.$district.', '.$voivodeship);
            $res = $client->request('GET', 'search.php?key='.env('LOCATIONIQ_KEY').'&format=json&q='.$name.', '.$district.', '.$voivodeship);
            $body = json_decode($res->getBody()->getContents())[0];
            $city->update([
                'lat' => $body->lat,
                'lon' => $body->lon,
            ]);
            sleep(1);
            $bar->advance();
        }
        $bar->finish();
    }
}
