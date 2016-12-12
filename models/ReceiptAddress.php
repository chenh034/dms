Rec<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class ReceiptAddress extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%receipt_address}}";
	}
	
}