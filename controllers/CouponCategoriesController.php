<?php

namespace app\controllers;

use Yii;
use app\models\CouponCategories;
use yii\data\Pagination;
use app\models\CouponCategoryInfo;

class CouponCategoriesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionSearch() {
		$request = Yii::$app->request;
		$model = new CouponCategories;
		
		if(isset($request->get('CouponCategories')['CategoryID'])) {
			$categoryId = $request->get('CouponCategories')['CategoryID'];
			
			$categoryRecord = CouponCategories::findOne($categoryId);
			
			$count = CouponCategoryInfo::fetchCoupons($categoryId, true);
			
			$pages = new Pagination([
				'totalCount' => $count
				]);
			
			$categoryRecord->pages = $pages;
			
			$coupons = $categoryRecord->categoryCoupons;
			
		}
		else {
			$coupons = [];
			$categoryId = '';
			$pages = '';
		}
		return $this->render('search', [
			'model' => $model,
			'CategoryID' => $categoryId,
			'coupons' => $coupons,
			'pages' => $pages
		]);
	}
}
