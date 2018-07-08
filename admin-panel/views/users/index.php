<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'type',
            'name',
            'email:email',
            'gender',
            'contact_number',
            'is_verified',
            'is_featured',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} <br/> {feature} {verify}',
                'buttons' => [
                    'verify' => function ($url, $model, $key) {
                        if ($model->is_verified == 0) {
                            return Html::a('Verify', ['verify', 'id' => $model->id]);
                        } else if ($model->is_verified == 1) {
                            return Html::a('Unverify', ['unverify', 'id' => $model->id]);
                        }
                    },
                    'feature' => function ($url, $model, $key) {
                        if ($model->is_featured == 0) {
                            return Html::a('Feature', ['feature', 'id' => $model->id]);
                        } else if ($model->is_featured == 1) {
                            return Html::a('UnFeature', ['unfeature', 'id' => $model->id]);
                        }
                    }],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
