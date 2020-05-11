<?php
//app/Controller/TaskController.php
class TasksController extends AppController{
	public $scaffold;

	public function index(){

		$options = array(
			'conditions' => array(
				'Task.status' => 0
			)
		);

		$tasks_data = $this->Task->find('all',$options);
		$this->set('tasks_data', $tasks_data);

		$this->render('index');
	}

	public function done(){

		$id = $this->request->pass[0];
		$this->Task->id = $id;
		$this->Task->saveField('status', 1);
		$msg = sprintf('finish %s Task',$id);

		$this->flash($msg, '/Tasks/index');
	}

	public function create(){
	
		if($this->request->is('post')){
			$data = array(
				'name' => $this->request->data['name'],
				'body' => $this->request->data['body'],
			);

			$id = $this->Task->save($data);
			if($id == false){
				$this->render('create');
				return;
			}
			$msg = sprintf(
				'Task %s register',
				$this->Task->id
			);

			//$this->Session->setFlash($msg);
			//$this->redirect('/Tasks/index');
			$this->flash($msg,'/Tasks/index');
			return;
		}
		$this->render('create');
	}
	
	public function edit(){
	
		$id = $this->request->pass[0];
		$option = array(
			'conditions' => array(
				'Task.id' => $id,
				'Task.status' => 0
			)
		);
		$task = $this->Task->find('first', $options);
		
		if($task == false) {
			$this->Session->setFlash('Not find Task');
			$this->redirect('/Tasks/index');
		}
		
		if($this->request->is('post')){
			$data = array(
				'id' => $id,
				'name' => $this->request->data['Task']['name'],
				'body' => $this->request->data['Task']['body']
			);
			if ($this->Task->save($data)){
				$this->Session->setFlash('Update');
				$this->redirect('/Tasks/index');
			}
		}else{
			$this->request->data = $task;
		}
	}			
}