<?php

class SiteSearch extends Portlet {

  public $title='Site Search';

  public function renderContent() {
    $form = new SiteSearchForm();
    $this->render('siteSearch', array('form'=>$form));
  }

}

