<?php
//app/Controller/TaskController.php
class TasksController extends AppController{
	public $scaffold;

	public function index(){

		$options = array(//変数の宣言
			'conditions' => array(
				'Task.status' => 0
			)
		);

		$tasks_data = $this->Task->find('all',$options);
		//optionsはTask.statusが0の値を持つconditionsの値をもつものという条件で検索条件の配列を探す
		$this->set('tasks_data', $tasks_data);
		//見つけた配列を渡す。

		$this->render('index');
		//indexのurlを表示
	}

	public function done(){

		$id = $this->request->pass[0];
		//ルーティングの要素をもってくる
		$this->Task->id = $id;
		//モデルのTaskにidの変数に代入
		$this->Task->saveField('status', 1);
		//単一のフィールドを保存する。$this->Task->idが必要。
		$msg = sprintf('finish %s Task',$id);
		//フォーマットされた文字を変数に代入

		$this->flash($msg, '/Tasks/index');
		//わからん？やってることは、文字列を表示
	}

	public function create(){
	
		if($this->request->is('post')){
		//postに値が入っているときに動く
			$data = array(//POSTデータにアクセス、その値を入れ込む
				'name' => $this->request->data['name'],
				'body' => $this->request->data['body'],
			);

			$id = $this->Task->save($data);
			//モデルTaskにデータを保存
			if($id == false){
				$this->render('create');
				return;
			}//入ってないとき、createを表示
			$msg = sprintf(
				'Task %s register',
				$this->Task->id
			);//文字を表示する

			//$this->Session->setFlash($msg);
			//$this->redirect('/Tasks/index');
			$this->flash($msg,'/Tasks/index');
			//文字を表示しながら移動
			return;
		}
		$this->render('create');
		//createに移動
	}
	
	public function edit(){
	
		$id = $this->request->pass[0];
		//passを読み込んで代入
		//変数に入れる
		$option = array(
			'conditions' => array(
				'Task.id' => $id,
				'Task.status' => 0
			)
		);
		//条件に入るものを入れる
		$task = $this->Task->find('first', $options);
		
		//何も入ってないとき、入ってないと表示
		if($task == false) {
			$this->Session->setFlash('Not find Task');
			$this->redirect('/Tasks/index');
		}
		
		//何か入っているとき、Tasks/indexに移動
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
			//何も入っていないとき（Post）$taskをdata変数にいれる。
			$this->request->data = $task;
		}
	}			
}