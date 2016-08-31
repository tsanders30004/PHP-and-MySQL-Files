<?php
require_once "php_db.php";  // defines variables $hn, $db, $un, and $pw

$userid = $_POST['userid'];
$password = $_POST['password'];

echo "<style>body{font-family: Verdana;}</style>";
echo "<h1>checking password for user " . $userid . " and password " . $password . "</h1>";

/* use parameterized queries to protect against SQL injection; see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers for more information */
$my_db = new PDO('mysql:host=' . $hn . ';dbname=' . $db . ';charset=utf8mb4', $un, $pw);
$my_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$my_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

try {
     /* use parameterized queries to protect against SQL injection; see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers for more information */
     $sql2 = $my_db->prepare("SELECT userid, password FROM users WHERE userid=?");
     $sql2->execute(array($userid));
     $rows2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

     if ($rows2) {
          if (password_verify($password, $rows2[0]['password'])) {
               echo 'password is correct';
          } else {
               echo 'password is incorrect';
          }
     } else {
          echo 'userid not found';
     }
} catch(PDOException $ex) {
     echo "username " . $userid . " is already taken.  please choose a different username.";
}
?>
