<?php
  // @version $Id: Clock.php 75 2010-02-10 11:02:19Z mocapapa@g.pugpug.org $
class Clock extends Portlet
{
  public $title='Clock';

  protected function renderContent()
  {
    //    $this->render('digital-clock');
     $this->render('analog-clock');
  }
}
