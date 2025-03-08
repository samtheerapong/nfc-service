<?php

namespace app\components;

use Yii;

class StaticHelper
{
    public static function getStatusApprove()
    {
        return [
            '2' => 'อนุมัติ',
            '1' => 'รออนุมัติ',
            '0' => 'ไม่อนุมัติ',
        ];
    }

    public static function getStatusOption($statusId)
    {
        switch ($statusId) {
            case 1:
                return '<span class="badge" style="background-color: #fd7e14;">รออนุมัติ</span>';
            case 2:
                return '<span class="badge" style="background-color: #028391;">อนุมัติ</span>';
            default:
                return '<span class="badge" style="background-color: #dc3545;">ไม่อนุมัติ</span>';
        }
    }

    public static function getGridPagerConfig()
    {
        return [
            'class' => \yii\widgets\LinkPager::class,
            'firstPageLabel' => Yii::t('app', 'First'),
            'lastPageLabel' => Yii::t('app', 'Last'),
            'options' => ['class' => 'pagination justify-content-center'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['class' => 'page-link'],
        ];
    }

    public static function getYearOptions()
    {
        $currentYear = date('Y');
        return [
            $currentYear + 1 => $currentYear + 1,
            $currentYear => $currentYear,
            $currentYear - 1 => $currentYear - 1,
        ];
    }
}
