<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use app\components\ModalButton;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\android\models\search\AndroidBannerKategoriSearch $searchModel
 */

$this->title = Yii::t('cruds', 'Kategori Banner');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= ModalButton::a('<i class="fa fa-plus"></i>' . Yii::t('cruds', 'Tambah Baru'), ['create'], ['class' => 'btn btn-success', 'title' => Yii::t('cruds', 'Tambah Baru')]) ?>
</p>

<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <?php echo $this->render('_index', ['dataProvider' => $dataProvider]); ?>
            </div>
        </div>
    </div>
</div>
<?php \yii\widgets\Pjax::end() ?>