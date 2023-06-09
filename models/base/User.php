<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build
// Modified by Defri Indra
// 2021

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property integer $role_id
 * @property string $secret_token
 * @property string $fcm_token
 * @property string $photo_url
 * @property string $last_login
 * @property string $last_logout
 * @property string $register_at
 * @property integer $flag
 *
 * @property \app\models\Role $role
 * @property string $aliasModel
 */
abstract class User extends \yii\db\ActiveRecord
{
    use \app\traits\ModelTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['registered_at'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => \app\components\behaviors\UUIDBehavior::class,
                'primaryKey' => 'id',
                'model' => get_called_class(),
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'role_id'], 'required'],
            [['role_id', 'flag'], 'integer'],
            [['last_login', 'last_logout', 'registered_at'], 'safe'],
            [['username', 'name'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 250],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['secret_token'], 'string', 'max' => 400],
            [['fcm_token'], 'string', 'max' => 200],
            [['photo_url'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'username' => Yii::t('models', 'Pengguna'),
            'password' => Yii::t('models', 'Kata Sandi'),
            'name' => Yii::t('models', 'Nama'),
            'role_id' => Yii::t('models', 'Hak Akses'),
            'secret_token' => Yii::t('models', 'Token Rahasia'),
            'phone' => Yii::t('models', 'No HP'),
            'email' => Yii::t('models', 'Alamat Surel'),
            'fcm_token' => Yii::t('models', 'Token Fcm'),
            'photo_url' => Yii::t('models', 'Foto Url'),
            'last_login' => Yii::t('models', 'Login Terakhir'),
            'last_logout' => Yii::t('models', 'Logout Terakhir'),
            'registered_at' => Yii::t('models', 'Terdaftar Pada'),
            'flag' => Yii::t('models', 'Flag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(\app\models\Role::className(), ['id' => 'role_id']);
    }

    public static function find()
    {
        return new \app\models\query\UserQuery(get_called_class());
    }
}
