<?php
require_once "php_db.php";  // defines variables $hn, $db, $un, and $pw

echo "<style>body{font-family: Verdana;}</style>";
echo "<h1>checking password for user " . $_POST['userid'] . " and password " . $_POST['password'] . "</h1>";

/* use parameterized queries to protect against SQL injection; see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers for more information */
$my_db = new PDO('mysql:host=' . $hn . ';dbname=' . $db . ';charset=utf8mb4', $un, $pw);
$my_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$my_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

try {

     /* this simple SELECT statement works */
     // foreach($my_db->query('SELECT * FROM users') as $row) {
     //      echo $row['userid'] . ' ' . $row['password'] . '<br>';
     // }

     /* this way is better since you can get the number of rows returned. */
     $sql1          = $my_db->query('SELECT * FROM users');
     $rows1         = $sql1->fetchAll(PDO::FETCH_ASSOC);
     $row_count1    = $sql1->rowCount();

     foreach($rows1 as $one_row){
          echo $one_row['userid'] . ' ' . $one_row['password'] . '<br>';
     }
     echo '---------------------------------------------------------------------------------------------------------------<br>';

     /* this is the best way since it uses completely parameterized queries. */
     $sql2 = $my_db->prepare("SELECT userid, password FROM users WHERE userid=?");
     $sql2->execute(array($_POST['userid']));
     $rows2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

     if ($rows2) {
          echo "userid was located<br>";
          echo "password entered was " . $_POST['password'] . "<br>";
          echo "encrypted password = " . password_hash($_POST['password'], PASSWORD_DEFAULT) . '<br>';

          if (password_verify($_POST['password'], password_hash($_POST['password'], PASSWORD_DEFAULT))) {
               echo 'password is correct';
          } else {
               echo 'password is incorrect';
          }
     } else {
          echo 'userid not found';
     }

     foreach($rows2 as $one_row){
          echo $one_row['userid'] . ' ' . $one_row['password'] . '<br>';
     }

     /* in this case - since the userid is unique - there can be at most one returned row. */
     echo $rows2[0]['userid'];
     echo $rows2[0]['password'];

} catch(PDOException $ex) {
     echo "username " . $_POST['userid'] . " is already taken.  please choose a different username.";
}


?>
