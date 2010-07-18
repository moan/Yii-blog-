<?php
  // @version $Id: RecentPosts.php 5 2009-02-22 11:37:40Z choco.moca.colon $
class RecentPosts extends Portlet
{
  public $title='Recent Posts';

  public function getRecentPosts()
  {
    return Post::model()->findRecentPosts();
  }

  protected function renderContent()
  {
    $this->render('recentPosts');
  }
}