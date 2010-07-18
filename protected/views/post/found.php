<?php if(!empty($_GET['tag'])): ?>
<h3>Posts Tagged with "<?php echo CHtml::encode($_GET['tag']); ?>"</h3>
<?php endif; ?>
<?php if(!empty($search->string)): ?>
<h3>Posts Searched by "<?php echo CHtml::encode($search->string); ?>"</h3>
<?php endif; ?>

<?php foreach($posts as $post): ?>
<?php
	$pizza = explode('>', $post->contentDisplay);
	$s = '';
	for ($i = 0; $i < count($pizza); $i++) {
		$piece = explode('<', $pizza[$i]);
		if (count($piece) == 2) {
			$replace = preg_replace('/('.$search->string.')/i', '<b><span style="background:yellow;">${1}</span></b>', $piece[0]);
			$s .= $replace.'<'.$piece[1].'>';
		}
	}
	$post->contentDisplay = $s;
	$this->renderPartial('_post',array(
					   'post'=>$post,
					   ));
?>
<?php endforeach; ?>

<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>