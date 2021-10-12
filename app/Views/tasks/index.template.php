<?php require_once 'app/Views/partials/header.template.php'; ?>
<body>
        <h1>To-Do</h1> (<a href="/tasks/create">Add</a>)
      <ul>
          <?php foreach ($tasks->getTasks() as $task): ?>
          <li>
              <a href="/tasks/<?php echo $task->getId(); ?>">
              <?php echo $task->getTitle(); ?>
              </a>
              <small>
                  (<?php echo $task->getCreationTime(); ?>)
              </small>
          </li>
          <?php endforeach; ?>
      </ul>
</body>
</html>
