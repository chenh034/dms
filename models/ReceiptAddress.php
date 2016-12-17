<?php

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

	public function rules(){
		return [
		   ['user_id','required','message'=>'用户id不能为空','on'=>['add']],
           ['name','required','message'=>'收件人姓名不能为空','on'=>['add']],
           ['cellphone','required','message'=>'手机号码不能为空','on'=>['add']],
           ['city_id','required','message'=>'所在地不能为空','on'=>['add']],
           ['detail_address','required','message'=>'详细地址不能为空','on'=>['add']],
           ['is_default','required','message'=>'默认地址不能为空','on'=>['default']]
		];
	}

	public function addAddress($data){
		$this->scenario = "add";
		if ($this->load($data,'') && $this->validate()) {
		   $this->save();
		   return ['code'=>0];
		}else{
           return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
    
    public function editAddress($data){
    	$this->scenario = "add";
		if ($this->load($data,'') && $this->validate()) {
		   $this->save();
		   return ['code'=>0];
		}else{
           return ['code'=>1,'data'=>$this->getErrors()];
		}
	}

	public function changeDefault(){
		$old = self::find()->where(['is_default'=>1,'user_id'=>$this->user_id])->one();

		$this->scenario = "default";
		if (!is_null($old)) {
			$old->scenario = "default";
			$old->is_default = 0;
			$this->is_default = 1;
			if ($this->save() && $old->save()) {
				return ['code'=>0];
			}else{
				return ['code'=>1];
			}
		}else{
			$this->is_default = 1;
			if ($this->save()) {
				return ['code'=>0];
			}else{
				return ['code'=>1];
			}
		}


		
	}
	
}