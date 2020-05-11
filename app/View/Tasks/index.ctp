<!-- app/View/Tasks/index.ctp -->
<?php echo $this->Html->link('New Task','/Tasks/create');?>
<?php header('Content-Type: text/html; charset=UTF-8');?>
<h3><?php echo count($tasks_data);?>Not Task</h3>
<?php foreach ($tasks_data as $row): ?>
<?php echo $this->element('task',array('task' => $row)) ?>
<?php endforeach; ?>