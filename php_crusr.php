<?php
require_once "php_db.php";  // defines variables $hn, $db, $un, and $pw

echo "<h1>creating new user...</h1>";

/* use parameterized queries to protect against SQL injection; see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers for more information */
$my_db = new PDO('mysql:host=' . $hn . ';dbname=' . $db . ';charset=utf8mb4', $un, $pw);
$my_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$my_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

try {
     $sql_stmt = $my_db->prepare("INSERT INTO users (userid, password) values(?, ?)");
     $sql_stmt->execute(array($_POST['userid'], password_hash($_POST['password'], PASSWORD_DEFAULT))); // see http://php.net/manual/en/function.password-hash.php for info on password hashing.
     echo "successfully created user " . $_POST['userid'];
     // $rows1 = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);

     // close connection
     $my_db = null;
     $sql_stmt = null;
     
} catch(PDOException $ex) {
     echo "username " . $_POST['userid'] . " is already taken.  please choose a different username.";
}
?>
