<!-- app/View/Tasks/create.ctp -->
<form action="<?php
	echo $this->Html->url('/Tasks/create');
//送信urlの設定場所はTasks/create/で送信手法はPOST	
?>"method="POST">
//Modelのエラーを吐く。エラーの時限定
<?php echo $this->Form->error('Task.name'); ?>
<?php echo $this->Form->error('Task.body'); ?>
Task name<input type="text" name="name" size="40">
//textの入力場所を作る。名前はname
detail<br/>
<textarea name="body" cols="40" rows="8"></textarea>
//数行のtextの入力場所を作る。名前はbody
<input type="submit" value="create Task">
//ボタンを作る。valueが文字
</form>