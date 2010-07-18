<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<link title="RSS Feed" rel="alternate" type="application/rss+xml" href="<?php echo CHtml::normalizeUrl(array('post/feed')); ?>" />
<title><?php echo $this->pageTitle; ?></title>

<?php
// css
$baseUrl=Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerCSSFile($baseUrl.'/css/main.css');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.corners.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('roundCorners', '$(".portlet,.postdate,.post .nav,.comment,.form").corners("7px");$(".portlet .content").corners("5px bottom");', CClientScript::POS_READY);

// initialize two application components
Yii::app()->widgetCollapse->init();
Yii::app()->highslide->init();
?>
</head>

<body class="page">
<div id="container">
  <div id="header">
    <H1><?php echo CHtml::link(CHtml::encode(Yii::app()->params['title']),Yii::app()->homeUrl); ?>
    <div id="rss"><?php echo CHtml::link(CHtml::image($baseUrl.'/systemImages/feed.gif'),array('post/feed')); ?></div>
    </H1>
  </div><!-- header -->

  <div id="sidebar">
    <?php $this->widget('UserLogin',array('visible'=>Yii::app()->user->isGuest)); ?>

    <?php $this->widget('UserMenu',array('visible'=>!Yii::app()->user->isGuest)); ?>

    <?php $this->widget('Clock'); ?>

    <?php $this->widget('Calendar'); ?>

    <?php $this->widget('MonthlyArchives'); ?>

    <?php $this->widget('SiteSearch'); ?>

    <?php $this->widget('RecentPosts'); ?>

    <?php $this->widget('RecentComments'); ?>

    <?php $this->widget('TagCloud'); ?>

    <?php $this->widget('Links'); ?>

  </div><!-- sidebar -->

  <div id="content">
    <?php echo $content; ?>
  </div><!-- content -->

  <br class="clearfloat" />

  <div id="footer" style="position: relative;">
    <p><?php echo Yii::app()->params['copyrightInfo']; ?><br/>
    All Rights Reserved.<br/>
    <?php echo Yii::powered(); echo Yii::getVersion()."&nbsp;(r".EyiiVersion::getVersion().")"; ?>
    <?php print(sprintf(", Executed in %.2f[msec]\n", Yii::app()->timer->getTimer())); ?></p><br/>
    <div class="ants" style="width:39px;height:32px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/ants.png);background-repeat:no-repeat;position:absolute;"></div>
<script type="text/javascript">
/*<![CDATA[*/
// ants animation
$(document).ready(function(){var c;var d=0;var e=0;var f=724;var g=13;var x=f;var y=g;var h=4;var i=h;animation();function animation(){var a;var b;if(e==0){$('.ants').css('background-position','0px 0px');b=y-2}else{$('.ants').css('background-position','0px -32px');b=y+2}a=x-4;$('.ants').css('left',a+'px');$('.ants').css('top',b+'px');if(--i==-1){if(e==0)e=1;else e=0;i=h}x=a;y=b;if(x<30){x=f;clearInterval(c);d=0}}$('.ants').click(function(){if(d==0){c=setInterval(function(){animation()},50);d=1}else{clearInterval(c);d=0}})});
/*]]>*/
</script>
  </div><!-- footer -->
</div><!-- container -->

</body>

</html>