<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Question extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%question}}";
	}
	
}