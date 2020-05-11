<!-- app/View/Elements/task.ctp -->
<?php echo $this->Html->css('task'); ?>
<div class="roundBox">
<h3><?php echo h($task['Task']['id']); ?>
:
<?php echo h($task['Task']['name']); ?></h3>
create date<?php echo h($task['Task']['created']); ?>
<p class="comment">
<ul>
<?php foreach ($task['Note'] as $note): ?>
<li><?php echo h($note['body']); ?></li>
<?php endforeach; ?>
<li><?php echo $this->Html->link(
	'add comment',
	'/Notes/create'
); ?></li>
</ul></p>

<?php echo $this->Html->link(
	'edit',
	'/Tasks/edit/'.$task['Task']['id'],
	array('class' => 'button left')
); ?>

<?php echo $this->Html->link(
	'finish this Task',
	'/Tasks/done/'.$task['Task']['id'],
	array('class' => 'button right')
); ?>
</div>