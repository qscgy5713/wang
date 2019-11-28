<?php
/**
 * 人數圖表
 */
class MemberChartAction extends AdminAction{
	public function index(){
            $request = $this->getRequest();
            if(empty($request['today'])){
                  $today = date("Y-m-d");
            } else {
                  $today = $request['today'];
            }
      	$CommonMemberStatistics = D('CommonMemberStatistics');
      	$showArray = array();
            $time = explode('-', $today);
            if($time[2] == date('d', time())){
                  $hour = date('H',time());
                  $day = date('d', time());
                  $month = date('m', time());
                  $year = date('Y', time());
            } else {
                  $hour = 23;
                  $day = $time[2];
                  $month = $time[1];
                  $year = $time[0];
            }

            $data = array(
                  'time' => array(
                        'hour' => $hour,
                        'day' => $day,
                        'month' => $month,
                        'year' => $year,
                  ),
            );
            $return = $CommonMemberStatistics->getMemberStatisticsData($data);

      	$timeName['totalMem'] = '總人數';
      	$timeName['totalPc'] = '使用電腦人數';
      	$timeName['totalPhone'] = '使用手機人數';
      	$timeName['totalAll'] = '都使用人數';
      	$timeName['totalApple'] = '使用蘋果系統';
      	$timeName['totalAndroid'] = '使用安卓系統';
      	$timeName['totalAllSys'] = '使用兩種系統';
      	$timeName['withdrawName'] = '出售次數';
      	$timeName['rechargeName'] = '儲值次數';
      	$timeName['registeredName'] = '註冊人數';
            $timeName['withdrawMoney'] = '出售金額';
            $timeName['rechargeMoney'] = '儲值金額';
      	$total['withdrawName'] = '總出售金額';
            $total['rechargeName'] = '總儲值金額';
      	foreach ($return as $key => $value) {
      		$time['hour'][] = $value['statistics_hour']; //時間
      		$time['peopleTotal'][] = $value['statistics_onlineNumber']; //總人數
      		$time['pcUse'][] = $value['statistics_pcUseNumber']; //電腦使用
      		$time['phoneUse'][] = $value['statistics_phoneUseNumber']; //手機使用
      		$time['allUse'][] = $value['statistics_allUseNumber']; //都使用
      		$time['apple'][] = $value['statistics_appleNumber']; //蘋果
      		$time['android'][] = $value['statistics_androidNumber']; //安卓
      		$time['allSystem'][] = $value['statistics_allSystemNumber']; //雙系統
      		$time['withdrawPer'][] = $value['statistics_totalWithdrawNumber']; //脫售人數
      		$time['rechargePer'][] = $value['statistics_totalRechargeNumber']; //儲值人數
                  $time['registeredPer'][] = $value['statistics_totalRegisteredNumber']; //創號人數
                  $time['withdrawTotal'][] = $value['statistics_totalWithdrawMoney']; //創號人數
      		$time['rechargeTotal'][] = $value['statistics_totalRechargeMoney']; //創號人數
	      	$total['withdrawTotal'] += $value['statistics_totalWithdrawMoney']; //脫售金額
	      	$total['rechargeTotal'] += $value['statistics_totalRechargeMoney']; //儲值金額
      	}
      	$timeData = json_encode($time, JSON_UNESCAPED_UNICODE);
            $totalData = json_encode($total, JSON_UNESCAPED_UNICODE);
      	$timeNameData = json_encode($timeName, JSON_UNESCAPED_UNICODE);
            $this->assign('today', $today);
            $this->assign('timeData', $timeData);
            $this->assign('timeNameData', $timeNameData);
      	$this->assign('totalData', $totalData);
		$this->display();
	}
}