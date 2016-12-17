<?php 

namespace app\controllers\index;

use Yii;
use yii\web\Controller;
use crazyfd\qiniu\Qiniu;
use app\models\ProductComment;
use app\models\CommentPic;

/**
* 
*/
class CommentController extends Controller
{
	
	public function actionAdd(){
		// $user_id = Yii::$app->session['font']['user_id'];
		$user_id = 1;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$post['user_id'] = $user_id;

			if (isset($_FILES['covers'])) {
				$covers = $this->uploadPics();
			}
            
            $transaction = Yii::$app->db->beginTransaction();
			try{

			    $ProductComment = new ProductComment;
			    $add_status = $ProductComment->addComment($post);

			    if (isset($covers)) {
			    	foreach ($covers as $key => $value) {
			    		$covers[$key]['comment_id'] = $add_status['data']['comment_id'];
			    	}
			    	$pic_status = Yii::$app->db->createCommand()
			             ->batchInsert(CommentPic::tableName(),['img_url','comment_id'],$covers)
			             ->execute();
			    }

			    if($add_status['code'] == 1 || !$pic_status){
			    	throw new \Exception('添加失败！');
			    }
			    
			    $transaction->commit(); 
			}catch (\Exception $e){
			    $transaction->rollBack();
			    echo "添加失败";
			    return;
			}
			echo '添加成功';

		}
	}

	private function uploadPics(){
		$covers = [];
		$qiniu = new Qiniu(ProductComment::AK, ProductComment::SK, ProductComment::DOMAIN, ProductComment::BUCKET);
		foreach ($_FILES['covers']['tmp_name'] as $key => $value) {
			if ($_FILES['covers']['error'][$key] > 0) {
				return false;
			}
			$k = uniqid();
            $qiniu->uploadFile($value, $k);
            $covers[$key]['img_url'] = $qiniu->getLink($k);
		}

        return $covers;
	}
}