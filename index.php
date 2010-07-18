<?php
//  * @version $Id: index.php 65 2010-02-02 08:54:48Z mocapapa@g.pugpug.org $
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.3.r2247/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
$app=Yii::createWebApplication($config);
$app->timer->init();
$app->run();

