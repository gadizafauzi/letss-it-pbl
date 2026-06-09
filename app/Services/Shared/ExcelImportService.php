<?php

namespace App\Services\Shared;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelImportService
{
    /**
     * Parse an Excel file and pass each row to a processor closure.
     *
     * @param UploadedFile $file The uploaded Excel file
     * @param \Closure $rowProcessor A closure that receives the Excel row (array) and returns true on success, false on skip, throws on fail.
     * @return array Returns an array with 'berhasil' (int), 'gagal' (int), and 'errors' (array of strings)
     */
    public function import(UploadedFile $file, \Closure $rowProcessor): array
    {
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        
        $berhasil = 0;
        $gagal = 0;
        $errors = [];
        $rowIndex = 1;

        foreach ($worksheet->getRowIterator() as $row) {
            // Skip header (row 1)
            if ($rowIndex === 1) {
                $rowIndex++;
                continue;
            }

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops through all cells, even if it is not set.

            $rowData = [];
            foreach ($cellIterator as $cell) {
                // If it's a date, format it as YYYY-MM-DD
                if (Date::isDateTime($cell)) {
                    $rowData[] = Date::excelToDateTimeObject($cell->getValue())->format('Y-m-d');
                } else {
                    $rowData[] = (string) $cell->getCalculatedValue();
                }
            }

            // Check if the row is entirely empty
            if (empty(array_filter($rowData, fn($value) => $value !== null && $value !== ''))) {
                $rowIndex++;
                continue;
            }

            try {
                // The processor should throw an exception if validation fails.
                $result = $rowProcessor($rowData);
                
                if ($result) {
                    $berhasil++;
                } else {
                    $gagal++;
                    $errors[] = "Baris $rowIndex dilewati.";
                }
            } catch (\Exception $e) {
                $gagal++;
                $errors[] = "Baris $rowIndex gagal: " . $e->getMessage();
            }

            $rowIndex++;
        }

        return [
            'berhasil' => $berhasil,
            'gagal' => $gagal,
            'errors' => $errors
        ];
    }
}
