<?php

class CSVExporter
{
    private $fileName;

    public function export($list)
    {
        $this->fileName = "export-" . uniqid() . ".csv";
        $fp = fopen($this->fileName, 'w');
        foreach ($list as $fields) {
            if (is_object($fields)) {
                $fields = (array)$fields;
            }
            fputcsv($fp, $fields);
        }

        replace($this->fileName, "\"", "");
    }

    public function download()
    {
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=" . basename($this->fileName) . ";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($this->fileName));
        @readfile($this->fileName);
        exit(0);
    }

    public function deleteTmpCSV()
    {
        unlink($this->fileName);
    }
}
