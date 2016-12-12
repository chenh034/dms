<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class FontUser extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%font_user}}";
	}
	
}