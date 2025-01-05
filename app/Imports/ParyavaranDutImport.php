<?php

namespace App\Imports;

use App\Models\ContestentPd;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ParyavaranDutImport implements ToModel, WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


        /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ContestentPd::create([
            'user_id'=> Auth::user()->id,
            'name'=> $row[0],
            'age'=> $row[1],
            'gender'=> $row[2],
            'activity'=> $row[3],
            'attached_file'=> ''
        ]);
    }
}
