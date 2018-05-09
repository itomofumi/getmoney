<?php
namespace lib\csvload;

class CsvLaodPer30
{
    //全SAR値
    const PRESAR = 0;
    //加速因数
    const AF = 0.02;
    //加速幅
    const ACCELERATIONFACTER = 0.02;

  //SAR(Stop And Reverse Point)=前日のSAR+AF×(EP-前日のSAR)
  //AF(Acceleration Factor)：加速因数0.02≦AF≦0.2(日・週・月共)
  //EP(Extreme Point)：極大値/SARが買いサイン中はその期間の最高値・SARが売りサイン中はその期間の最安値

    public function echoEP ()
    {
        echo 'EP!';
    }

    public function calculateSAR (array $data)
    {
        if ($data) {
            $SARDATA = $data["sar_data"];
            $MAX     = $data["max"];
            $preMAX  = $data["pre_max"];
            $preAF   = $data["pre_af"];
        }
        $preSAR = self::PRESAR;
        $AF     = self::AF;
        if ($SARDATA) $preSAR = $SARDATA;
        if ($preAF) $AF = $preAF;
        if ($preMAX) {
            if ($preMAX < $MAX /*AND $preSAR < $preMAX*/ AND $AF <= 0.18) {
                $AF = $AF+self::ACCELERATIONFACTER;
            } elseif ($preMAX > $MAX) {
                $AF = self::ACCELERATIONFACTER;
            }
        }
        $EP = $MAX;
        $SAR = $preSAR+($AF*($EP-$preSAR));

        return $res = [
            'sar' => floor($SAR),
            'af' => $AF,
        ];
    }
}
