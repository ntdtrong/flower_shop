<section class="content-header">
	<span class="page-title">Ý kiến</span>
</section>
<?php echo $this->Session->flash(); ?>
<section class="content">
	<div class="panel panel-default">
  		<div class="panel-heading">
  			<?php echo $item['Feedback']['name'], ' - ', $item['Feedback']['email']; ?><br/>
  			<i class="fa fa-clock-o"></i> <?php echo $this->Time->format('d/m/y H:i', $item['Feedback']['created_at']); ?>
  		</div>
  		<div class="panel-body"><?php echo $item['Feedback']['content']?></div>
  		<div class="panel-footer" style="text-align: right;">
  			<?php echo $this->Html->link('Xoá', array('controller' => 'admin', 'action' => 'delete_feedback', $item['Feedback']['id']), array('class' => 'btn btn-danger'));?>
  		</div>
	</div>
</section>
    