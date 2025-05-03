<?php

namespace App\Imports;

use App\Models\Admin\PinOffice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class officesImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    public function model(array $row)
    {

        return new PinOffice([
            'circle_name'    => $row['circlename'], 
            'region_name'    => $row['regionname'],
            'division_name'  => $row['divisionname'],
            'office_name'    => $row['officename'],
            'pin'        => $row['pincode'], 
            'office_type'    => $row['officetype'],
            'delivery'       => $row['delivery'],
            'district'       => $row['district'],
            'state'          => $row['statename'], 
            'latitude'       => is_numeric($row['latitude']) ? $row['latitude'] : 0000000,
            'longitude'      => is_numeric($row['longitude']) ? $row['longitude'] : 000000,
            'available'      => strtolower($row['available']) === 'yes' ? 1 : 0, 
        ]);
    }

    public function onFailure(Failure ...$failures)
    {
        dd('fail');
    }
}
