<?php

namespace App\Imports;

use App\Models\Dataset;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DatasetImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 1) {
                Dataset::insertOrIgnore([
                    'id_tweet' => $row[0],
                    'user' => $row[1],
                    'tweet' => $row[2],
                    'date' => $row[3],
                    'category' => $row[4],
                    'datatype' => $row[5],
                ]);
            }
        }
    }
}
