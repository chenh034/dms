<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Admin extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%admin}}";
	}

	public function rules(){
		return [
            ['username','required','message'=>'管理员账号不能为空'],
            ['password','required','message'=>'管理员密码不能为空'],
            ['password','validatePass'],
		];
	}

	public function validatePass(){
		if (!$this->hasErrors()) {
			$data = self::find()
			        ->where('username = :username and password = :password',[":username"=>$this->username,":password"=>md5($this->password)])
			        ->one();

			if (is_null($data)) {
				$this->addError('password','用户名或密码错误');
			}
		};

	}

	public function login($data){
		if ($this->load($data,'') && $this->validate()) {
			 return ['code'=>0,'data'=>['username'=>$this->username]];
		}else{
			 return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
	
}