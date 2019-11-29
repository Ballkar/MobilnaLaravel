<?php

namespace App\Http\Controllers;

use App\Imports\CitiesImport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * @return Collection
     */
    public function importExportView()
    {
        return view('files.import');
    }

//    /**
//     * @return Excel|BinaryFileResponse
//     * @throws Exception
//     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
//     */
//    public function export()
//    {
//        return Excel::download(new Cities(), 'users.xlsx');
//    }

    /**
     * @return Collection
     */
    public function import()
    {
        Excel::import(new CitiesImport,request()->file('file'));

        return back();
    }
}
