<?php

namespace app\models;

use Yii;
use \app\models\base\SmarthomeMasterProdukPair as BaseSmarthomeMasterProdukPair;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_smarthome_master_produk_pair".
 */
class SmarthomeMasterProdukPair extends BaseSmarthomeMasterProdukPair
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
