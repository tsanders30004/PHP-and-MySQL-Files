<?php
echo <<<_END
<form action="php_chkpw.php" method="POST">
     User ID:<br>
     <input type="text" name="userid" required><br>
     Password:<br>
     <input type="password" name="password" required><br><br>
     <button type="submit">Log In</button>
</form>
_END;

phpinfo();
?>
