<?php
namespace App\Repositories;
/*
class JsonTaskRepo implements TasksRepository
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function save(): void {
        $records = json_decode(file_get_contents($this->fileName), true);;
        $records[] = $person->toArray();

        file_put_contents($this->fileName, json_encode($records));
    }


}