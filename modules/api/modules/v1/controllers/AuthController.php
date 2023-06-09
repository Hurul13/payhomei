<?php

namespace app\modules\api\modules\v1\controllers;

/**
 * This is the class for REST controller "UserController".
 */

use Yii;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class AuthController extends \yii\rest\ActiveController
{
    use \app\traits\MessageTrait;
    use \app\traits\UploadFileTrait;

    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return array_merge([
            'contentNegotiator' => [
                'class' => yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'rateLimiter' => [
                'class' => \yii\filters\RateLimiter::className(),
            ],
            'authentication' => [
                'class' => \app\components\CustomAuth::class,
                'except' => ['login', 'register'],
            ]
        ], $behaviors);

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    function verbs()
    {
        return [
            'secret-method-to-check-your-token-is-valid-or-not' => ['GET', 'HEAD'],
            'this-is-really-really-secret-method-to-get-data-for-registration-another-module' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'register' => ['POST'],
            'login' => ['POST'],
            'update' => ['PUT', 'PATCH'],
        ];
    }

    public function actionSecretMethodToCheckYourTokenIsValidOrNot()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = (new \app\helpers\SsoTokenHelper)->checkToken();
        return $response;
    }

    public function actionThisIsReallyReallySecretMethodToGetDataForRegistrationAnotherModule()
    {
        $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
        if ($user == null) {
            throw new HttpException(404);
        }

        $fields = $_POST['fields'];

        $data = [];
        if (is_array($fields)) :
            foreach ($fields as $field) :
                if ($user->hasAttribute($field)) :
                    $data[$field] = $user->$field;
                endif;

            endforeach;
        else :
            if ($user->hasAttribute($fields)) :
                $data[$fields] = $user->$fields;
            endif;
        endif;

        return [
            "success" => true,
            "message" => $this->messageFetchSuccess(),
            "data" => $data,
        ];
    }

    public function actionRegister()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;


        $user = new \app\models\User;
        $user->scenario = \app\models\User::SCENARIO_REGISTER_APP;

        $request = \yii::$app->request->post();
        $user->load($request, '');

        $user->phone = \app\components\Constant::purifyPhone($user->phone);
        $user->role_id = \app\models\User::ROLE_USER_REGULER; // role
        if ($user->validate()) {
            $user->password = \Yii::$app->security->generatePasswordHash($user->password);
            $generate_random_string = (new \app\helpers\SsoTokenHelper)->generateToken();
            $user->secret_token = $generate_random_string;
            $user->save();

            return ['success' => true, 'message' => Yii::t("action_message", "Berhasil melakukan registrasi"), 'token' => $user->secret_token];
        } else {
            throw new HttpException(422, $this->message422(
                \app\components\Constant::flattenError(
                    $user->getErrors()
                )
            ));
        }
    }

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $user = \app\models\User::findByUsername($_POST['username']);

            if (isset($user)) :
                if (\Yii::$app->security->validatePassword($_POST['password'], $user->password) == false)
                    throw new HttpException(400, Yii::t("action_message", "User tidak dapat ditemukan"));

                $user->scenario = $user::SCENARIO_UPDATE;
                $generate_random_string = (new \app\helpers\SsoTokenHelper)->generateToken();
                $user->secret_token = $generate_random_string;
                $user->fcm_token = $_POST['fcm_token'];
                $user->validate();
                $user->save();

                $token = $generate_random_string;

                return (object) [
                    "success" => true,
                    "message" => Yii::t("action_message", "Login Berhasil"),
                    "token" => $token,
                ];
            endif;
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        throw new HttpException(400, Yii::t("action_message", "Login gagal"));
    }

    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request->bodyParams;

        $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
        $photo_url = $user->photo_url;
        $user->scenario = $user::SCENARIO_UPDATE;
        $user->load($request);

        $user->phone = \app\components\Constant::purifyPhone($user->phone);
        $image = UploadedFile::getInstanceByName("photo_url");
        if ($image) {
            $response = $this->uploadImage($image, "user");
            if ($response->success == false) throw new HttpException(419, $this->messageImageFailedUpload());
            $user->photo_url = $response->fileName;
        } else {
            $user->photo_url = $photo_url;
        }

        if ($user->validate()) {
            $password = $request["User"]['password'];
            if ($password) $user->password = \Yii::$app->security->generatePasswordHash($user->password);

            $user->save();

            return [
                "success" => true,
                "message" => Yii::t("action_message", "Profil berhasil diubah"),
                "data" => $user,
            ];
        }

        throw new HttpException(422, $this->message422(
            \app\components\Constant::flattenError(
                $user->getErrors()
            )
        ));
    }

    public function actionView()
    {
        $user = \app\models\User::findOne(["id" => Yii::$app->user->id]);
        if ($user == null) throw new HttpException(404, $this->message404());

        return [
            "success" => (1 == 1),
            "message" => $this->messageFetchSuccess(),
            "data" => $user,
        ];
    }
}
