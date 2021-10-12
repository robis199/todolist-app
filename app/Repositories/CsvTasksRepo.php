<?php

namespace App\Repositories;

use App\Models\Collections\TasksCollection;
use App\Models\Task;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;


class CsvTasksRepo implements TasksRepository
{

    private Reader $reader;

    public function __construct()
    {
        $this->reader = Reader::createFromPath(base_path() .'/storage/todo.csv');
        $this->reader->setDelimiter(';');

    }

    public function getAll(): TasksCollection
    {
        $collection = new TasksCollection();
        $statement = Statement::create();



        foreach ($statement->process($this->reader) as $record)
        {
            $collection->add(new Task(
                $record[0],
                $record[1],
                $record[2],

            ));
        }

            return $collection;
    }

    public function save(Task $task): void
    {

        $writer = Writer::createFromPath(base_path() . '/storage/todo.csv', 'a+');
        $writer->setDelimiter(';');
        $writer->insertOne($task->toArray());

    }

    public function getOne(string $id): ?Task
    {
        $statement = Statement::create()
            ->where(function ($record) use ($id)
            {
                return $record[0] === $id;
            })


        ->limit(1);


       $record = $statement->process($this->reader)->fetchOne();


       if(empty($record)) return null;

       return new Task(
           $record[0],
           $record[1],
           $record[2],
       );
    }


    public function delete(Task $task): void
    {
        $tasks = $this->getAll()->getTasks();

        unset($tasks[$task->getId()]);

        $records = [];

        foreach ($tasks as $task)
        {
            /** @var Task $task */
            $records[] = $task->toArray();
        }


        $writer = Writer::createFromPath(base_path() . '/storage/todo.csv', 'a+');
        $writer->setDelimiter(';');
        $writer->insertAll($records);

    }
}