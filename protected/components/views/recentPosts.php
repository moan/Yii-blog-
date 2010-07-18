<ul>
<?php foreach($this->getRecentPosts() as $post): ?>
<li>
<?php echo CHtml::link(CHtml::encode($post->title),array('post/show','id'=>$post->id)); ?>
&nbsp;on&nbsp;
<?php echo CHTml::link(date('M j', $post->createTime), array('post/PostedOnDate', 'time'=>$post->createTime)); ?>
</li>
<?php endforeach; ?>
</ul>
