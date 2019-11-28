<?php
class BankcodeManageAction extends AdminAction {
    protected $bankcodeManage = 10; // 分頁筆數
    protected $pageMoreNumber = 5;//頁數最多筆數
    //TODO: 銀行代碼管理 首頁
    public function index(){

        $request = $this->getRequest();
        //讀取 頁面資料
        $CommonBankcode = D("CommonBankcode");
        //製作分頁
        if(empty($request['pageNumber'])){
            $pageNumber = 1;
        } else {
            $pageNumber = $request['pageNumber'];
        }
        if(empty($request['selectBank'])){
            $selectBank = "";
        } else {
            $selectBank = $request['selectBank'];
        }
        $data = array(
            'selectBank' => $selectBank,
        );
        $return = $CommonBankcode->getTotalNumberBankcodeNumber($data);

        if($return === false){
            //讀取總頁數，失敗
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $totalNumber = $return[0]["totalNumber"]; //總筆數
        $totalPage = ceil($totalNumber / $this->bankcodeManage); //總頁數
        $pageArray = getPageArray($pageNumber,$totalPage,$this->pageMoreNumber);//取得 頁數 陣列 演算法

        $data = array(
            "page" => array(
                'number' =>$this->bankcodeManage,
                'pageNumber' => $pageNumber,
            ),
            'selectBank' => $selectBank,
        );

        $return = $CommonBankcode->getBankcodeNumberData($data, $$err);

        if($return === false){
            //搜索頁數失敗
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }


        //表明 getBankcodeData()取得資料
        // $return = $CommonBankcode->getBankcodeData();
        // if($return === false){
        //     $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        // }
        //var_dump($return);
        $showArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "bankcode_id"=>"id",
            "bankcode_code"=>"code",
            "bankcode_name"=>"name",
            "bankcode_createTime"=>"createTime",
            "bankcode_modifyTime"=>"modifyTime"
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'bankcode_status'://開關  轉換 文字
                        if($value[$key1] == 0){
                            $showStr = "帳號正常";
                            break;
                        }
                        $showStr = "帳號停權";
                        break;
                    case 'bankcode_createTime'://建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;
                    case 'bankcode_modifyTime'://修改時間 時間戳 轉換 日期
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
                $showArray[$key][$value1] = $showStr;
            }
        }
        // var_dump($showArray);


        $this->assign("showArray",$showArray);
        $this->assign("selectBank",$selectBank); //銀行代碼/名稱
        $this->assign("totalPage", $totalPage); //總頁數
        $this->assign("pageNumber", $pageNumber); //目前頁數
        $this->assign("pageArray", $pageArray); //顯示的頁數陣列
        $this->assign("showEmpty","<tr><td colspan='6' align='center'>無資料</td></tr>");

        $this->display();
    }
    //TODO: 管理帳號新增
    public function formAddBankcode(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查 銀行代號 傳入 並且不為空
        if(!isset($request['addCode']) || empty($request['addCode'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//銀行代號為空，請重新輸入
        }
        //檢查是否有 銀行名稱 傳入 並且不為空
        if(!isset($request['addName']) || empty($request['addName'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//銀行名稱為空，請重新輸入
        }

        $CommonBankcode = D("CommonBankcode");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "bankcode_code" => $request['addCode'], //銀行代號
            "bankcode_name" => $request['addName'], //銀行名稱
            "bankcode_createtime" => $nowTime
        );
        $return = $CommonBankcode->addBankcodeData($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 銀行代碼修改
    public function formSetBankcode(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 Id 傳入 並且不為空
        if(!isset($request['setId']) || (empty($request['setId']) && $request['stopId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//修改帳號為空，請重新登入。
        }
        if(!isset($request['setCode']) || (empty($request['setCode']) && $request['setCode'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//修改銀行代號為。
        }
        if(!isset($request['setName']) || (empty($request['setName']) && $request['setName'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//修改銀行代號為空。
        }
        $CommonBankcode = D("CommonBankcode");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "bankcode_id" => $request['setId'], //管理帳號
            "bankcode_code" => $request['setCode'], //銀行代號
            "bankcode_name" => $request['setName'], //銀行名稱
            "bankcode_modifyTime"=> $nowTime
        );
        $return = $CommonBankcode->setBankcodeDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        } else {
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));//權限不足或操作錯誤，請重新登入。
        }

    }
    //TODO: 刪除銀行代碼
    public function formDelBankcode(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setDomainId 傳入 並且不為空
        if(!isset($request['delId']) || (empty($request['delId']) && $request['delId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//刪除ID為空，請重新操作
        }
        $CommonBankcode = D("CommonBankcode");
        $data = array(
            "bankcode_id" => $request['delId']
        );
        $return = $CommonBankcode->delBankcodeDataById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//操作錯誤，請重新登入。
    }
}