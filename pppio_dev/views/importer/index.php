<?php
require_once('views/shared/html_helper.php');

$properties = array('input' => $input);
$types = array('input' => TYPE::CODE);

echo "<strong>Check for a variable:</strong><br><i>test_val(var_name, var_val)</i><br><strong>Check for a function (*params can be empty; set desired_return to None if the function shouldn't return anything):</strong><br><i>test_func(func_name, desired_return, *params)</i><br><strong>Check for a required string in student code (call multiple times if 2+ strings are needed):</strong><br><i>test_in(string)</i><br><strong>Check for the *exact* desired output:</strong><br><i>test_out(string)</i><br>";
echo HtmlHelper::form($types, $properties);

if (isset($lessons)) {
	echo '<pre>';
	print_r($lessons);
	echo '</pre>';
}


?>