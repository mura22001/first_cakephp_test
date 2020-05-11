<?php
//app/Model/Task.php
class Task extends AppModel{

	public $hasMany = array('Note');
	
	public $validate = array(
		'name' => array(
			'rule' => array('maxLength',60),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'please sign in Task name'
		),
		
		'body' => array(
			'rule' => array('maxLength',255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'please sign in body'
		),
	);

}
			