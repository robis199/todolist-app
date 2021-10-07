<?php

namespace App\Controllers;


use App\Models\Task;
use App\Repositories\TasksRepository;
use App\Repositories\CsvTaskRepo;
use Ramsey\Uuid\Uuid;

class TasksController
{

    private TasksRepository $tasksRepository;

    public function __construct()
    {
        $this->tasksRepository = new CsvTaskRepo();
    }


    public function show()
    {
        $tasks = $this->tasksRepository->getAll();

        require_once 'App/Views/tasks/show.template.php';
    }


public function create()
{
    require_once 'App/Views/tasks/create.template.php';
}


    public function store(): void
{


    $task = new Task(
        Uuid::uuid4(),
        $_POST['task'],
        Task::STATUS_STARTED
    );

$this->tasksRepository->save($task);

    header('Location: /tasks');
}

public function delete(array $vars)
{

        $id = $vars['id'] ?? null;
        if($id==null) header('Location: /');

        $task = $this->tasksRepository->getOne($id);

        if($task !== null)
        {
            $this->tasksRepository->delete($task);
        }

        header('Location: /');
}

}


