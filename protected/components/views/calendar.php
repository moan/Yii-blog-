<center>
<ul class="Calendar">
<?php
   // @version $Id: calendar.php 41 2009-06-20 22:46:12Z mocapapa@g.pugpug.org $
   if (isset(Yii::app()->params['calendarLocale']) && Yii::app()->params['calendarLocale'] == 'Japan')
     include_once('generate_calendar_Japan.php');
   else
     include_once('generate_calendar.php');
echo generate_calendar($year, $month, $days, $len, $url, 0, $pnc);
?>
</ul>
</center>
