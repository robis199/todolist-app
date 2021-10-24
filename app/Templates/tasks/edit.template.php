<?php require_once 'app/Templates/partials/header.template.php'; ?>


<body>



<a href = "/tasks">Return</a>
<br/>
<form action = "/tasks" method="post">
    <label for="task" >Make your changes</label>
    <input id="task" type="text" name="edit" />
    <button type="submit">Edit and save</button>

</form>

</body>

