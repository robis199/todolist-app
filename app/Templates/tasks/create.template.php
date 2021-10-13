<?php require_once 'app/Templates/partials/header.template.php'; ?>

<body>



<a href = "/tasks">Return</a>
<br/>
<form action = "/tasks" method="post">
    <label for="task" >What needs to be done:</label>
    <input id="task" type="text" name="task" />
    <button type="submit">Add</button>

</form>

</body>

