<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class City extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%param_city}}";
	}
	
}