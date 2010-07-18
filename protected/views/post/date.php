<h3>Posts Issued on "<?php echo CHtml::encode(date('F j, Y',$theDay)); ?>"</h3>

<?php foreach($posts as $post): ?>
<?php $this->renderPartial('_post',array(
	'post'=>$post,
)); ?>
<?php endforeach; ?>

<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>