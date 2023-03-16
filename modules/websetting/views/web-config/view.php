<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use app\components\annex\Tabs;

/**
 * @var yii\web\View $this
 * @var app\modules\websetting\models\WebConfig $model
 */

$this->title = 'Web Config : ' . $model->name;
?>
<div class="giiant-crud web-config-view">
    <?php if (Yii::$app->request->isAjax == false) : ?>
        <!-- menu buttons -->
        <p class='pull-left'>
            <?= Html::a('<span class="fa fa-pencil"></span> ' . Yii::t('cruds', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('<span class="fa fa-plus"></span> ' . Yii::t('cruds', 'Tambah Baru'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <p class="pull-right">
            <?= Html::a('<span class="fa fa-list"></span> ' . Yii::t('cruds', 'Daftar Web Config'), ['index'], ['class' => 'btn btn-default']) ?>
        </p>
    <?php endif ?>

    <div class="clearfix"></div>

    

    <div class="row">
        <div class="col-md-12">
            <?php if (Yii::$app->request->isAjax == false) : ?>
                <div class="card m-b-30">
                    <div class="card-body">
                    <?php endif ?>
                    <?php $this->beginBlock('app\modules\websetting\models\WebConfig'); ?>

                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-striped table-borderless'],
                        'attributes' => [
                            // modified by Defri Indra
                            // [
                            //     'format' => 'html',
                            //     'attribute' => 'group_id',
                            //     'value' => ($model->group ? $model->group->name : '<span class="label label-warning">?</span>'),
                            // ],
                            [
                                'attribute' => 'name',
                                'format' => 'text',
                                'value' => function ($model) {
                                    return ($model->group ? $model->group->name . "." : '') . $model->name;
                                }
                            ],
                            [
                                'attribute' => 'value',
                                'format' => 'ntext',
                            ],
                            [
                                'attribute' => 'default',
                                'format' => 'ntext',
                            ],
                            [
                                'attribute' => 'active',
                                'format' => 'text',
                                'value' => $model->getActive(),
                            ],
                        ],
                    ]); ?>

                    <hr />

                    <?= Html::a(
                        '<span class="fa fa-trash"></span> ' . Yii::t('cruds', 'Delete'),
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-danger',
                            'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
                            'data-method' => 'post',
                        ]
                    ); ?>
                    <?php $this->endBlock(); ?>



                    <?= Tabs::widget(
                        [
                            'id' => 'relation-tabs',
                            'encodeLabels' => false,
                            'items' => [
                                [
                                    'label'   => '<b class=""># ' . $model->id . '</b>',
                                    'content' => $this->blocks['app\modules\websetting\models\WebConfig'],
                                    'active'  => true,
                                ],
                            ]
                        ]
                    );
                    ?> <?php if (Yii::$app->request->isAjax == false) : ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>