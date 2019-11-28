<?php
class PrivateAccountAction extends AdminAction {
    protected $privateAccount = 10; //分頁筆數
    protected $pageMoreNumber = 5;//一頁最多幾頁
    //TODO: 專屬帳戶管理頁面 資料讀取
    public function index(){
        //讀取 專屬帳戶 資料
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        $request = $this->getRequest();

        $memberAccount = "";
        if(isset($request['memberAccount']) && !empty($request['memberAccount'])){
            $memberAccount = $request['memberAccount'];
        }

        //製作分頁
        if(empty($request['pageNumber'])){
            $pageNumber = 1;
        } else {
            $pageNumber = $request['pageNumber'];
        }
        $data = array(
            'member_account' => $memberAccount,
        );
        $return = $CommonMemberPrivateatm->getTotalNumberPrivateatmData($data);
        if($return === false){
            //讀取總頁數，失敗
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }

        $totalNumber = $return[0]['totalNumber']; //總筆數
        $totalPage = ceil($totalNumber / $this->privateAccount);
        $pageArray = getPageArray($pageNumber,$totalPage,$this->pageMoreNumber);//取得頁數陣列
        $data = array(
            'member_account' => $memberAccount,
            'page' => array(
                'number' => $this->privateAccount,
                'pageNumber' => $pageNumber,
            ),
        );

        $return = $CommonMemberPrivateatm->getPrivateatmNumberData($data);
        if($return === false){
            //搜索分頁，失敗
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //var_dump($return);
        $showArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "member_id"=>"id",//會員ID
            "member_account"=>"account",//會員帳號
            "privateATM_id" => "ATMId",
            "privateATM_bankcode"=>"bankcode",
            "privateATM_bankaccount"=>"bankaccount",
            "privateATM_bankname"=>"bankname",
            "privateATM_enabled"=>"enabled"
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'privateATM_bankcode'://銀行代號 轉換 代碼加上文字
                        $showStr = $value[$key1];
                        break;
                    case 'privateATM_enabled'://專屬帳戶開關 0停用  1啟用
                        switch ($value[$key1]){
                            case 0:
                                $showStr = "停用中";
                                break;
                            case 1:
                                $showStr = "啟用中";
                                break;
                            default:
                                $showStr = $value[$key1];
                                break;
                        }
                        break;
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $showArray[$key][$value1] = $showStr;
            }
        }
        // var_dump($showArray);
        $CommonBankcode = D('CommonBankcode');
        $return = $CommonBankcode->getBankcodeData();
        if($return === false){
            //搜索分頁，失敗
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        $FieldChange = array(
            'bankcode_code' => 'bankcode',
            'bankcode_name' => 'bankcodeName',
        );
        $bankCodeArray = array();
        foreach ($return as $key => $value) {
            foreach ($FieldChange as $key1 => $value1) {
                switch($key1){
                    default :
                        $showStr = $value[$key1];
                }
                $bankCodeArray[$key][$value1] = $showStr;
            }
        }
        $this->assign("memberAccount",$memberAccount);
        $this->assign("bankCodeArray",$bankCodeArray);
        $this->assign("showArray",$showArray);
        $this->assign("totalPage", $totalPage); //總頁數
        $this->assign("pageNumber", $pageNumber); //目前頁數
        $this->assign("pageArray", $pageArray); //頁數陣列
        $this->assign("showEmpty","<tr><td colspan='7' align='center'>無資料</td></tr>");
        $this->display();
    }
    //TODO: 會員帳戶新增
    public function formAddPrivateatm(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 addAccount 會員帳號 傳入 並且不為空
        if(!isset($request['addAccount']) || empty($request['addAccount'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//會員帳號為空，請重新輸入
        }
        if(!isset($request['addBankcode']) || empty($request['addBankcode']) && $request['addBankcode'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//銀行代號為空，請重新輸入
        }
        if(!isset($request['addBankaccount']) || empty($request['addBankaccount']) && $request['addBankaccount'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//銀號帳號為空，請重新輸入
        }
        if(!isset($request['addBankname']) || empty($request['addBankname']) && $request['addBankname'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));//銀行戶名為空，請重新輸入
        }

        // 檢查是否有會員帳號
        $CommonMember = D("CommonMember");
        $data = array(
            "member_account" => $request['addAccount']
        );
        $return = $CommonMember->getMemberDataByAccount($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));//資料庫錯誤，請重新整理。
        }
        if(!isset($return['member_id'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_06')));//無此會員帳號，請重新輸入。
        }

        $enabled = "0";
        $data = array(
            "member_id" => $return['member_id'],
            "privateATM_bankcode" => $request['addBankcode'],
            "privateATM_bankaccount" => $request['addBankaccount'],
            "privateATM_bankname" => $request['addBankname'],
            "privateATM_enabled" => $enabled,
        );
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        $return = $CommonMemberPrivateatm->addPrivateatmData($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_07')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 會員帳戶修改
    public function formSetPrivateatm(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 account 傳入 並且不為空
        if(!isset($request['setPrivateatmId']) || empty($request['setPrivateatmId']) && $request['setPrivateatmId'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//修改帳戶ID為空，請重新整理。
        }
        if(!isset($request['setBankcode']) || empty($request['setBankcode']) && $request['setBankcode'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//銀行代號為空，請重新輸入
        }
        if(!isset($request['setBankaccount']) || empty($request['setBankaccount']) && $request['setBankaccount'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//銀號帳號為空，請重新輸入
        }
        if(!isset($request['setBankname']) || empty($request['setBankname']) && $request['setBankname'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));//銀行戶名為空，請重新輸入
        }
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "privateATM_id" => $request['setPrivateatmId'], //帳戶ID
            "privateATM_bankcode" => $request['setBankcode'],
            "privateATM_bankaccount" => $request['setBankaccount'],
            "privateATM_bankname" => $request['setBankname'],
        );
        $return = $CommonMemberPrivateatm->setPrivateatmDataByPrivateatmId($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 會員帳戶 開啟
    public function formStartPrivateatm(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 startId 傳入 並且不為空
        if(!isset($request['startId']) || (empty($request['startId']) && $request['startId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的會員帳戶，請重新選擇。
        }
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");

        $data = array(
            "privateATM_id" => $request['startId'],
            "privateATM_enabled" => 1,
        );
        $return = $CommonMemberPrivateatm->setPrivateatmDataByPrivateatmId($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
            return true;
        }

        //操作錯誤，請重新登入
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
    }
    //TODO: 會員帳戶 關閉
    public function formStopPrivateatm(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 startId 傳入 並且不為空
        if(!isset($request['stopId']) || (empty($request['stopId']) && $request['stopId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇修改的會員帳戶，請重新選擇。
        }
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "privateATM_id" => $request['stopId'],
            "privateATM_enabled" => 0,
        );
        $return = $CommonMemberPrivateatm->setPrivateatmDataByPrivateatmId($data);

        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
            return true;
        }

        //操作錯誤，請重新登入
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
    }
    //TODO: 會員帳戶 刪除
    public function formDelPrivateatm(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 account 傳入 並且不為空
        if(!isset($request['delPrivateatmId']) || empty($request['delPrivateatmId']) && $request['delPrivateatmId'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//修改帳戶ID為空，請重新整理。
        }
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        $data = array(
            "privateATM_id" => $request['delPrivateatmId'] //帳戶ID
        );
        $return = $CommonMemberPrivateatm->delPrivateatmDataByPrivateatmId($data);

        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }

    /*
     * 搜索 會員帳號
     */
    public function searchMemberName() {
        // 判斷有無輸入
        $request = $this->getRequest();
        if (empty($request["query"])) {
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }

        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        $limit = 7;
        $data = array(
            "member_account" => $request["query"],
            "limit"=> 7
        );
        $member_child_arr = $CommonMemberPrivateatm->searchMemberByMemberAccount($data);
        if ($member_child_arr === false) {
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        foreach ($member_child_arr as $member_child) {
            $can_send_name[] = $member_child["member_account"];
        }
        echo json_encode($can_send_name);
    }
    //TODO: 開關AJAX
    public function ajaxSwitch(){
        $request = $this->getRequest();
        $CommonMemberPrivateatm = D("CommonMemberPrivateatm");
        switch($request['mode_id']){
            case 'stopId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "privateATM_id" => $request['stopId'],
                    "privateATM_enabled" => 0,
                );
                $return = $CommonMemberPrivateatm->setPrivateatmDataByPrivateatmId($data);
                break;
            case 'startId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "privateATM_id" => $request['startId'],
                    "privateATM_enabled" => 1,
                );
                $return = $CommonMemberPrivateatm->setPrivateatmDataByPrivateatmId($data);
                break;
            default:
                break;
        }
    }
    //TODO: 批量修改
    public function formBatchEditDate(){
        $request = $this->getRequest();
        if(!isset($request['beforeBankaccount']) || empty($request['beforeBankaccount']) && $request['beforeBankaccount'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        if(!isset($request['beforeBankname']) || empty($request['beforeBankname']) && $request['beforeBankname'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        if(!isset($request['afterBankaccount']) || empty($request['afterBankaccount']) && $request['afterBankaccount'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        if(!isset($request['afterBankname']) || empty($request['afterBankname']) && $request['afterBankname'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        $data = array(
            'beforeBankaccount' => $request['beforeBankaccount'],
            'beforeBankname' => $request['beforeBankname'],
            'afterBankaccount' => $request['afterBankaccount'],
            'afterBankname' => $request['afterBankname'],
        );
        $CommonMemberPrivateatm = D('CommonMemberPrivateatm');
        $return = $CommonMemberPrivateatm->batchEditPrivateatmData($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));
        }
        $this->success(L(strtoupper('SUCCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
}