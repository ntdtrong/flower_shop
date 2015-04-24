<section class="content-header">
	<span class="page-title">Ý kiến</span>
</section>
<?php echo $this->Session->flash(); ?>
<section class="content">
	<div class="panel panel-default">
  		<!-- Table -->
		<table class="table table-striped table-bordered table-condensed table-hover">
		  	<tr>
		  		<th> <i class="fa fa-calendar"></i></th>
		  		<th>Email</th>
		  		<th>Tên</th>
		  		<th>Nội Dung</th>
		  	</tr>
		  	<?php if (!empty($data)): ?>
		  		<?php foreach ($data as $item): ?>
		  		<tr>
			  		<td><?php echo $this->Html->link($this->Time->timeAgoInWords($item['Feedback']['created_at'], array('format' => 'm/d/y H:i', 'accuracy' => array('month' => 'month'), 'end' => '+10 year')), array('controller' => 'admin', 'action' => 'feedback', $item['Feedback']['id']));?></td>
			  		<td><?php echo $this->Html->link($item['Feedback']['email'], array('controller' => 'admin', 'action' => 'feedback', $item['Feedback']['id'])); ?></td>
			  		<td><?php echo $this->Html->link($item['Feedback']['name'], array('controller' => 'admin', 'action' => 'feedback', $item['Feedback']['id']));?></td>
			  		<td><?php echo Utils::getWordsFromLongText($item['Feedback']['content'], 100); ?></td>
			  	</tr>
		  		<?php endforeach; ?>
		  	<?php endif; ?>
		</table>
		
		<div class="col-md-12" style="text-align: center;">
			<div class="pagination">
				<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "admin", "action" => "feedbacks"))); ?>
			</div>
		</div>
	</div>
</section>
    