<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class IndexImg extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%index_img}}";
	}
	
}