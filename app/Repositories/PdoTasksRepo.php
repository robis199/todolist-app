<?php

namespace App\Repositories;

use App\Config\DBConnect;
use App\Models\Collections\TasksCollection;
use App\Models\Task;
use PDO;

class PdoTasksRepo extends DBConnect implements TasksRepository
{
    public function getAll(): TasksCollection
    {
        $statement = $this->connect()->query("SELECT * FROM task");
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        $collection = new TasksCollection();

        foreach ($tasks as $task) {
            $collection->add(new Task(
                $task['id'],
                $task['title'],
                $task['status'],
                $task['time']
            ));
        }
        return $collection;
    }

    function getOne(string $id): ?Task
    {
        $sql = "SELECT * FROM task WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $task = $stmt->fetch();

        return new Task(
            $task['id'],
            $task['title'],
            $task['status'],
            $task['time']
        );
    }

    function save(Task $task): void
    {
        $sql = "INSERT INTO task (id, title, status, time) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            $task->getId(),
            $task->getTitle(),
            $task->getStatus(),
            $task->getCreationTime(),
        ]);
    }

    function delete(Task $task): void
    {
        $sql = "DELETE FROM task WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$task->getId()]);
    }

    public function search(string $id): Task
    {
        $sql = "SELECT * FROM Tasks WHERE id={$id}";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $task = $stmt->fetch();

        return new Task(
            $task['id'],
            $task['title'],
        );
    }
}
