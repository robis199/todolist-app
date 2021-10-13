<?php require_once 'app/Templates/partials/header.template.php'; ?>


<body>
<h1><?php echo $task->getTitle(); ?></h1>

<h4><?php echo $task->getCreationTime(); ?></h4>

<form method="post" action="/tasks/<?php echo $task->getId(); ?>">
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>

(<a href="/tasks">Back</a>)

</body>
