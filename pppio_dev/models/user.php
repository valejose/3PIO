<?php
	require_once('models/model.php');
	class User extends Model
	{
		protected static $types = array('id' => Type::INTEGER, 'name' => Type::STRING, 'email' => Type::EMAIL, 'password' => Type::PASSWORD, 'role' => Type::ROLE); //use the enum
		protected $name;
		protected $email;
		protected $password; //be careful
		protected $role;
	}
?>