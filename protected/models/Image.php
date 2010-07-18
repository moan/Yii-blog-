<?php
  /*
   * Image model
   * $Id: Image.php 39 2009-06-20 06:10:02Z mocapapa@g.pugpug.org $
   */
class Image extends CFormModel
{
  public $image;
 
  public function rules()
  {
    return array(
		 array('image', 'file', 'types'=>'jpg, gif, png',
		       'maxSize'=>Yii::app()->params['maxImageSize'],
		       ),
		 );
  }
}
