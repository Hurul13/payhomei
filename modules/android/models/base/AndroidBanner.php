<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build
// Modified by Defri Indra
// 2021

namespace app\modules\android\models\base;

use Yii;

/**
 * This is the base-model class for table "android_banner".
 *
 * @property string $id_kategori
 * @property string $id_route
 * @property string $gambar
 * @property string $judul
 * @property string $deskripsi
 * @property string $params
 * @property integer $order
 * @property string $id
 *
 * @property \app\modules\android\models\AndroidBannerKategori $kategori
 * @property \app\modules\android\models\AndroidRoute $route
 * @property string $aliasModel
 */
abstract class AndroidBanner extends \yii\db\ActiveRecord
{
    /**
     * BaseModel rules. 
     **/
    use \app\traits\ModelTrait;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $_render = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'android_banner';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \app\components\behaviors\UUIDBehavior::class,
                'model' => get_called_class(),
                'primaryKey' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kategori', 'id_route'], 'required'],
            [['deskripsi', 'params'], 'string'],
            [['order'], 'integer'],
            [['id_kategori', 'id_route'], 'string', 'max' => 36],
            [['gambar'], 'string', 'max' => 150],
            [['judul'], 'string', 'max' => 200],
            [['id'], 'unique'],
            [['id_kategori'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\android\models\AndroidBannerKategori::className(), 'targetAttribute' => ['id_kategori' => 'id']],
            [['id_route'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\android\models\AndroidRoute::className(), 'targetAttribute' => ['id_route' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'id_kategori' => Yii::t('models', 'Kategori'),
            'id_route' => Yii::t('models', 'Rute'),
            'gambar' => Yii::t('models', 'Gambar'),
            'judul' => Yii::t('models', 'Judul'),
            'deskripsi' => Yii::t('models', 'Deskripsi'),
            'params' => Yii::t('models', 'Parameter'),
            'order' => Yii::t('models', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(\app\modules\android\models\AndroidBannerKategori::className(), ['id' => 'id_kategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(\app\modules\android\models\AndroidRoute::className(), ['id' => 'id_route']);
    }





    public function scenarios()
    {
        $parent = parent::scenarios();

        $columns = [
            'id',
            'id_kategori',
            'id_route',
            'gambar',
            'judul',
            'deskripsi',
            'params',
            'order',
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

        if (isset($parent['id'])) :
            unset($parent['id']);
            $parent['id'] = function ($model) {
                return $model->id;
            };
        endif;
        if (isset($parent['id_kategori'])) :
            unset($parent['id_kategori']);
            $parent['id_kategori'] = function ($model) {
                return $model->id_kategori;
            };
            $parent['_kategori'] = function ($model) {
                $rel = $model->getKategori()->select('nama_kategori')->one();
                if ($rel) :
                    return $rel;
                endif;
                return null;
            };
        endif;
        if (isset($parent['id_route'])) :
            unset($parent['id_route']);
            $parent['id_route'] = function ($model) {
                return $model->id_route;
            };
            $parent['_route'] = function ($model) {
                $rel = $model->getRoute()->select([
                    'nama_route',
                    'keterangan',
                    'butuh_login',
                ])->one();
                if ($rel) :
                    return $rel;
                endif;
                return null;
            };
        endif;
        if (isset($parent['gambar'])) :
            unset($parent['gambar']);
            $parent['gambar'] = function ($model) {
                return \Yii::$app->formatter->asFileLink($model->gambar);
            };
        endif;
        if (isset($parent['judul'])) :
            unset($parent['judul']);
            $parent['judul'] = function ($model) {
                return $model->judul;
            };
        endif;
        if (isset($parent['deskripsi'])) :
            unset($parent['deskripsi']);
            $parent['deskripsi'] = function ($model) {
                return $model->deskripsi;
            };
        endif;
        if (isset($parent['params'])) :
            unset($parent['params']);
            $parent['params'] = function ($model) {
                return $model->getParams();
            };
        endif;
        if (isset($parent['order'])) :
            unset($parent['order']);
            $parent['order'] = function ($model) {
                return $model->order;
            };
        endif;



        return $parent;
    }


    public static function faker($count = 10)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \app\components\faker\provider\MyImage($faker));
        $data = [];
        $maxId = static::find()->max('id');

        // relational data
        $relationalkategori = \app\components\Constant::getIDs(\app\modules\android\models\AndroidBannerKategori::find()->select('id')->all(), 'id');
        $relationalroute = \app\components\Constant::getIDs(\app\modules\android\models\AndroidRoute::find()->select('id')->all(), 'id');
        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                "id_kategori" => \app\components\Constant::getRandomFrom($relationalkategori),
                "id_route" => \app\components\Constant::getRandomFrom($relationalroute),
                "gambar" => "tmp/" . $faker->myimage($dir = \Yii::getAlias('@webroot/uploads/tmp'), $width = 640, $height = 480, "cats", false),
                "judul" => $faker->sentence($nbWords = 6, $variableNbWords = true),
                "deskripsi" => $faker->paragraphs($nb = 3, $asText = true),
                "params" => $faker->text(),
                "order" => $faker->randomNumber(),
                "id" => $faker->unique()->numberBetween($maxId, $maxId + $count),
            ];
        }
        return $data;
    }
}
