<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
	// configurations for highslide extension
	'imageHome'=>'images/',
	'imageHomeAbs'=>dirname(__FILE__).'/../../images/',
	'imageBoundingBox'=>'240',
	'imageParams'=>'style="float:left;margin:5px;"',
	'imageThumbnailBoundingBox'=>'120',
	'maxImageSize'=>512*1024, // 512KByte
	'profileImageBoundingBox'=>'60',
	// locale of calendar widget
	//'calendarLocale'=>'Japan',
	'postsPerFeedCount'=>20,
);