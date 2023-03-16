<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build
// Modified by Defri Indra
// 2021

namespace app\modules\websetting\models\base;

use Yii;

/**
 * This is the base-model class for table "web_config_group".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \app\modules\websetting\models\WebConfig[] $webConfigs
 * @property string $aliasModel
 */
abstract class WebConfigGroup extends \yii\db\ActiveRecord
{
    use \app\traits\ModelTrait;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $_render = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_config_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        'id' => Yii::t('models', 'ID'),
        'name' => Yii::t('models', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebConfigs()
    {
        return $this->hasMany(\app\modules\websetting\models\WebConfig::class, ['group_id' => 'id']);
    }





    public function scenarios()
    {
        $parent = parent::scenarios();

        $columns = [
            'id',
            'name',
        ];

        $parent[static::SCENARIO_CREATE] = $columns;
        $parent[static::SCENARIO_UPDATE] = $columns;
        return $parent;
    }

    /**
     * @inheiritance
     */
    public function fields()
    {
        $parent = parent::fields();

        if(isset($parent['id'])) :
            unset($parent['id']);
            $parent['id'] = function($model) {
                return $model->id;
            };
        endif;
        if(isset($parent['name'])) :
            unset($parent['name']);
            $parent['name'] = function($model) {
                return $model->name;
            };
        endif;


    // $parent['web_config'] = function($model) {
    //     $rel = $model->webConfigs;
    //     if($rel) :
    //         return $rel;
    //     endif;
    //     return null;
    // };

        return $parent;
    }


    public function faker(){
        $faker= \Faker\Factory::create();
        $data = [ 
            "id" => $faker->unique()->randomNumber(11),
            "name" => $faker->name,
        ];
        return $data;
    }

}