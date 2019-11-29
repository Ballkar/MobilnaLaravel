<?php

namespace App\Imports;

use App\Models\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CitiesImport implements ToCollection
{

    // 6 - data
    // 5 - administracyjnie
    // 4 - nazwa
    // 3 - rodzaj gminy
    // 2 - id_gminy
    // 1 - id_powiatu
    // 0 - id_woj
    public function collection(Collection $rows)
    {
        $voivodeship = '';
        $district = '';
        foreach ($rows as $index => $value)
        {

            if ($index > 0) {

                if($value[5] === 'województwo') {
                    $voivodeship = $value[4];
                    continue;
                };
                if($value[1] !== $rows[$index-1][1]) {
                    $district = null;
                };
                if($value[5] === 'powiat') {
                    $district = $value[4];
                    continue;
                };
                if($value[5] === 'delegatura') continue;
                if($value[3] === 8 || $value[3] === 9) continue;

                if( City::where('name',$value[4])->where('district', $district)->exists()) continue;

                City::create([
                    'name' => $value[4],
                    'voivodeship' => $voivodeship,
                    'district' => $district,
                ]);


            };
        }
    }
}
