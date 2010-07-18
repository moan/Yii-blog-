<?php
  // @version $Id: WidgetCollapse.php 57 2010-01-28 01:51:43Z mocapapa@g.pugpug.org $

class WidgetCollapse extends CApplicationComponent
{
	public $enable;

	public function init()
	{
		parent::init();
		if ($this->enable) {
			$cs=Yii::app()->clientScript;
                        $baseUrl=Yii::app()->request->baseUrl;

			$params = array(
				'BASEURL'=>$baseUrl,
				'HTTPHOST'=>$_SERVER['HTTP_HOST']
			);
                        $script = 'var PARAMS = eval('.CJavaScript::jsonEncode($params).');';
                        $cs->registerScript('widget-params', $script, CClientScript::POS_BEGIN);

			$cs->registerScriptFile($baseUrl.'/js/persist.js', CClientScript::POS_HEAD);
			$script = implode('',file(Yii::app()->basePath.'/../js/widget-collapse.min.js'));
			$cs->registerScript('widget-collapse', $script, CClientScript::POS_READY);
		}
	}
}
