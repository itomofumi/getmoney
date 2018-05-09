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

//$Calculate = new CsvLaodPer30();
//
//if (!glob('/home/kusana/kusana.xsrv.jp/public_html/*.csv')) {
//    echo 'no target file';
//    exit;
//}
//$file_name = date('Ymd');
//$date_change_time = '00:00';
//$target_day = $t_time = date('Y-m-d H:i');
//
//  //00:00であれば前日のファイルラスト30分から取得
//  //元旦00:00なら12/31から取得
//if (strtotime(date('H:i')) == strtotime($date_change_time)) {
//    $file_name = $file_name - 1 ;
//}
//$filepath = '/home/kusana/kusana.xsrv.jp/public_html/'.$file_name.'.csv';
//
//$file = new SplFileObject($filepath);
//$file->setFlags(SplFileObject::READ_CSV);
//$time_num = (int)0;
//$success_f = (int)1;
//$rate_num = (int)4;
//foreach ($file as $line) {
//    //ターゲットタイム範囲内で読み込み終了
//    if (strtotime($line[$time_num]) < strtotime($t_time . "-30 minute")) continue;
//    if (strtotime($line[$time_num]) >= strtotime($t_time . "-30 minute")
//    && strtotime($line[$time_num]) <= strtotime($t_time)) {
//        if (!is_null($line[$time_num]) && !is_null($line[$success_f]) && !empty($line[$success_f])) {
//            $records[] = $line;
//            if ($line[$rate_num]) $rate[] = $line[$rate_num];
//        }
//    }
//    if (strtotime($line[$time_num]) > strtotime($t_time)) break;
//}
//$MAX = max($rate);
//
////価格データーの最新を取得
//$log_file_name = '/home/kusana/kusana.xsrv.jp/public_html/judgment_per30.csv';
//if (glob($log_file_name)) {
//    $file = new SplFileObject($log_file_name);
//    $file->setFlags(SplFileObject::READ_CSV);
//    foreach ($file as $line) {
//        if (!is_null($line[$time_num])) {
//            $res[] = $line;
//        }
//    }
//    $num = 1;
//
//    $data = [
//        'sar_data' => $res[count($res)-$num][2],
//        'max'      => $MAX,
//        'pre_max'  => $res[count($res)-$num][3],
//        'pre_af'   => $res[count($res)-$num][4],
//    ];
//}
//
////SAR算出実行
//$res = $Calculate->calculateSAR($data);
//
////ロギング
////$log_file_name = './'.date('Ymd');
////csv書き出し
////if (strtotime(date('H:i') == strtotime('00:00'))
//$def = $MAX-$res['sar'];
//echo $target_day.',SAR,'.$res['sar'].','.$MAX.','.$res['af'].','.$def;
//
//$fp = fopen($log_file_name, 'a');
//if (is_writable($log_file_name)) {
//    $fwrite = fwrite($fp, $target_day.',SAR,'.$res['sar'].','.$MAX.','.$res['af'].','.$def.','.end($rate)."\r\n" );
//}
//fclose($fp);
//
//exit;
