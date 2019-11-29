<?php

namespace App\Imports;

use App\Models\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CitiesImport implements ToCollection
{

    // 0 - województwo
    // 1 - powiat
    // 2 - gmina
    // 3 - rodzic
    // 4 - nazwa
    // 5 - opis co to
    // 6 - data
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $value)
        {

            if ($index > -1) {
                dump([$index, $value]);
            };

            if($index > 3) die();
//            City::create([
//                'name' => $value[0],
//            ]);
        }
    }
}
