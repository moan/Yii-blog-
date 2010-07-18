<div class="post">
  <div class="title">
    <table>
      <tr>
        <td>
          <?php $c = 9 - strlen(date('F', $post->createTime)); $p = str_repeat('\&\n\b\s\p\;', $c); ?>
          <?php $this->widget('PostDate', array('ct'=>date($p.'F'.$p.'<\b\r>j', $post->createTime))); ?>
        </td>
        <td>&nbsp;<?php echo CHtml::link(CHtml::encode($post->title),array('post/show','id'=>$post->id)); ?>
        </td>
      </tr>
    </table>
  </div>
  <div class="author">
    <?php if(!Yii::app()->user->isGuest): ?>
    [<?php echo '<span class="'.strtolower($post->statusText).'">'.$post->statusText.'</span>'; ?>]
    <?php endif; ?>
    posted by <?php echo $post->author->username . ' on ' . date('F j, Y',$post->createTime); ?>
  </div>
  <div class="content">
    <?php echo $post->contentDisplay; ?>
  </div>
  <div class="nav">
    <b>Tags:</b>
    <?php echo $this->getTagLinks($post); ?>
    <br/>
    <?php echo CHtml::link('Read more',array('post/show','id'=>$post->id)); ?> |
    <?php echo CHtml::link("Comments ({$post->commentCount})",array('post/show','id'=>$post->id,'#'=>'comments')); ?> |
    <?php if(!Yii::app()->user->isGuest): ?>
    <?php echo CHtml::link('Update',array('post/update','id'=>$post->id)); ?> |
    <?php echo CHtml::linkButton('Delete',array(
	   'submit'=>array('post/delete','id'=>$post->id),
	   'confirm'=>"Are you sure to delete this post?",
    )); ?> |
    <?php endif; ?>
    Last updated on <?php echo date('F j, Y',$post->updateTime); ?>
  </div>
</div><!-- post -->
