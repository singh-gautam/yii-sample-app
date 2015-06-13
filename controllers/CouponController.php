<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Coupon;
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
		$model = new Coupon;

		$flagRequested = false;
		$IsDeal = 0;

		$queryString = $request->get();

		if( isset($queryString["Coupon"]) ) {
			$flagRequested = true;
			$IsDeal = $queryString["Coupon"]['IsDeal'];
		}

		if( $flagRequested == true ) {
			$query = Coupon::find()
				->select([
					'CouponID',
					'CouponCode',
					'IsDeal',
					'Title'
				])
				->where(['isDeal' => $IsDeal])
				->limit(20);

			$counter = clone $query;
			$pages = new Pagination(['totalCount' => $counter->count()]);

			$coupons = $query->offset($pages->offset)
				->limit($pages->limit)
				->all();

		} else {
			$coupons = [];
			$message = '';
			$pages = '';
		}

		return $this->render('coupons', [
			'model' => $model,
			'coupons' => $coupons,
			'pages' => $pages
		]);
    }
}
