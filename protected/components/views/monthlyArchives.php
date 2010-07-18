<ul>
<?php foreach ($this->findAllPostDate() as $month=>$val): ?>
<li>
<?php echo CHtml::link("$month ($val)", CHtml::normalizeUrl(array('post/PostedInMonth',
								  'time'=>strtotime($month),
								  'pnc'=>'c')));  ?>
</li>
<?php endforeach; ?>
</ul>
<!-- $Id: monthlyArchives.php 39 2009-06-20 06:10:02Z mocapapa@g.pugpug.org $ -->
