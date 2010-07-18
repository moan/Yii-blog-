<?php
  // @version $Id: Links.php 5 2009-02-22 11:37:40Z choco.moca.colon $
class Links extends Portlet
{
  public $title='Links';

  protected function renderContent()
  {
    $this->render('links');
  }
}
