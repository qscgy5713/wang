
<?php
//系統紀錄
class SystemLogAction extends AdminAction{
	protected $systemLog = 10; //分頁筆數
	protected $pageMoreNumber = 5; //一 頁最多幾筆
	public function index(){
		$request = $this->getRequest();

		//時間列表 開始
	    $today = date('Y-m-d');
	    $startTime = $today.' 00:00:00';
	    $endTime = $today.' 23:59:59';

	    if(isset($request['startTime'])){
	        $startTime = $request['startTime'];
	    }
	    if(isset($request['endTime'])){
	        $endTime = $request['endTime'];
	    }
	    if(date('D') === 'Mon') {
	        $tsThisWeek = strtotime('today');
	    } else {
	        $tsThisWeek = strtotime('last monday');
	    }
	    $tsYesterday = strtotime('yesterday');
	    $tsLastMonth = strtotime('last month')-((60*60*24*(date('d')-1)));
	    $tsThisMonth = strtotime('this month')-((60*60*24*(date('d')-1)));
	    $lastWeekA = date('Y-m-d',$tsThisWeek-(60*60*24*7));
	    $lastWeekB = date('Y-m-d',$tsThisWeek-(60*60*24*1));
	    $thisWeekA = date('Y-m-d',$tsThisWeek+(60*60*24*0));
	    $thisWeekB = date('Y-m-d',$tsThisWeek+(60*60*24*6));
	    $yesterday = date('Y-m-d',$tsYesterday);
	    $lastMonthA = date('Y-m-d',$tsLastMonth);
	    $lastMonthB = date('Y-m-d',$tsLastMonth+(60*60*24*(cal_days_in_month(CAL_GREGORIAN,date("m",strtotime($lastMonthA)),date("Y", strtotime($lastMonthA)))-1)));
	    $thisMonthA = date('Y-m-d',$tsThisMonth);
	    $thisMonthB = date('Y-m-d',$tsThisMonth+(60*60*24*(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"))-1)));
	    $this->assign("startTime",$startTime);//查詢開始時間
	    $this->assign("endTime",$endTime);//查詢最後時間
	    $this->assign("today",$today);//今日
	    $this->assign("yesterday",$yesterday);//昨日
	    $this->assign("thisWeekA",$thisWeekA);//本週第一天
	    $this->assign("thisWeekB",$thisWeekB);//本週最後一天
	    $this->assign("lastWeekA",$lastWeekA);//上週第一天
	    $this->assign("lastWeekB",$lastWeekB);//上週最後一天
	    $this->assign("thisMonthA",$thisMonthA);//本月第一天
	    $this->assign("thisMonthB",$thisMonthB);//本月最後一天
	    $this->assign("lastMonthA",$lastMonthA);//上月第一天
	    $this->assign("lastMonthB",$lastMonthB);//上月最後一天
	    //時間列表 結束
        
        //製作分頁
        if(empty($request['pageNumber'])){
            $pageNumber = 1;
        } else {
            $pageNumber = $request['pageNumber'];
        }

		$CommonSystemLog = D('CommonSystemLog');
		$data = array(
            "startTime"=>strtotime($startTime),
            "endTime"=>strtotime($endTime),
		);

		//取得總筆數
		$return = $CommonSystemLog->getSystemLogDataTotal($data);
		$totalNumber = $return['totalNumber']; //總筆數
		$totalPage = ceil($totalNumber / $this->systemLog); //總頁數
		$pageArray = getPageArray($pageNumber, $totalPage, $this->pageMoreNumber); //分頁陣列


		$data = array(
            "startTime"=>strtotime($startTime),
            "endTime"=>strtotime($endTime),
            'page' => array(
            	'pageNumber' => $pageNumber,
            	'number' => $this->systemLog,
            ),
		);
		$return = $CommonSystemLog->getSystemLogData($data);

		$showStr = "";
		$FieldChange = array(
			'log_id' => 'id',
			'log_createTime' => 'logCreateTime',
			'log_function' => 'logFunction',
			'log_session' => 'logSeeion',
			'log_data' => 'logData',
			'log_result' => 'logResult',
			'log_error' => 'logError',
			'log_ip' => 'logIp',
			'log_url' => 'logUrl',
		);
		$showArray = array();
		foreach ($return as $key => $value) {
			foreach ($FieldChange as $key1 => $value1) {
				switch ($key1) {
					case 'log_createTime':
						$showStr = date('m-d H:i:s', $value[$key1]);
						break;
					case 'log_ip':
						$showStr = get_ip_inet_ntop($value[$key1]);//IP轉換可讀格式
						break;
					default:
						$showStr = $value[$key1];
						break;
				}
				$showArray[$key][$value1] = $showStr;
			}
		}
		$this->assign('showArray', $showArray);
        $this->assign("totalPage", $totalPage); //總頁數
        $this->assign("pageNumber", $pageNumber); //目前頁數
        $this->assign("pageArray", $pageArray); //頁數陣列
        $this->assign("showEmpty","<tr><td colspan='9' align='center'>無資料</td></tr>");
		$this->display();
	}
}