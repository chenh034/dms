<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Handbook extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%handbook}}";
	}
	
}