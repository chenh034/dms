<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
* 
*/
class Setmeal extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%setmeal}}";
	}

	public function rules(){
		return [
		   ['name','required','message'=>'套餐内容不能为空'],
		   ['price','required','message'=>'套餐价格不能为空'],
		   ['product_id','required','message'=>'所属产品不能为空'],
		   ['farm_id','required','message'=>'所属养殖户不能为空'],
		];
	}

	public function addSetmeal($data,$farm_id,$product_id){
		if ($this->load($data,'')) {
			$this->farm_id = $farm_id;
			$this->product_id = $product_id;
			if ($this->save()) {
				return ['code'=>0];
			}else{
				return ['code'=>1,'data'=>$this->getErrors()];
			}
		}else{
			return ['code'=>1,'data'=>$this->getErrors()];
		}
	}
	
}