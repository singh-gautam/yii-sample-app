<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Coupon;

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

}
