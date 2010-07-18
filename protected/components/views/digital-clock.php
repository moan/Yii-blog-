<center>
<!-- $Id: digital-clock.php 79 2010-02-18 03:52:17Z mocapapa@g.pugpug.org $ -->
<?php
$cs=Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.delay.js', CClientScript::POS_HEAD);
$clockOffsetHx = 33;
$clockOffsetMx = $clockOffsetHx + 42;
$clockOffsetSx = $clockOffsetMx + 42;
$clockOffsetYU = 22;
$clockOffsetYL = $clockOffsetYU + 13;
?>
<div style="position: relative;">
  <img src="<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-base.png">
    <div class="hourNumberU" style="width:34px;height:13px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-numbers.png);background-repeat:no-repeat;top:<?php echo $clockOffsetYU;?>px;left:<?php echo $clockOffsetHx;?>px;position:absolute;"></div>
    <div class="hourNumberL" style="width:34px;height:13px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-numbers.png);background-repeat:no-repeat;top:<?php echo $clockOffsetYL;?>px;left:<?php echo $clockOffsetHx;?>px;position:absolute;"></div>
    <div class="minuteNumberU" style="width:34px;height:13px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-numbers.png);background-repeat:no-repeat;top:<?php echo $clockOffsetYU;?>px;left:<?php echo $clockOffsetMx;?>px;position:absolute;"></div>
    <div class="minuteNumberL" style="width:34px;height:13px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-numbers.png);background-repeat:no-repeat;top:<?php echo $clockOffsetYL;?>px;left:<?php echo $clockOffsetMx;?>px;position:absolute;"></div>
    <div class="secondNumberU" style="width:34px;height:13px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-numbers.png);background-repeat:no-repeat;top:<?php echo $clockOffsetYU;?>px;left:<?php echo $clockOffsetSx;?>px;position:absolute;"></div>
    <div class="secondNumberL" style="width:34px;height:13px;background-image:url(<?php echo Yii::app()->request->baseUrl;?>/systemImages/digital-clock-numbers.png);background-repeat:no-repeat;top:<?php echo $clockOffsetYL;?>px;left:<?php echo $clockOffsetSx;?>px;position:absolute;"></div>
</div>
<script type="text/javascript">
/*<![CDATA[*/
   $(document).ready(function() {
       var ch, cm, cs, ph, pm, ps;
       var currentTime = new Date();
       if (ph == undefined) ph = (currentTime.getHours() + 23)%24;
       if (pm == undefined) pm = (currentTime.getMinutes() + 59)%60;
       if (ps == undefined) ps = (currentTime.getSeconds() + 59)%60;

       animation();
       setInterval(function(){
	   animation();
       }, 1000);

       function n1u(t, x) $(t).css('background-position', -x*34+'px -26px'); // 1u
       function n2u(t, x) $(t).css('background-position', -x*34+'px -39px'); // 2u
       function n3u(t, x) $(t).css('background-position', -x*34+'px -52px'); // 3u
       function n4u(t, x) $(t).css('background-position', -x*34+'px 0px'); // 4u
       function n5l(t, x) $(t).css('background-position', -x*34+'px -65px'); // 5l
       function n6l(t, x) $(t).css('background-position', -x*34+'px -78px'); // 6l
       function n7l(t, x) $(t).css('background-position', -x*34+'px -91px'); // 7l
       function n8l(t, x) $(t).css('background-position', -x*34+'px -13px'); // 8l

       function animation() {
	 currentTime = new Date();
	 ch = currentTime.getHours();
	 cm = currentTime.getMinutes();
	 cs = currentTime.getSeconds();

	 //	 console.log('p='+ph+','+pm+','+ps);
	 //	 console.log('c='+ch+','+cm+','+cs);
	 
	 if (ch != ph) $('.hourNumberU').delay(function() n1u(this, ph));
	 if (cm != pm) $('.minuteNumberU').delay(function() n1u(this, pm));
	 if (cs != ps) $('.secondNumberU').delay(function() n1u(this, ps));

	 if (ch != ph) $('.hourNumberU').delay(function() n2u(this, ph));
	 if (cm != pm) $('.minuteNumberU').delay(function() n2u(this, pm));
	 if (cs != ps) $('.secondNumberU').delay(function() n2u(this, ps));
							
	 if (ch != ph) $('.hourNumberU').delay(function() n3u(this, ph));
	 if (cm != pm) $('.minuteNumberU').delay(function() n3u(this, pm));
	 if (cs != ps) $('.secondNumberU').delay(function() n3u(this, ps));

	 if (ch != ph) $('.hourNumberU').delay(function() n4u(this, ch));
	 if (cm != pm) $('.minuteNumberU').delay(function() n4u(this, cm));
	 if (cs != ps) $('.secondNumberU').delay(function() n4u(this, cs));


	 if (ch != ph) $('.hourNumberL').delay(function() n5l(this, ph));
	 if (cm != pm) $('.minuteNumberL').delay(function() n5l(this, pm));
	 if (cs != ps) $('.secondNumberL').delay(function() n5l(this, ps));


	 if (ch != ph) $('.hourNumberL').delay(function() n6l(this, ph));
	 if (cm != pm) $('.minuteNumberL').delay(function() n6l(this, pm));
	 if (cs != ps) $('.secondNumberL').delay(function() n6l(this, ps));


	 if (ch != ph) $('.hourNumberL').delay(function() n7l(this, ph));
	 if (cm != pm) $('.minuteNumberL').delay(function() n7l(this, pm));
	 if (cs != ps) $('.secondNumberL').delay(function() n7l(this, ps));


	 if (ch != ph) $('.hourNumberL').delay(function() n8l(this, ch));
	 if (cm != pm) $('.minuteNumberL').delay(function() n8l(this, cm));
	 if (cs != ps) $('.secondNumberL').delay(function() n8l(this, cs));

	 ph = ch;
	 pm = cm;
	 ps = cs;
	 $.resume(20);
       }
    });
/*]]>*/
</script>
</center>
