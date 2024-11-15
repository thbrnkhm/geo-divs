<?php

namespace App\Imports;

use App\Models\Constituency;
use App\Models\District;
use App\Models\Station;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class FileUploadImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $currentConstituency = null;
        $currentDistrict = null;

        foreach ($collection as $index => $row) {
            // ski p header row
            if ($index === 0) {
                continue;
            }

            // Log::info('Processing row: ', ['row' => $row]);

            // handle consituency
            if (!empty($row[0]) && !empty($row[1])) {
                $currentConstituency = Constituency::firstOrCreate(
                    ['id' => $row[0]], // c_code
                    ['name' => $row[1]] // c_name
                );
            }

            // Skip rows with no valid constituency
            if (!$currentConstituency) {
                Log::warning('Row skipped due to missing constituency data', ['row' => $row]);
                continue;
            }

            // Handle District
            if (!empty($row[2]) && !empty($row[3])) {
                $currentDistrict = District::firstOrCreate(
                    ['id' => $row[2]], // pd_code
                    [
                        'name' => $row[3], // pd_name
                        'constituency_id' => $currentConstituency->id,
                    ]
                );
            }

            // Skip rows with no valid district
            if (!$currentDistrict) {
                Log::warning('Row skipped due to missing district data', ['row' => $row]);
                continue;
            }

            // Handle Station
            if (!empty($row[4]) && !empty($row[5])) {
                Station::firstOrCreate(
                    ['id' => $row[4]], // ps_code
                    [
                        'name' => $row[5], // ps_name
                        'district_id' => $currentDistrict->id,
                    ]
                );
            }
        }
    }
}
