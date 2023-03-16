<?php

namespace app\models;

use Yii;
use \app\models\base\SmarthomeLog as BaseSmarthomeLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_smarthome_log".
 */
class SmarthomeLog extends BaseSmarthomeLog
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
