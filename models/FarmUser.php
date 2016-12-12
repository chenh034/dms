<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class FarmUser extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%farm_user}}";
	}

	public function rules(){
		return [
            ['username','required','message'=>'账号不能为空','on'=>['login']],
            ['password','required','message'=>'密码不能为空','on'=>['login']],
            ['password','validatePass','on'=>['login']],
            ['name','required','message'=>'姓名不能为空','on'=>['contact']],
            ['cellphone','required','message'=>'电话不能为空','on'=>['contact']],
            ['email','safe'],
            ['id_number','required','message'=>'身份证不能为空','on'=>['contact']],
            ['account_place','safe'],
            ['bak_phone','safe'],
            ['city_id','required','message'=>'城市不能为空','on'=>['farm']],
            ['detail_place','required','message'=>'详细地址不能为空','on'=>['farm']],
            ['dorm_num','required','message'=>'猪舍数量不能为空','on'=>['farm']],
            ['product_num','required','message'=>'产品数量不能为空','on'=>['farm']],
		];
	}

	public function validatePass(){
		if (!$this->hasErrors()) {
			$data = self::find()
			        ->where('username = :username and password = :password',[":username"=>$this->username,":password"=>md5($this->password)])
			        ->one();

			if (is_null($data)) {
				$this->addError('password','账号或密码错误');
			}
		};

	}

	public function login($data){
		$this->scenario = 'login';
		if ($this->load($data,'') && $this->validate()) {
			 return ['code'=>0,'data'=>['username'=>$this->username]];
		}else{
			 return ['code'=>1,'data'=>$this->getErrors()];
		}
	}

	public function editUser($data,$scenario){
		$this->scenario = $scenario;
		if ($this->load($data,'') && $this->validate()) {
			$this->save();
			return ['code'=>0];
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
	
}