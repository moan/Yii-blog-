<?php
// @version $Id: Timer.php 65 2010-02-02 08:54:48Z mocapapa@g.pugpug.org $
class Timer extends CApplicationComponent {

	public $startTime;

	public function init()
	{
		$time = microtime();
		// Yii::trace('start timer @ '.$time,'components.Timer.init()');
		$this->startTime = $time;
	}

	public function getTimer()
	{
		$time = microtime();
		// Yii::trace('stop timer @ '.$time,'components.Timer.getTimer()');
		list($e1, $e0) = explode(" ", $time);
		list($s1, $s0) = explode(" ", $this->startTime);
		return (($e1+$e0)-($s1+$s0))*1000.0;
	}
}
