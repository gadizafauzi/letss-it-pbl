<?php

namespace App\Services\Shared;

use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ExcelExportService
{
    /**
     * Export a collection of data to Excel.
     *
     * @param iterable $data The data collection to iterate over
     * @param array $headers Array of header strings
     * @param \Closure $rowMapper A closure that takes a single data item and returns an array corresponding to headers
     * @param string $filename The desired download filename (should end with .xlsx)
     * @return StreamedResponse
     */
    public function export(iterable $data, array $headers, \Closure $rowMapper, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($data, $headers, $rowMapper) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Write Headers
            $col = 1;
            foreach ($headers as $header) {
                $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '1';
                $sheet->setCellValueExplicit($cellCoordinate, (string)$header, DataType::TYPE_STRING);
                $col++;
            }

            // Write Data
            $rowNum = 2;
            foreach ($data as $item) {
                $rowData = $rowMapper($item);
                $colNum = 1;
                foreach ($rowData as $cellValue) {
                    $cellCoordinate = Coordinate::stringFromColumnIndex($colNum) . $rowNum;
                    $sheet->setCellValueExplicit($cellCoordinate, (string)$cellValue, DataType::TYPE_STRING);
                    $colNum++;
                }
                $rowNum++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }
    
    /**
     * Download an Excel template.
     */
    public function downloadTemplate(array $headers, array $sampleData, string $filename): StreamedResponse
    {
        return response()->streamDownload(function () use ($headers, $sampleData) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Write Headers
            $col = 1;
            foreach ($headers as $header) {
                $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '1';
                $sheet->setCellValueExplicit($cellCoordinate, (string)$header, DataType::TYPE_STRING);
                $col++;
            }

            // Write Sample Data
            $colNum = 1;
            foreach ($sampleData as $cellValue) {
                $cellCoordinate = Coordinate::stringFromColumnIndex($colNum) . '2';
                $sheet->setCellValueExplicit($cellCoordinate, (string)$cellValue, DataType::TYPE_STRING);
                $colNum++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
