<?php

use app\models\CrossPeriod;
use kartik\datetime\DateTimePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CrossPeriod */

//$crossPeriod = new CrossPeriod('20.11.2017', '2', '3', '4');
$format = 'php:d.m.y H:i';

$this->title = 'Пример';
?>
<div class="site-index">


    <?

    //  echo $crossPeriod->showPeriods();
    echo $model->showPeriods();
    echo $model->checkCross();

    $pick1 = DateTimePicker::widget([
        'name' => 'ds1',
        'value' => is_null($model->getUds1()) ? '' : Yii::$app->formatter->asDatetime($model->getUds1(), $format),
        'options' => ['placeholder' => 'Выберите время ...'],
        'convertFormat' => true,
        'pluginOptions' => [

            'format' => $format,
            'startDate' => time(),
            'todayHighlight' => true
        ]
    ]);

    $pick2 = DateTimePicker::widget([
        'name' => 'df1',
        'value' => is_null($model->getUdf1()) ? '' : Yii::$app->formatter->asDatetime($model->getUdf1(), $format),
        'options' => ['placeholder' => 'Выберите время ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => $format,
            'startDate' => time(),
            'todayHighlight' => true
        ]
    ]);

    $pick3 = DateTimePicker::widget([
        'name' => 'ds2',
        'value' => is_null($model->getUds2()) ? '' : Yii::$app->formatter->asDatetime($model->getUds2(), $format),
        'options' => ['placeholder' => 'Выберите время ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => $format,
            'startDate' => time(),
            'todayHighlight' => true
        ]
    ]);

    $pick4 = DateTimePicker::widget([
        'name' => 'df2',
        'value' => is_null($model->getUdf2()) ? '' : Yii::$app->formatter->asDatetime($model->getUdf2(), $format),
        'options' => ['placeholder' => 'Выберите время ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => $format,
            'startDate' => time(),
            'todayHighlight' => true
        ]
    ]);

    echo "<p>";

    $form = ActiveForm::begin();
    ?>

    <table class="table table-striped table-bordered">
        <tr>
            <td></td>
            <td>Старт</td>
            <td>Финиш</td>
        </tr>
        <tr>
            <td>Период 1</td>
            <td><?= $pick1 ?></td>
            <td><?= $pick2 ?></td>
        </tr>
        <tr>
            <td>Период 2</td>
            <td><?= $pick3 ?></td>
            <td><?= $pick4 ?></td>
        </tr>
    </table>

    <?


    echo "<br/>" . Html::submitButton("Проверить", ['class' => 'btn btn-primary']);
    ActiveForm::end();


    echo "</p>";

    ?>
</div>
