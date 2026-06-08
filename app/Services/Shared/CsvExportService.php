<?php

namespace App\Services\Shared;

use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvExportService
{
    /**
     * Export a collection of data to CSV.
     *
     * @param iterable $data The data collection to iterate over
     * @param array $headers Array of header strings
     * @param \Closure $rowMapper A closure that takes a single data item and returns an array corresponding to headers
     * @param string $filename The desired download filename
     * @return StreamedResponse
     */
    public function export(iterable $data, array $headers, \Closure $rowMapper, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($data, $headers, $rowMapper) {
            $file = fopen('php://output', 'w');

            // BOM for UTF-8 Excel support
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Write Headers
            fputcsv($file, $headers);

            // Write Data
            foreach ($data as $item) {
                fputcsv($file, $rowMapper($item));
            }

            fclose($file);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ]);
    }
    
    /**
     * Download a CSV template.
     */
    public function downloadTemplate(array $headers, array $sampleData, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($headers, $sampleData) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $headers);
            fputcsv($file, $sampleData);
            fclose($file);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
