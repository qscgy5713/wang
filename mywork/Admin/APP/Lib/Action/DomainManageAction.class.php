<?php
class DomainManageAction extends AdminAction {
    protected $domainManage = 10; //分頁筆數
    protected $pageMoreNumber = 5;//一頁最多幾頁
    //TODO: 網域管理首頁
    public function index(){
        $request = $this->getRequest();

        //製作分頁
        if(empty($request['pageNumber'])){
            $pageNumber = 1;
        } else {
            $pageNumber = $request['pageNumber'];
        }
        //讀取 頁面資料
        $CommonAgentDomain = D('CommonAgentDomain');

        //取得總筆數
        $return = $CommonAgentDomain->getTotalNumberDimainData();
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $totalNumber = $return['totalNumber']; //總筆數
        $totalPage = ceil($totalNumber / $this->domainManage); //總頁數
        $pageArray = getPageArray($pageNumber,$totalPage,$this->pageMoreNumber);//取得頁數陣列
        $data = array(
            'page' => array(
                'number' => $this->domainManage,
                'pageNumber' => $pageNumber,
            ),
        );

        $return = $CommonAgentDomain->getDomainDateNumber($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }

        $showArray = array();
        //使用欄位轉換 資料庫欄位 => 輸出名稱
        $FieldChange = array(
            'domain_id' => 'domainId',
            'domain_site' => 'domainSite',
            'domain_titleName' => 'title',
            'domain_keywords' => 'keywords',
            'domain_description' => 'description',
            'domain_enable' => 'domainEnable',
            'domain_createTime' => 'domainCreateTime',
            'domain_modifyTime' => 'domainModifyTime',
            'domain_order' => 'order',
        );

        $showStr = "";

        foreach ($return as $key => $value) {
            foreach ($FieldChange as $key1 => $value1) {
                //欄位特別處裡
                switch ($key1){
                    case 'domain_titleName':
                        $titleArray = json_decode($value[$key1], true);
                        $showArray[$key][$value1.'Tw'] = $titleArray['zh-tw'];
                        $showArray[$key][$value1.'Cn'] = $titleArray['zh-cn'];
                        $showArray[$key][$value1.'Us'] = $titleArray['en-us'];
                        continue;
                        break;
                    case 'domain_keywords':
                        $keywordsArray = json_decode($value[$key1], true);
                        $showArray[$key][$value1.'Tw'] = $keywordsArray['zh-tw'];
                        $showArray[$key][$value1.'Cn'] = $keywordsArray['zh-cn'];
                        $showArray[$key][$value1.'Us'] = $keywordsArray['en-us'];
                        continue;
                        break;
                    case 'domain_description':
                        $descriptionArray = json_decode($value[$key1], true);
                        $showArray[$key][$value1.'Tw'] = $descriptionArray['zh-tw'];
                        $showArray[$key][$value1.'Cn'] = $descriptionArray['zh-cn'];
                        $showArray[$key][$value1.'Us'] = $descriptionArray['en-us'];
                        continue;
                        break;
                    case 'domain_enable': // 關閉頁面 轉換文字
                        if($value[$key1] == 1){
                            $showStr = "啟用中";
                            break;
                        }
                        $showStr = "關閉中";
                        break;
                    case 'domain_createTime': //頁面建立時間 時間戳轉換日期
                        $showStr = "無建立時間";
                        if(!empty($value[$key1])){
                            $showStr = date('m-d H:i:s', $value[$key1]);
                        }
                        break;
                    case 'domain_modifyTime': //頁面修改時間 時間戳轉換日期
                        $showStr = "無修改時間";
                        if(!empty($value[$key1])){
                            $showStr = date('m-d H:i:s', $value[$key1]);
                        }
                        break;
                    default: //未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $showArray[$key][$value1] = $showStr;
            }
        }
        $this->assign('showArray', $showArray);
        $this->assign("totalPage", $totalPage); //總筆數
        $this->assign("totalNumber", $totalNumber); //總筆數
        $this->assign("pageNumber", $pageNumber); //目前頁數
        $this->assign("pageArray", $pageArray); //頁數陣列
        $this->display();
    }
    //TODO: 新增網域
    public function formAddDomain(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();

        //檢查是否有 addSite 傳入 並且不為空
        if(!isset($request['addSite']) || empty($request['addSite'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//網域內容為空，請重新輸入
        }
        $titleArray = array(
            'zh-tw' => $request['addTitleTw'],
            'zh-cn' => $request['addTitleCn'],
            'en-us' => $request['addTitleUs']
        );
        $keywordsArray = array(
            'zh-tw' => $request['addKeywordsTw'],
            'zh-cn' => $request['addKeywordsCn'],
            'en-us' => $request['addKeywordsUs']
        );
        $descriptionArray = array(
            'zh-tw' => $request['addDescriptionTw'],
            'zh-cn' => $request['addDescriptionCn'],
            'en-us' => $request['addDescriptionUs']
        );

        $CommonAgentDomain = D("CommonAgentDomain");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "domain_site" => $request['addSite'],
            "domain_titleName" => array_to_json($titleArray),
            "domain_keywords" => array_to_json($keywordsArray),
            "domain_description" => array_to_json($descriptionArray),
            "domain_createTime" => $nowTime,
            "domain_enable" => 0
        );
        $return = $CommonAgentDomain->addDomainData($data);

        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }

        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 修改網域
    public function formSetDomain(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setDomainId 傳入 並且不為空
        if(!isset($request['setDomainId']) || (empty($request['setDomainId']) && $request['setDomainId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的網域，請重新選擇。
        }
        if(!isset($request['setSite']) || empty($request['setSite'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//網域內容為空，請重新輸入。
        }
        $titleArray = array(
            'zh-tw' => $request['setTitleTw'],
            'zh-cn' => $request['setTitleCn'],
            'en-us' => $request['setTitleUs']
        );
        $keywordsArray = array(
            'zh-tw' => $request['setKeywordsTw'],
            'zh-cn' => $request['setKeywordsCn'],
            'en-us' => $request['setKeywordsUs']
        );
        $descriptionArray = array(
            'zh-tw' => $request['setDescriptionTw'],
            'zh-cn' => $request['setDescriptionCn'],
            'en-us' => $request['setDescriptionUs']
        );

        $CommonAgentDomain = D("CommonAgentDomain");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "domain_id" => $request['setDomainId'],
            "domain_site" => $request['setSite'],
            "domain_titleName" => array_to_json($titleArray),
            "domain_keywords" => array_to_json($keywordsArray),
            "domain_description" => array_to_json($descriptionArray),
            "domain_modifyTime" => $nowTime
        );
        $return = $CommonAgentDomain->setDomainDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 網域刪除
    public function formDelDomain(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setDomainId 傳入 並且不為空
        if(!isset($request['delDomainId']) || (empty($request['delDomainId']) && $request['delDomainId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//刪除網址為空，請重新操作
        }
        $CommonAgentDomain = D("CommonAgentDomain");
        $data = array(
            "domain_id" => $request['delDomainId']
        );
        $return = $CommonAgentDomain->delDomainById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 網域 開關
    public function formSetDomainEnabled(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setDomainId 傳入 並且不為空
        if(!isset($request['setDomainId']) || (empty($request['setDomainId']) && $request['setDomainId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的網域，請重新選擇。
        }
        if(!isset($request['setEnabled']) || (empty($request['setEnabled']) && $request['setEnabled'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//開關參數為空，請重新輸入。
        }
        // $enabled = 0;
        switch ($request['setEnabled']){
            case '啟用中':
                $enabled = 0;//不啟用
                break;
            default:
                $enabled = 1;//啟用
                break;
        }

        $CommonAgentDomain = D("CommonAgentDomain");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "domain_id" => $request['setDomainId'],
            "domain_enable" => $enabled,
            "domain_modifyTime" => $nowTime
        );

        $return = $CommonAgentDomain->setDomainDataById($data);

        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 開關AJAX
    public function ajaxSwitch(){
        $request = $this->getRequest();
        $CommonAgentDomain = D("CommonAgentDomain");
        $nowTime = time();
        switch($request['mode_id']){
            case 'stopId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "domain_id" => $request['stopId'],
                    "domain_enable" => 0,
                    "domain_modifyTime" => $nowTime
                );
                $return = $CommonAgentDomain->setDomainDataById($data);
                break;
            case 'startId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "domain_id" => $request['startId'],
                    "domain_enable" => 1,
                    "domain_modifyTime" => $nowTime
                );
                $return = $CommonAgentDomain->setDomainDataById($data);
                break;
            default:
                break;
        }
    }
    //TODO: 排序
    public function sortDomainManageOrder(){
        $request = $this->getRequest();
        if(empty($request['orderSort']) && $request['orderSort']){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'))); // 無排序
        }
        switch ($request['className']) {
            case 'upSort':
                $data = array(
                    'domain_order' => $request['orderSort'],
                    'domain_order2' => $request['orderSort'] - 1,
                );
                break;
            case 'downSort':
                $data = array(
                    'domain_order' => $request['orderSort'],
                    'domain_order2' => $request['orderSort'] + 1,
                );
                break;
            default:
                $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'))); //無分類
                break;
        }
        $CommonAgentDomain = D('CommonAgentDomain');
        $return = $CommonAgentDomain->sortDomainDateOrder($data);
        redirect(__APP__.'/DomainManage/index');
    }
}