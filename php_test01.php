<$php
$my_global = “Tim”;
function some_function() {
	global $my_global;
	$my_global = "Timothy";
}
echo $my_global;
some_function();
echo $my_global;

$object = new User;	// create an empty object
print_r($object);	// prints an object

$temp = new User(‘name’, ‘password’);
class User {
	public $name, $password; // properties
function save_user() { // method
	echo "blah";
}


?>
