<?php
	require_once('models/model.php');
	class Section extends Model
	{
		protected static $types = array('id' => Type::INTEGER, 'name' => Type::STRING, 'course' => Type::COURSE, 'teacher' => Type::USER, 'start_date' => Type::DATETIME, 'end_date' => Type::DATETIME, /*'concepts' => Type::LIST_CONCEPT, */'users' => Type::LIST_USER); //use the enum
		//protected static $db_hidden_props = array('id' => true, 'hidden_props' => true, 'db_hidden_props' => true, 'types' => true, 'concepts' => true);
		protected $name;
		protected $course;
		protected $teacher;
		protected $start_date;
		protected $end_date;
		//protected $concepts;
		protected $users;
	}
?>
