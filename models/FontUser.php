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

	public function rules(){
		return [
            ['username','required','message'=>'用户名账号不能为空','on'=>['login']],
            ['password','required','message'=>'用户名密码不能为空','on'=>['login']],
            ['nickname','safe','on'=>['edit']],
            ['password','validatePass','on'=>['login']],
		];
	}
	

	public function validatePass(){
		if (!$this->hasErrors()) {
			$data = self::find()
			        ->where('username = :username and password = :password',[":username"=>$this->username,":password"=>md5($this->password)])
			        ->one();

			if (is_null($data)) {
				$this->addError('password','用户名或密码错误');
			}else{
				$this->id = $data->id;
			}
		};

	}

	public function login($data){
		$this->scenario = "login";
		if ($this->load($data,'') && $this->validate()) {
			 return ['code'=>0,'data'=>['username'=>$this->username,'user_id'=>$this->id]];
		}else{
			 return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
}