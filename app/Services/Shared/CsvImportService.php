<?php

namespace App\Services\Shared;

use Illuminate\Http\UploadedFile;

class CsvImportService
{
    /**
     * Parse a CSV file and pass each row to a processor closure.
     *
     * @param UploadedFile $file The uploaded CSV file
     * @param \Closure $rowProcessor A closure that receives the CSV row (array) and returns true on success, false on skip, throws on fail.
     * @return array Returns an array with 'berhasil' (int), 'gagal' (int), and 'errors' (array of strings)
     */
    public function import(UploadedFile $file, \Closure $rowProcessor): array
    {
        $handle = fopen($file->getPathname(), 'r');

        // Skip header
        fgetcsv($handle);

        $berhasil = 0;
        $gagal = 0;
        $errors = [];
        $rowIndex = 2; // Starting from line 2 (line 1 is header)

        while (($row = fgetcsv($handle)) !== false) {
            if (empty(array_filter($row))) {
                $rowIndex++;
                continue;
            }

            try {
                // The processor should throw an exception if validation fails.
                $result = $rowProcessor($row);
                
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

        fclose($handle);

        return [
            'berhasil' => $berhasil,
            'gagal' => $gagal,
            'errors' => $errors
        ];
    }
}
