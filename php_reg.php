<?php
echo <<<_END
<h1>Register for a New Account</h1>
<form action="php_crusr.php" method="POST">
     User ID:<br>
     <input type="text" name="userid" required><br>
     Password:<br>
     <input type="password" name="password" required><br><br>
     <button type="submit">Register</button>
</form>
_END;

?>
