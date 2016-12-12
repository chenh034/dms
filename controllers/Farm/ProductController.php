<?php 

namespace app\controllers\farm;

use Yii;
use yii\web\Controller;
use app\models\Product;
use app\models\Setmeal;
use app\models\FarmResult;
use yii\web\Response;
use crazyfd\qiniu\Qiniu;

/**
* 
*/
class ProductController extends Controller
{
	
	public function actionAdd(){
		// $farm_id = Yii::$app->session['farm_id'];
		$farm_id = 1;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			// print_r($post);return;
			if ($post['type'] == 1) {
				$add_status = $this->adopt($post);
			}else if ($post['type'] == 2) {
				$add_status = $this->raised($post);
			}
			$Result = new FarmResult;
			$pro_rs = $Result->addResult($farm_id,$add_status['data']['product_id']);

			if ($add_status['code']==0 && $pro_rs['code']==0) {
				echo '添加成功';
			}else{
				echo '添加失败';
			}
		}
	}

	public function adopt($post){
		$Product = new Product;
		if (isset($_FILES['cover'])) {
			$img_url = $this->uploadPic();
			$post['img_url'] = $img_url;
		}
		$add_status = $Product->addProduct($post);
		
		return $add_status;

	}

	public function raised($post){
		$Product = new Product;
		$Setmeal = new Setmeal;
		if (isset($_FILES['cover'])) {
			$img_url = $this->uploadPic();
			$post['img_url'] = $img_url;
		}
		$setmeals = $post['setmeal'];
		unset($post['setmeal']);

		$transaction = Yii::$app->db->beginTransaction();
		try{

		    $add_status = $Product->addProduct($post);

			$farm_id = 1;
			$product_id = $add_status['data']['product_id'];

            foreach ($setmeals as $key => $value) {
				$Setmeal = new Setmeal;
				$setmeal_status = $Setmeal->addSetmeal($value,$farm_id,$product_id);
			}

		    if($add_status['code'] == 1 || $setmeal_status['code'] == 1){
		    	throw new \Exception('添加失败！');
		    }
		    
		    $transaction->commit(); 
		}catch (\Exception $e){
		    $transaction->rollBack();
		    echo "添加失败";
		    return;
		}
		return $add_status;

	}

	public function actionEdit($id){
		// print_r($_FILES);return;
		$Product = Product::findOne($id);
        if (Yii::$app->request->isPost) {
        	$post = Yii::$app->request->post();
            $post['img_url'] = $Product->img_url;
        	if (isset($_FILES['cover'])) {
				$img_url = $this->uploadPic();
				$post['img_url'] = $img_url;
				if ($Product->img_url) {
					$this->delPic($Product->img_url);
				}
				
			}

        	$edit_status = $Product->editProduct($post);
        	if ($edit_status['code']==0) {
        		echo '修改成功';
        	}else{
        		echo '修改失败';
        	}
        	return;
        }
	}

	public function actionDel($id){
		$id = (int)$id;
		$Product = Product::findOne($id);
		if (!is_null($Product)) {
			$this->delPic($Product->img_url);
			if ($Product->delete()) {
				echo "删除成功";
			}else{
				echo '删除失败';
			}
		}

	}

	public function actionJson($page,$size,$is_ok){
		// Yii::$app->response->format = Response::FORMAT_JSON;
		$size = (int)$size;
        $offset = $size*($page-1);
        $is_ok = (int)$is_ok;

        $data = Product::find()->select(['id','name','species_id','foundation_weight','pre_weight','foundation_price','img_url'])
                ->with(['species'=>function($query){
                	$query->select('id,name');
                }])
                ->where(['is_ok'=>$is_ok])
                ->limit($size)
                ->offset($offset)
                ->orderBy('id desc')
                ->asArray()
                ->all();

        print_r($data);
	}

	private function uploadPic(){
		if ($_FILES['cover']['error'] > 0) {
			return false;
		}
		$qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
		$key = uniqid();
        $qiniu->uploadFile($_FILES['cover']['tmp_name'], $key);
        $img_url = $qiniu->getLink($key);

        return $img_url;
	}

	private function delPic($link){
		$qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete(basename($link));
	}


}