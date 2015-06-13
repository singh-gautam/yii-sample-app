<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CouponCategoryInfo".
 *
 * @property integer $CategoryInfoID
 * @property integer $CouponID
 * @property integer $CategoryID
 * @property integer $SubCategoryID
 * @property integer $isFeaturedUnderCategory
 * @property integer $FeaturedRankUnderCategory
 * @property string $CategoryFeatureEndTime
 * @property integer $CategoryType
 */
class CouponCategoryInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CouponCategoryInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CouponID', 'CategoryID', 'SubCategoryID'], 'required'],
            [['CouponID', 'CategoryID', 'SubCategoryID', 'isFeaturedUnderCategory', 'FeaturedRankUnderCategory', 'CategoryType'], 'integer'],
            [['CategoryFeatureEndTime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryInfoID' => 'Category Info ID',
            'CouponID' => 'Coupon ID',
            'CategoryID' => 'Category ID',
            'SubCategoryID' => 'Sub Category ID',
            'isFeaturedUnderCategory' => 'Is Featured Under Category',
            'FeaturedRankUnderCategory' => 'Featured Rank Under Category',
            'CategoryFeatureEndTime' => 'Category Feature End Time',
            'CategoryType' => 'Category Type',
        ];
    }

    public static function fetchCoupons($categoryId, $counterFlag = false) {
        $query = CouponCategoryInfo::find()
                ->where(['CategoryID' => $categoryId]);
        
        if($counterFlag) {
            return $query->count();
        } else {
            return $query->all();
        }
    }
    
    public static function fetchCategories($couponId, $counterFlag = false) {
        $query = CouponCategoryInfo::find()
                ->where(['CouponID' => $couponId]);
        
        if($counterFlag) {
            return $query->count();
        } else {
            return $query->all();
        }
    }
}
