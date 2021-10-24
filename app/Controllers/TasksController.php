<?php
namespace App\Controllers;

use App\Models\Task;
use App\Repositories\PdoTasksRepo;
use App\Repositories\TasksRepository;
use Ramsey\Uuid\Uuid;
use App\View;
use App\Redirect;

class TasksController
{
    private TasksRepository $tasksRepository;

    public function __construct()
    {
        $this->tasksRepository = new PdoTasksRepo();
    }

    public function index(): View
    {
        $tasks = $this->tasksRepository->getAll();

        if (isset($_SESSION["user-name"])) {
            $user = "Hello, " . $_SESSION["user-name"] . "!";
        } else {
            $user ="";
        }

        $view = new View("tasks.view.twig", ["tasks" => $tasks->getTasks(), "user" => $user]);
        return $view;
    }


    public function store()
{
    if(isset($_POST["submit"])) {
        $task = new Task(
            Uuid::uuid4(),
            $_POST['task'],
            Task::STATUS_STARTED
        );
        $this->tasksRepository->save($task);
    }

    Redirect::url("/tasks");
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

    Redirect::url("/tasks");
}


    public function search(): View
    {
        if(isset($_GET["search"]))
        {
            $search = $this->tasksRepository
                ->search($_GET["id"]);
        }
        $view = new View("search.view.twig", ["search" => $search]);
        return $view;
    }




}


