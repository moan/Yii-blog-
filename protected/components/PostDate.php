<?php
  // @version $Id: PostDate.php 5 2009-02-22 11:37:40Z choco.moca.colon $
class PostDate extends Portlet {
  public $cssClass='postdate';
  public $ct;
 
  protected function renderContent()
  {
    echo "<center><font size=\"3\">\n";
    print $this->ct;
    echo "</font></center>\n";
  }
}
