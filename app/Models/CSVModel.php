<?php
namespace Com\Daw2\Models;

class CSVModel{
    private $filename;
    
    public function __construct(string $filename){
        $this->filename = $filename;
    }
    
    public function getPoblacionPontevedra() : array{
        $csvFile = file($this->filename);
        $data = [];
        foreach ($csvFile as $line) {
            $data[] = str_getcsv($line, ';');
        }
        return $data;
    }
    
    public function insertRow(array $row) : bool{
        $resource = fopen($this->filename, 'a');
        $exito = fputcsv($resource, $row, ';');
        fclose($resource);
        return is_int($exito);
    }
}