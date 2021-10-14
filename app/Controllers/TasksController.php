<?php

namespace App\Controllers;


use App\Models\Task;
use App\Repositories\PdoTasksRepo;
use App\Repositories\TasksRepository;
use Ramsey\Uuid\Uuid;

class TasksController
{

    private TasksRepository $tasksRepository;

    public function __construct()
    {
        $this->tasksRepository = new PdoTasksRepo();

    }


    public function index()
    {
        $tasks = $this->tasksRepository->getAll();

        require_once 'App/Templates/tasks/index.template.php';
    }


public function create()
{
    require_once 'App/Templates/tasks/create.template.php';
}


    public function store()
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


    public function show(array $vars)
    {


        $id = $vars['id'] ?? null;

        if ($id==null) header('Location: /');

        $task = $this->tasksRepository->getOne($id);

        if($task === null) header('Location: /');

        require_once 'app/Templates/tasks/show.template.php';
    }

}


