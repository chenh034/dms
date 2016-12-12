<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class QuestionType extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%question_type}}";
	}
	
}