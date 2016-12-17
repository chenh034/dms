<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Product;

/**
* 
*/
class FarmResult extends ActiveRecord
{
	
	public static function tableName(){
		return "{{%farm_result}}";
	}

	public function rules(){
		return [
           ['farm_id','safe'],
           ['product_id','safe'],
           ['content','safe'],
           ['total_weight','safe'],
           ['createtime','safe']
		];
	}

	public function addResult($farm_id,$product_id){
		$this->farm_id = $farm_id;
		$this->product_id = $product_id;
		if ($this->save()) {
			return ['code'=>0];
		}else{
			return ['code'=>1];
		}
	}

	public function updateResult($data){
        $this->content = $data;
        $this->createtime = time();
        if ($this->save()) {
        	return ['code'=>0];
        }else{
        	return ['code'=>1];
        }
	}
	
}