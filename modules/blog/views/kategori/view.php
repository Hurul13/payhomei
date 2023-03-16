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
* @var app\modules\blog\models\Kategori $model
*/

$this->title = Yii::t('cruds', 'Kategori') . ' : ' . $model->id;
?>
<div class="giiant-crud kategori-view">
    <?php if(Yii::$app->request->isAjax == false) : ?>
    <!-- menu buttons -->
    <p class='pull-left'>
        <?= Html::a('<span class="fa fa-pencil"></span> ' . Yii::t('cruds', 'Ubah'), ['update', 'id' => $model->id],['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="fa fa-plus"></span> ' . Yii::t('cruds', 'Tambah Baru'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
        <?= Html::a('<span class="fa fa-list"></span> ' . Yii::t('cruds', 'Daftar Kategori'), ['index'], ['class'=>'btn btn-default']) ?>
    </p>
    <?php endif ?>

    <div class="clearfix"></div>

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <?php if(Yii::$app->request->isAjax == false) : ?>
            <div class="card m-b-30">
                <div class="card-body">
                <?php endif ?>
                    <?php $this->beginBlock('app\modules\blog\models\Kategori'); ?>
                    <div class="table-responsive">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-borderless'],
                            'attributes' => [
    					        [
            'attribute' => 'nama_kategori',
            'format' => 'text',
        ],
                            ],
                        ]); ?>
                    </div>

                    <hr/>

                    <?= Html::a('<span class="fa fa-trash"></span> ' . Yii::t('cruds', 'Delete'), ['delete', 'id' => $model->id],
                    [
                    'class' => 'btn btn-danger',
                    'data-confirm' => '' . Yii::t('cruds', 'Are you sure to delete this item?') . '',
                    'data-method' => 'post',
                    ]); ?>
                    <?php $this->endBlock(); ?>


                    
<?php $this->beginBlock('PostKategoris'); ?>
<div style='position: relative'><div style='position:absolute; right: 0px; top: 0px;'>
  <?= Html::a(
                                    '<span class="fa fa-list"></span> ' . Yii::t('cruds', 'Semua Data') . ' Post Kategoris',
                                    ['post-kategori/index'],
                                    ['class'=>'btn text-muted btn-xs']
                                ) ?>
  <?= Html::a(
                                    '<span class="fa fa-plus"></span> ' . Yii::t('cruds', 'Tambah Baru') . ' Post Kategori',
                                    ['post-kategori/create', 'PostKategori' => ['Array' => $model->id]],
                                    ['class'=>'btn btn-success btn-xs']
                                ); ?>
</div></div><?php Pjax::begin(['id'=>'pjax-PostKategoris', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-PostKategoris ul.pagination a, th a', 'clientOptions' => ['pjax:success'=>'function(){alert("defrindr")}']]) ?>
<?= '<div class="table-responsive">'
 .                     \yii\grid\GridView::widget([
                        'layout' => '{summary}{pager}<br/>{items}{pager}',
                        'dataProvider' => new \yii\data\ActiveDataProvider([
                            'query' => $model->getPostKategoris(),
                            'pagination' => [
                                'pageSize' => 20,
                                'pageParam'=>'page-postkategoris',
                            ]
                        ]),
                        'pager'        => [
                            'class'          => \app\components\annex\LinkPager::className(),
                            'firstPageLabel' => Yii::t('cruds', 'First'),
                            'lastPageLabel'  => Yii::t('cruds', 'Last')
                        ],
                        'columns' => [
                     [
                        'class'      => 'yii\grid\ActionColumn',
                        'template'   => '{view} {update}',
                        'contentOptions' => ['nowrap'=>'nowrap'],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            // using the column name as key, not mapping to 'id' like the standard generator
                            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                            $params[0] = 'post-kategori' . '/' . $action;
                            $params['PostKategori'] = ['id_kategori' => $model->primaryKey()[0]];
                            return $params;
                        },
                        'buttons'    => [
                            
                        ],
                        'controller' => 'post-kategori'
                    ],
                    // modified by Defri Indra
                    [
                        'class' => yii\grid\DataColumn::className(),
                        'attribute' => 'id_post',
                        'value' => function ($model) {
                            if ($rel = $model->post) {
                                return $rel->title;
                            } else {
                                return '';
                            }
                        },
                        'format' => 'raw',
                    ],
]
                    ])
 . '</div>' ?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


                    <?= Tabs::widget(
                    [
                        'id' => 'relation-tabs',
                        'encodeLabels' => false,
                        'items' => [ 
                                                [
                        'label'   => '<b class=""># '.$model->id.'</b>',
                        'content' => $this->blocks['app\modules\blog\models\Kategori'],
                        'active'  => true,
                    ],                        [
                            'content' => $this->blocks['PostKategoris'],
                            'label'   => '<small>Post Kategoris <span class="badge badge-default">'.count($model->getPostKategoris()->asArray()->all()).'</span></small>',
                            'active'  => false,
                        ],
                        ]
                    ]);
                    ?>                <?php if(Yii::$app->request->isAjax == false) : ?>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>