<?php

namespace app\models;

use Yii;
use \app\models\base\SmarthomeKontrol as BaseSmarthomeKontrol;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_smarthome_kontrol".
 */
class SmarthomeKontrol extends BaseSmarthomeKontrol
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
