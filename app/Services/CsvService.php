<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Collection;

class CsvService
{
    /**
     * @throws Exception
     * @return Collection<string, string>
     */
    public function read(string $path): Collection
    {
        $stream = $this->openFile($path);
        $rows = [];
        $rowIdx = -1;
        $columns = [];

        while (($data = fgetcsv($stream, 1000, ',')) !== false) {
            $rowIdx++;
            if ($rowIdx === 0) {
                $columns = $data;
                continue;
            }

            $row = [];
            foreach ($data as $idx => $value) {
                $row[$columns[$idx]] = $value;
            }

            $rows[] = $row;
        }

        fclose($stream);
        return collect($rows);
    }

    /**
     * @throws Exception
     * @return resource
     */
    private function openFile(string $path)
    {
        $stream = fopen($path, 'r');
        if ($stream === false) {
            throw new Exception('Unable to open csv file at ' . $path);
        }

        return $stream;
    }
}
