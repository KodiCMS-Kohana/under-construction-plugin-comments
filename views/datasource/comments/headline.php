<?php if($data['total'] > 0): ?>
<div class="widget widget-nopad">
	<div class="widget-content">
		<table id="CategoriesHeadlineHeader" class="table map-header">
			<colgroup>
				<col />
			</colgroup>
			<thead>
				<tr>
					<th><?php echo __('Author'); ?></th>
					<th><?php echo __('Comment'); ?></th>
				</tr>
			</thead>
		</table>
		<div class="widget-comments">
			<?php foreach ($data['documents'] as $doc): ?>
			<div class="comment">
				<div class="comment-by">
					<?php echo $doc->author(); ?>(<small class="muted"><?php echo $doc->author_IP; ?></small>) commented on <?php echo $doc->source(); ?>
				</div>
				<div class="comment-text">
					<?php echo HTML::chars($doc->content); ?>
				</div>
				<div class="comment-actions">
					<span class="pull-right"><?php echo Date::format($doc->created_on); ?></span>
				</div>
			</div>
			
			<hr />
			<?php endforeach; ?>
		</div>
		<?php echo __('Total doucments: :num', array(':num' => $data['total'])); ?>
	</div>
</div>
<hr />
<?php echo $pagination; ?>
<?php else: ?>
<h2><?php echo __('Section is empty'); ?></h2>
<?php endif; ?>