<?php
class ProcessMailAction extends AdminAction{
	protected $processMail = 10; //分頁筆數
	protected $pageMoreNumber = 5; //一頁最多幾筆
	//TODO: 處理信件 首頁
	public function index(){
		$request = $this->getRequest();

		$CommonMemberMail = D("CommonMemberMail");

		//CommonMemberMail getCommonMemberMailData取得頁面類別資料
		$return = $CommonMemberMail->getCommonMemberMailData();

		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}
		// var_dump($return);die;
		$showArray = array();

		//使用欄位轉換 資料庫欄位
		$FieldChange = array(
			'mail_id' => 'id',
			'member_id' => 'memberId',
		    'member_account' => 'memberAccount',
			'mail_createTime' => 'createTime',
			'mail_status' => 'status',
			'mail_title' => 'title',
			'mail_main' => 'main',
			'mail_ip' => 'ip',
			'admin_id' => 'adminId',
			'mail_modifyTime' => 'modifyTime',
			'mail_reply' => 'reply',
		);

		$showStr = "";
        $allDataId = "";
		foreach($return as $key => $value){
            if(empty($allDataId)){
                $allDataId = $value['mail_id'];
            } else {
                $allDataId .= ','.$value['mail_id'];
            }
			foreach ($FieldChange as $key1 => $value1) {
				//欄位特別處理
				switch ($key1) {
					case 'mail_ip': //IP轉換
						$showStr = get_ip_inet_ntop($value[$key1]);//IP轉換可讀格式
						break;

					case 'mail_createTime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;

                    case 'mail_modifyTime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = "無修改時間";
                        if(!empty($value[$key1])){
                            $showStr = date('m-d H:i:s', $value[$key1]);
                        }
                        break;
                    case 'admin_id': //無客服ID
                    	$showStr = $value[$key1];
                    	if($value[$key1] == null){
                    		$showStr = "無客服ID";
                    	}
						break;
					case 'mail_status':
						if ($value[$key1] == 2) {
                    		$showStr = "會員發問";
                    		break;
                    	}
                    	$showStr = $value[$key1];
						break;
					default:
						$showStr = $value[$key1];
						break;
				}

				$showArray[$key][$value1] = $showStr;
			}
		}
		// var_dump($showArray);
		$this->assign("showArray", $showArray);
		$this->assign("allDataId", $allDataId);
		$this->assign("memberEmpty","<tr><td colspan='8' align='center'>無未回覆信件</td></tr>");
		$this->display();
	}
	//TODO: 信件ajax
	public function getAjaxMailForm(){
		$request = $this->getRequest();

		$CommonMemberMail = D("CommonMemberMail");

		//CommonMemberMail getCommonMemberMailData取得頁面類別資料
		$return = $CommonMemberMail->getCommonMemberMailData();
        if($return === false){
            echo 'err;;' . $err;
            exit();
        }
        $showField = array(
			'mail_id','member_account','mail_createTime','mail_status','mail_ip','admin_id',
			'mail_modifyTime','mail_title','mail_main',
		);
        $allDataId = "";
        $allDataStr = "";
        $i = 0;
        $showStr = "";

		foreach($return as $key => $value){
            if(empty($allDataId)){
                $allDataId = $value['mail_id'];
            } else {
                $allDataId .= ',' . $value['mail_id'];
            }
            if(!empty($allDataStr)){
                $allDataStr .= ",";
                $i = 0;
            }
			foreach ($showField as $field) {
				//欄位特別處理
				switch ($field) {
					case 'mail_ip': //IP轉換
						$showStr = get_ip_inet_ntop($value[$field]);//IP轉換可讀格式
						break;

					case 'mail_createTime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = date('Y-m-d H:i:s', $value[$field]);
                        break;

                    case 'mail_modifyTime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = "無修改時間";
                        if(!empty($value[$field])){
                            $showStr = date('Y-m-d H:i:s', $value[$field]);
                        }
                        break;
                    case 'admin_id': //無客服ID
                    	$showStr = $value[$field];
                    	if($value[$field] == null){
                    		$showStr = "無客服ID";
                    	}
						break;
					case 'mail_status':
						$showStr = $value[$field];
						if ($value[$field] == 2) {
                    		$showStr = "會員發問";
							break;
                    	}
                    	break;
					default:
						$showStr = $value[$field];
						break;
				}
                if($i == 0){
                    $allDataStr .= $showStr;
                } else {
                    $allDataStr .= ';' . $showStr;
                }
                $i++;
			}
		}
        echo $allDataId . ";;" . $allDataStr;
	}
	//TODO: 新增後台頁面類別
	public function formAddMailManage() {
		//使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
		$request = $this->getRequest();

		//檢查是否有 memberAccount 傳入 並且不為空
		if(!isset($request['memberAccount']) || empty($request['memberAccount'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//檢查是否有 title 傳入 並且不為空
		if(!isset($request['title']) || empty($request['title'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//檢查是否有 main 傳入 並且不為空
		if(!isset($request['main']) || empty($request['main'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		$CommonMemberMail = D('CommonMemberMail');

		$CommonMember = D('CommonMember');

		$mailStatus = "2";

		$nowTime = time();

		$ip = getIp();
		$ip = get_ip_inet_pton($ip);

		$memberAccount = array(
			'member_account' => $request['memberAccount'],
		);
		$memberAccount = $CommonMember->getMemberDataByAccount($memberAccount);

		$data = array(
			'member_id' => $memberAccount['member_id'],
			'mail_createTime' =>$nowTime,
			'mail_status' => $mailStatus,
			'mail_title' => $request['title'],
			'mail_main' => $request['main'],
			'mail_ip' => $ip,
			'admin_id' => $_SESSION['Admin']['id'],
		);

		$return = $CommonMemberMail->addCommonMemberMailData($data);

		if($return === false){
			//否，顯示錯誤
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
		}

		//是，顯示訊息成功
		$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
	}

	//TODO: 訊息回覆
	public function formReplyMailManage(){
		//使用 common.php filterStr($data) 公用函數過濾取得資料
		$request = $this->getRequest();

		//檢查是否有 mailId 傳入 並且不回空
		if(!isset($request['mailId']) || empty($request['mailId'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		//檢查是否有 reply 傳入且不為空
		if(!isset($request['reply']) || empty($request['reply'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
		}

		$CommonMemberMail = D('CommonMemberMail');

		$nowTime = time();

		$data = array(
			'mail_id' => $request['mailId'],
			'mail_reply' => $request['reply'],
			'admin_id' => $_SESSION['Admin']['id'],
			'mail_status' => "0",
			'mail_modifyTime' => $nowTime,
		);

		$return = $CommonMemberMail->replyCommonMemberMailData($data);

		//否，顯示錯誤
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
		}

		//是，影響數為1，顯示訊息成功
		if($return === 1){
			$this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
			return;
		}

		//操作錯誤，請重新登入
		$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
	}
	//TODO: 信件歷史
	public function maliDetail(){
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

    //分頁製作
    $pageNumber = "";
    if(empty($request['pageNumber'])){
    	$pageNumber = 1;
    } else {
    	$pageNumber = $request['pageNumber'];
    }

    $memberAccount = "";
    if(isset($request['memberAccount']) && !empty($request['memberAccount'])){
        $memberAccount = $request['memberAccount'];
    }
		$CommonMemberMail = D("CommonMemberMail");
		$data = array(
			"startTime"=>strtotime($startTime),
      "endTime"=>strtotime($endTime),
      "member_account" => $memberAccount,
		);
		//取得總筆數
		$return = $CommonMemberMail->getCommonMemberMailReplyNumberData($data);
		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}

		$totalNumber = $return['totalNumber']; //總筆數
		$totalPage = ceil($totalNumber /  $this->processMail); //總頁數
        $pageArray = getPageArray($pageNumber, $totalPage, $this->pageMoreNumber); //頁數陣列

		$data = array(
			"startTime"=>strtotime($startTime),
            "endTime"=>strtotime($endTime),
			'page' => array(
				'number' => $this->processMail,
				'pageNumber' => $pageNumber,
			),
      "member_account" => $memberAccount,
		);

		//取得資料
		$return = $CommonMemberMail->getCommonMemberMailReplyPageData($data);
		// var_dump($return);die;
		$showArray = array();

		//使用欄位轉換 資料庫欄位
		$FieldChange = array(
			'mail_id' => 'id',
			'member_id' => 'memberId',
		  'member_account' => 'memberAccount',
			'mail_createTime' => 'createTime',
			'mail_status' => 'status',
			'mail_title' => 'title',
			'mail_main' => 'main',
			'mail_ip' => 'ip',
			'admin_id' => 'adminId',
			'mail_modifyTime' => 'modifyTime',
			'mail_reply' => 'reply',
		);

		$showStr = "";
		foreach($return as $key => $value){
			foreach ($FieldChange as $key1 => $value1) {
				//欄位特別處理
				switch ($key1) {
					case 'mail_ip': //IP轉換
						$showStr = get_ip_inet_ntop($value[$key1]);//IP轉換可讀格式
						break;

					case 'mail_createTime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;

                    case 'mail_modifyTime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = "無修改時間";
                        if(!empty($value[$key1])){
                            $showStr = date('m-d H:i:s', $value[$key1]);
                        }
                        break;
                    case 'admin_id': //無客服ID
                    	$showStr = $value[$key1];
                    	if($value[$key1] == null){
                    		$showStr = "無客服ID";
                    	}
						break;
					case 'mail_status':
                    	if($value[$key1] == 0){
                    		$showStr = "會員未讀";
                    		break;
                    	} elseif ($value[$key1] == 1) {
                    		$showStr = "會員已讀";
                    		break;
                    	}
						break;
					default:
						$showStr = $value[$key1];
						break;
				}

				$showArray[$key][$value1] = $showStr;
			}
		}
		// var_dump($showArray);
		$this->assign("showArray", $showArray);
		$this->assign("memberAccount", $memberAccount);
		$this->assign("pageNumber", $pageNumber); //目前頁數
		$this->assign("totalPage", $totalPage); //總頁數
		$this->assign("pageArray", $pageArray); //頁數陣列
		$this->assign("memberEmpty","<tr><td colspan='8' align='center'>無回覆信件</td></tr>");
		$this->display();
	}
	//TODO: 發送訊息
	public function sentMemberMessage(){
		$request = $this->getRequest();
		//檢查帳號是否有傳入
		if(!isset($request['sentMemAccount']) || empty($request['sentMemAccount'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
		}
		//檢查主旨是否為空
		if(!isset($request['sentTitle']) || empty($request['sentTitle'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
		}
		//檢查內容是否為空
		if(!isset($request['sentMain']) || empty($request['sentMain'])){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
		}
		$data = array(
			'member_account' =>$request['sentMemAccount'],
		);
		$CommonMember = D('CommonMember');
		//取得會員ID
		$return = $CommonMember->getMemberDataByAccount($data);
		$nowTime = time();
		$data = array(
			'member_id' => $return['member_id'],
			'mail_status' => 0,
			'mail_createTime' => $nowTime,
			'admin_id' => $_SESSION['Admin']['id'],
			'mail_title' => $request['sentTitle'],
			'mail_main' => $request['sentMain'],
		);
		$CommonMemberMail = D("CommonMemberMail");
		$return = $CommonMemberMail->addCommonMemberMailData($data);

		if($return === false){
			$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
		}
		$this->success(L(strtoupper('SUCCESS' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
	}
  /*
   * 搜索 會員帳號
   */
  public function searchMemberName() {
      // 判斷有無輸入
      $request = $this->getRequest();

      $CommonMember = D("CommonMember");
      if (empty($request["query"])) {
          exit();
      }

      $limit = 7;
      $data = array(
          "member_acount" => $request["query"],
          "limit"=> 7
      );
      $member_child_arr = $CommonMember->searchMemberByMemberAccount($data);
      if ($member_child_arr === false) {
          $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
      }
      foreach ($member_child_arr as $member_child) {
          $can_send_name[] = $member_child["member_account"];
      }
      echo json_encode($can_send_name);
  }
}
