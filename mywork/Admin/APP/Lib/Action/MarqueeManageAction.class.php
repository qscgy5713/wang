<?php
class MarqueeManageAction extends AdminAction {
    //TODO: 跑馬燈管理首頁
    public function index(){
        //讀取 跑馬燈
        $CommonMarquee = D("CommonMarquee");
        //CommonMarquee getMarqueeDate 取得 跑馬燈資料
        $return = $CommonMarquee->getMarqueeDate();
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $groupArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "marquee_id"=>"id",
            "marquee_belong"=>"belong",
            "marquee_enabled"=>"enabled",
            "marquee_text"=>"text",
            "marquee_order"=>"order",
            "marquee_createTime"=>"createTime",
            "marquee_modifyTime"=>"modifyTime"
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'marquee_belong'://跑馬燈隸屬
                        switch($value[$key1]){
                            case 1:
                                $showStr = "前台";
                                break;
                            case 2:
                                $showStr = "代理";
                                break;
                            case 3:
                                $showStr = "後台";
                                break;
                        }
                        break;
                    case 'marquee_text':
                        $textArray = json_decode($value[$key1], true);
                        $groupArray[$key][$value1.'Tw'] = $textArray['zh-tw'];
                        $groupArray[$key][$value1.'Cn'] = $textArray['zh-cn'];
                        $groupArray[$key][$value1.'Us'] = $textArray['en-us'];
                        $groupArray[$key]['content'] = $textArray[$_COOKIE['think_language']];
                        if(mb_strlen($textArray[$_COOKIE['think_language']]) > 10){
                            $groupArray[$key]['content'] = mb_substr($textArray[$_COOKIE['think_language']], 0, 10)."...";
                        }
                        continue;
                        break;
                    case 'marquee_enabled'://開關  轉換 文字
                        if($value[$key1] == 1){
                            $showStr = "啟用中";
                            break;
                        }
                        $showStr = "停用中";
                        break;
                    case 'marquee_createTime'://代理建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;
                    case 'marquee_modifyTime'://代理建立時間 時間戳 轉換 日期
                        if(empty($value[$key1])){
                            $showStr = "無最後修改時間";
                            break;
                        }
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $groupArray[$key][$value1] = $showStr;
            }
        }
// var_dump($groupArray);die;
        $showArray = array();
        foreach ($groupArray as $key => $value) {
            if($value['belong'] == '前台'){
                $showArray[$value['belong']][$key] = $value;
                $showCount[$value['belong']] = count($showArray[$value['belong']]);
            } elseif ($value['belong'] == '代理'){
                $showArray[$value['belong']][$key] = $value;
                $showCount[$value['belong']] = count($showArray[$value['belong']]);
            } elseif ($value['belong'] == '後台'){
                $showArray[$value['belong']][$key] = $value;
                $showCount[$value['belong']] = count($showArray[$value['belong']]);
            }
        }
        // var_dump($showArray);die;
        $this->assign("showArray",$showArray);
        $this->assign("showCount",$showCount); //隸屬總筆數
        $this->assign("showEmpty","<tr><td colspan='8' align='center'>無資料</td></tr>");
        $this->display();
    }
    //TODO: 新增跑馬燈
    public function formAddMarquee(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 addBelong 傳入 並且不為空
        if(!isset($request['addBelong']) || empty($request['addBelong'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//隸屬為空，請重新輸入
        }

        $CommonMarquee = D("CommonMarquee");
        //取得隸屬的最大排序
        $data = array(
            "marquee_belong" => $request['addBelong']
        );
        $return = $CommonMarquee->getMarqueeBelongOrderDataById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//資料庫錯誤。
        }
        if($return['MaxOrder'] === NULL){
            $MaxOrder = 1;
        } else {
            $MaxOrder = $return['MaxOrder'] + 1;
        }

        $nowTime = time();//取得現在時間戳
        $textArray = array(
            'zh-tw' => $request['addTextTw'],
            'zh-cn' => $request['addTextCn'],
            'en-us' => $request['addTextUs']
        );
        $data = array(
            "marquee_belong" => $request['addBelong'],
            "marquee_text" => array_to_json($textArray),
            "marquee_order" => $MaxOrder,
            "marquee_createTime" => $nowTime
        );
        $return = $CommonMarquee->addMarqueeData($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 修改跑馬燈
    public function formSetMarquee(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setId 傳入 並且不為空
        if(!isset($request['setId']) || (empty($request['setId']) && $request['setId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的跑馬燈，請重新選擇。
        }
        if(!isset($request['setBelong']) || empty($request['setBelong'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//隸屬為空，請重新輸入。
        }

        $CommonMarquee = D("CommonMarquee");
        //搜尋 修改的跑馬燈ID 隸屬是否一樣
        $data = array(
            "marquee_id" => $request['setId']
        );
        $return = $CommonMarquee->getMarqueeBelongDataById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//資料庫錯誤。
        }
        if(empty($return['marquee_belong']) && $return['marquee_belong'] !== '0'){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));//修改的跑馬燈已被刪除，請重新選擇。
        }
        $belong = $return['marquee_belong'];

        $nowTime = time();//取得現在時間戳
        //修改資料 有修改隸屬，查詢排序資料

        $textArray = array(
            'zh-tw' => $request['setTextTw'],
            'zh-cn' => $request['setTextCn'],
            'en-us' => $request['setTextUs']
        );

        if($belong !== $request['setBelong']){
            $data = array(
                "marquee_belong" => $return['marquee_belong'],
                "marquee_order" => $return['marquee_order']
            );
            $return = $CommonMarquee->setMarqueeOrderHighLowDataByBelong($data);
            if($return === false){//否，顯示錯誤
                $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));//資料庫錯誤。
            }

            $data = array(
                "marquee_belong" => $request['setBelong']
            );
            $return = $CommonMarquee->getMarqueeBelongOrderDataById($data);
            if($return === false){//否，顯示錯誤
                $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_06')));//資料庫錯誤。
            }
            if($return['MaxOrder'] === NULL){
                $MaxOrder = 1;
            } else {
                $MaxOrder = $return['MaxOrder'] + 1;
            }
            $data = array(
                "marquee_id" => $request['setId'],
                "marquee_belong" => $request['setBelong'],
                "marquee_text" => array_to_json($textArray),
                "marquee_order" => $MaxOrder,
                "marquee_modifyTime" => $nowTime
            );
        } else {
            $data = array(
                "marquee_id" => $request['setId'],
                "marquee_text" => array_to_json($textArray),
                "marquee_modifyTime" => $nowTime
            );
        }
        $return = $CommonMarquee->setMarqueeDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_07')));//資料庫錯誤。
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_08')));//無修改任何資料。
    }
    //TODO: 跑馬燈刪除
    public function formDelMarquee(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 delId 傳入 並且不為空
        if(!isset($request['delId']) || (empty($request['delId']) && $request['delId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//刪除網址為空，請重新操作
        }
        $CommonMarquee = D("CommonMarquee");

        $data = array(
            "marquee_id" => $request['delId']
        );
        $return = $CommonMarquee->getMarqueePageData($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        $data = array(
            'marquee_order' => $return['marquee_order'],
            'marquee_belong' => $return['marquee_belong'],
        );
        $return = $CommonMarquee->setMarqueePageOrderByClassIdAndPageOrder($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        $data = array(
            "marquee_id" => $request['delId']
        );
        $return = $CommonMarquee->delMarqueeById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 跑馬燈 開啟
    public function formStartMarquee(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 startId 傳入 並且不為空
        if(!isset($request['startId']) || (empty($request['startId']) && $request['startId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的跑馬燈，請重新選擇。
        }
        $CommonMarquee = D("CommonMarquee");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "marquee_id" => $request['startId'],
            "marquee_enabled" => 1,
            "marquee_modifyTime" => $nowTime
        );
        $return = $CommonMarquee->setMarqueeDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
    }
    //TODO: 跑馬燈 關閉
    public function formStopMarquee(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 startId 傳入 並且不為空
        if(!isset($request['stopId']) || (empty($request['stopId']) && $request['stopId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的跑馬燈，請重新選擇。
        }
        $CommonMarquee = D("CommonMarquee");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "marquee_id" => $request['stopId'],
            "marquee_enabled" => 0,
            "marquee_modifyTime" => $nowTime
        );
        $return = $CommonMarquee->setMarqueeDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
    }
    //TODO: 排序
    public function formSortAgentPageClass(){
        $request = $this->getRequest();
        if($request['marqueeBelong'] == "前台"){
            $marqueeBelong = '1';
        } elseif($request['marqueeBelong'] == "代理"){
            $marqueeBelong = '2';
        } elseif($request['marqueeBelong'] == "後台"){
            $marqueeBelong = '3';
        }

        switch ($request['className']) {
            case 'upSort':
                if(!isset($request['orderSort']) || empty($request['orderSort']) && $request['orderSort'] !== 0){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_0')));
                }

                $data = array(
                    'marquee_order' => $request['orderSort'],
                    'marquee_order2' => ($request['orderSort'] - 1),
                    'marquee_belong' => $marqueeBelong,
                    'marquee_id' => $request['sortId'],
                );
                break;

            case 'downSort':
                if(!isset($request['orderSort']) || empty($request['orderSort']) && $request['orderSort'] !== 0){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_0')));
                }

                $data = array(
                    'marquee_order' => $request['orderSort'],
                    'marquee_order2' => ($request['orderSort'] + 1),
                    'marquee_belong' => $marqueeBelong,
                    'marquee_id' => $request['sortId'],
                );
                break;

            default:
                if($return === false){
                    //否，顯示錯誤
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
                }
                break;
        }
        $CommonMarquee = D("CommonMarquee");
        $CommonMarquee->setSortAgentPageClassOrder($data);
        redirect(__APP__.'/MarqueeManage/index');
    }
    //TODO: 開關AJAX
    public function ajaxSwitch(){
        $request = $this->getRequest();
        $CommonMarquee = D("CommonMarquee");
        $nowTime = time();
        switch($request['mode_id']){
            case 'stopId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "marquee_id" => $request['stopId'],
                    "marquee_enabled" => 0,
                    "marquee_modifyTime" => $nowTime
                );
                $return = $CommonMarquee->setMarqueeDataById($data);
                break;
            case 'startId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "marquee_id" => $request['startId'],
                    "marquee_enabled" => 1,
                    "marquee_modifyTime" => $nowTime
                );
                $return = $CommonMarquee->setMarqueeDataById($data);
                break;
            default:
                break;
        }
    }
}