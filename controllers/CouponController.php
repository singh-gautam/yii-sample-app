<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Coupon;
use app\models\CouponCategories;
use app\models\CouponCategoryInfo;

use yii\data\Pagination;

class CouponController extends Controller
{
	
    public function actionIndex()
    {
		$coupons = Coupon::find()
			->where(['isDeal' => 0])
			->andWhere(['IS NOT', 'CouponCode', null])
			->andWhere(['!=', "CouponCode", ''])
			->orderBy('CouponCode')
			->limit(60)
			->all();


    	$deals = Coupon::find()
    		->where(['isDeal' => 1])
    		->andWhere(['IS NOT', 'CouponCode', null])
    		->andWhere(['!=', "CouponCode", ''])
    		->orderBy('CouponCode')
    		->limit(60)
    		->all();
		
        
        return $this->render('index', [
        	'deals' => $deals, 
        	'coupons' => $coupons]
        	);
    }

    public function actionSearch() {
		
		$request = Yii::$app->request;
		
		$IsRequested = false;
		$pages = '';
		
		$model = array();
		$model['Coupon'] = new Coupon;
		$model['CouponCategories'] = new CouponCategories;

		$queryString = $request->get();
		
		$CouponCategoriesModel = $model['CouponCategories'];
		$categories = $CouponCategoriesModel->fetchDistinctCategories(['CategoryID', 'Name']);
		
		//Filter on Category
		if( isset($queryString['CouponCategories']['CategoryID']) && !empty($queryString['CouponCategories']['CategoryID'])) {
			$categoryId = $queryString['CouponCategories']['CategoryID'];
			
			$categoryRecord = CouponCategories::findOne($categoryId);
			
			$count = CouponCategoryInfo::fetchCoupons($categoryId, true);
			
			$coupons = $categoryRecord->categoryCoupons;
			
			$IsRequested = true;
		}
		else {
			$coupons = [];
			$categoryId = '';
		}
		
		//Filter on isDeal
		if( isset($queryString["Coupon"]["IsDeal"]) ) {
			$IsDeal = $queryString["Coupon"]['IsDeal'];
		}
		else {
			$IsDeal = 0;
		}
			
		$where = array();
		$where["isDeal"] = $IsDeal;

		if(sizeof($coupons) > 0) {
			
			$couponIds = array();
			foreach($coupons as $coupon) {
				array_push($couponIds, $coupon['CouponID']);
			}

			$where['CouponID'] = $couponIds;
		}

		$query = Coupon::find()
			->select(['CouponID','CouponCode','IsDeal','Title'])
			->where($where);
		
		$counter = clone $query;
		$count = $counter->count();
		
		$pages = new Pagination(['totalCount' => $count]);

		$coupons = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();
		
		// var_dump($coupons);
		// die();

		return $this->render('search', [
			'model' => $model,
			'coupons' => $coupons,
			'pages' => $pages,
			'CategoryID' => $categoryId,
			'categories' => $categories
		]);
    }
}
