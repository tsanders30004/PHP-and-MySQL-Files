<?php
$my_global = “Tim”;
function some_function() {
	global $my_global;
	$my_global = "Timothy";
}
print($my_global);

some_function();
print($my_global);


$object = new User;	// create an empty object
print_r($object);	// prints an object

$object->name = "Tim";
$object->password = "secret";

print_r($object);

class User {
	public $name, $password; // properties
     function save_user() { // method
	     echo "blah";
     }
}
  phpinfo();

?>
