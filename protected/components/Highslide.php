<?php
  // @version $Id: Highslide.php 57 2010-01-28 01:51:43Z mocapapa@g.pugpug.org $

class Highslide extends CApplicationComponent
{
	public $enable;

	public function init()
	{
		parent::init();
		if ($this->enable) {
		// js
			$cs=Yii::app()->clientScript;
			$baseUrl=Yii::app()->request->baseUrl;
			$cs->registerCoreScript('jquery');
			$cs->registerScriptFile($baseUrl.'/js/highslide/highslide.js', CClientScript::POS_HEAD);
			$cs->registerScriptFile($baseUrl.'/js/highslide/highslide_eh.js', CClientScript::POS_HEAD);
			$cs->registerScriptFile($baseUrl.'/js/jquery.clipboard-2.0.1/jquery.clipboard.js', CClientScript::POS_HEAD);
			$params = array(
					'BASEURL'=>$baseUrl,
                            'HTTPHOST'=>$_SERVER['HTTP_HOST']
					);
			$script = 'var PARAMS = eval('.CJavaScript::jsonEncode($params).');';
			$cs->registerScript('widget-params', $script, CClientScript::POS_BEGIN);

			$script = 'hs.graphicsDir = PARAMS.BASEURL+\'/js/highslide/graphics/\';'."\n";
			$script .= 'hs.outlineType = \'rounded-white\';'."\n";
			$script .= 'hs.showCredits = false;';
			$cs->registerScript('hislide-middle', $script, CClientScript::POS_BEGIN);
			$script = 'addHighSlideAttribute();';
			$cs->registerScript('hislide-end', $script, CClientScript::POS_END);
		// css
			$cs->registerCSSFile($baseUrl.'/js/highslide/highslide.css');
		}
	}
}
