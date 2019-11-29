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
    // 3 - id_rodzica
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

                if($value[5] === 'województwo') $voivodeship = $value[4];
                elseif($value[5] === 'powiat') $district = $value[4];
                elseif($rows[$index-1][2] === $value[2] ) continue;
                else {
                    City::create([
                        'name' => $value[4],
                        'voivodeship' => $voivodeship,
                        'district' => $district,
                    ]);
                }

            };
        }
    }
}
