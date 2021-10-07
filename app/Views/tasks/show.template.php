<?php require_once 'app/Views/partials/header.template.php'; ?>
<body>
        <h1>To-Do</h1> <button><a href="/tasks/create">Add</a></button>
      <ul>
          <?php foreach ($tasks->getTasks() as $task): ?>
          <li>
              <?php echo $task->getTitle(); ?>
              <small>
                  (<?php echo $task->getCreationTime(); ?>)
              </small>

              <form method="post" action="/tasks/<?php echo $task->getId() ?>">
                    <button type="submit">Delete</button>
                    </form>
          </li>
          <?php endforeach; ?>
      </ul>

</body>

