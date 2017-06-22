<?php
/**
 * Created by PhpStorm.
 * User: Grinichev_AE
 * Date: 22.06.2017
 * Time: 11:21
 */

namespace app\models;

use Yii;

class CrossPeriod
{
    private $ds1;
    private $df1;
    private $ds2;
    private $df2;
    private $uds1;
    private $udf1;
    private $uds2;
    private $udf2;

    /**
     * CrossPeriod constructor.
     */
    public function __construct($ds1, $df1, $ds2, $df2)
    {
        $this->setDs1($ds1);
        $this->setDf1($df1);
        $this->setDs2($ds2);
        $this->setDf2($df2);


    }

    /**
     * @param mixed $ds1
     */
    public function setDs1($ds1)
    {
        $this->ds1 = $ds1;
        $this->uds1 = $this->convertToUnixTime($ds1);
    }

    /**
     * @param mixed $df1
     */
    public function setDf1($df1)
    {
        $this->df1 = $df1;
        $this->udf1 = $this->convertToUnixTime($df1);
    }

    /**
     * @param mixed $ds2
     */
    public function setDs2($ds2)
    {
        $this->ds2 = $ds2;
        $this->uds2 = $this->convertToUnixTime($ds2);
    }

    /**
     * @param mixed $df2
     */
    public function setDf2($df2)
    {
        $this->df2 = $df2;
        $this->udf2 = $this->convertToUnixTime($df2);
    }

    /**
     * @return false|int
     */
    public function getUds1()
    {
        return $this->uds1;
    }

    /**
     * @return false|int
     */
    public function getUdf1()
    {
        return $this->udf1;
    }

    /**
     * @return false|int
     */
    public function getUds2()
    {
        return $this->uds2;
    }

    /**
     * @return false|int
     */
    public function getUdf2()
    {
        return $this->udf2;
    }


    public function load($data)
    {
        $this->setDs1($data['ds1'] == "" ? null : $data['ds1']);
        $this->setDf1($data['df1'] == "" ? null : $data['df1']);
        $this->setDs2($data['ds2'] == "" ? null : $data['ds2']);
        $this->setDf2($data['df2'] == "" ? null : $data['df2']);
        return true;
    }

    private function convertToUnixTime($dt)
    {
        if (is_null($dt)) return null;

        $datetime = explode(' ', $dt);
        $date = $datetime[0];
        $time = $datetime[1];
        $h = explode(':', $time)[0];
        $i = explode(':', $time)[1];
        $s = 00;
        $m = explode('.', $date)[1];
        $d = explode('.', $date)[0];
        $y = explode('.', $date)[2];

        return mktime($h, $i, $s, $m, $d, $y);
    }

    public function showPeriods()
    {
        if (is_null($this->ds1) || is_null($this->df1) || is_null($this->ds2) || is_null($this->df2)) {
            $strPeriods = "Временные интервалы не заданы";
        } else {
            $strPeriods = "<b>Период 1: </b>" . $this->ds1 . " - " . $this->df1;
            $strPeriods .= "<br/><b>Период 2: </b>" . $this->ds2 . " - " . $this->df2;
        }
        return $strPeriods;
    }

    public function checkCross()
    {
        $format = 'php:d.m.y H:i';
        if (is_null($this->ds1) || is_null($this->df1) || is_null($this->ds2) || is_null($this->df2)) return "";
        if ($this->uds1 >= $this->udf1 || $this->uds2 >= $this->udf2) return '<div class="alert alert-danger">Периоды заданы неверно</div>';

        if ($this->uds2 > $this->udf1 || $this->udf2 < $this->uds1) {
            return '<div class="alert alert-success">Временные интервалы не пересекаются</div>';
        } else {
            if ($this->uds2 >= $this->uds1) $cs = $this->uds2;
            else $cs = $this->uds1;
            if ($this->udf2 <= $this->udf1) $cf = $this->udf2;
            else $cf = $this->udf1;
            $result = "Обнаружено пересечение временных интервалов: " . Yii::$app->formatter->asDatetime($cs, $format);
            $result .= " - " . Yii::$app->formatter->asDatetime($cf, $format);
            return '<div class="alert alert-warning ">' . $result . '</div>';
        }
    }

}