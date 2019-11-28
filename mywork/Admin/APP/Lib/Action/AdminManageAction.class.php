<?php
class AdminManageAction extends AdminAction {
    protected $adminManage = 10; //分頁筆數
    protected $pageMoreNumber = 5;//一頁最多幾頁
    //TODO: 公司帳號管理 首頁
    public function index(){
        $request = $this->getRequest();
        //讀取 頁面資料
        $InternalAdmin = D("InternalAdmin");
        //製作分頁
        if(empty($request['pageNumber'])){
            $pageNumber = 1;
        } else {
            $pageNumber = $request['pageNumber'];
        }
        $return = $InternalAdmin->getTotalNumberAdminData();

        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }

        $totalNumber = $return[0]['totalNumber']; //總筆數
        $totalPage = ceil($totalNumber / $this->adminManage);
        $pageArray = getPageArray($pageNumber,$totalPage,$this->pageMoreNumber);//取得頁數陣列
        $data = array(
            'page' => array(
                'number' => $this->adminManage,
                'pageNumber' => $pageNumber,
            ),
        );
        $return = $InternalAdmin->getAdminNumberData($data);
        if($return === false){
            //搜索分頁，失敗
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }

        // var_dump($return);die;
        $showArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "admin_id"=>"id",
            "admin_account"=>"account",
            "admin_status"=>"status",
            "admin_createTime"=>"createTime",
            "admin_modifyTime"=>"modifyTime",
            "admin_remark"=>"remark",
            "power_main"=>"pageData",
        );
        $showPageArray = $this->getPageArray($request);//取得頁面資訊
        $showStr = "";
        $showStrArray = array();
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'admin_status'://開關  轉換 文字
                        if($value[$key1] == 0){
                            $showStr = "帳號正常";
                            break;
                        }
                        $showStr = "帳號停權";
                        break;
                    case 'admin_createTime'://建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;
                    case 'admin_modifyTime'://修改時間 時間戳 轉換 日期
                        if(empty($value[$key1])){
                            $showStr = "無最後修改時間";
                            break;
                        }
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;
                    case 'power_main':
                        $powerArray = explode(",",substr($value[$key1],0,-1));//substr() 去除最後一個字元   explode()切割字串
                        foreach($showPageArray as $classKey => $classValue){
                            foreach($classValue as $pageKey => $pageValue){
                                $showEnable = $pageValue;
                                $showEnable['power'] = 0;
                                if (in_array($pageValue['id'], $powerArray)) {
                                    $showEnable['power'] = 1;
                                }
                                $showStrArray[$classKey][$pageKey] = $showEnable;
                            }
                        }
                        break;
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                if($key1 == 'power_main'){
                    $showArray[$key][$value1] = $showStrArray;
                } else {
                    $showArray[$key][$value1] = $showStr;
                }
            }
        }

        $InternalAdminDepartment = D('InternalAdminDepartment');
        $return = $InternalAdminDepartment->getAdminSubPagePowerData();



        //使用欄位轉換 資料庫欄位
        $FieldChange = array(
            'department_id' => 'id',
            'department_name' => 'name',
            'power_main' => 'powerMain',
        );
        $DepartmentArray = array();
        $showStr = "";
        $showStrArray = array();
        foreach ($return as $key => $value) {
            foreach ($FieldChange as $key1 => $value1) {
                 $showStr = $value[$key1];
                 //欄位特別處理
                switch ($key1){
                    case 'power_main': //權限
                        $powerArray = explode(",",$value[$key1]);
                        foreach($showPageArray as $classKey => $classValue){
                            foreach($classValue as $pageKey => $pageValue){
                                $showEnable = $pageValue;
                                $showEnable['power'] = 0;
                                if (in_array($pageValue['id'], $powerArray)) {
                                    $showEnable['power'] = 1;
                                }
                                $showStrArray[$classKey][$pageKey] = $showEnable;
                            }
                        }
                        break;
                    default: //未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }

                if($key1 == 'power_main'){
                    $DepartmentArray[$key][$value1] = $showStrArray;
                } else {
                    $DepartmentArray[$key][$value1] = $showStr;
                }
            }
        }
        //取出 id 與 power
        $powerArray = array();
        foreach ($DepartmentArray as $key => $value) {
            $powerArray[$key][$key] = $value['id'];
            $i = 0;
            $j = 0;
            foreach ($value as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    foreach ($value2 as $key3 => $value3) {
                        $powerArrayId['id'][$i++] = $value3['id'];
                        $powerArray[$key]['power'][$j++] = $value3['power'];
                    }
                }
            }
        }
        // var_dump($powerArrayId);exit();
        $this->assign("showArray",$showArray);
        $this->assign("showPageArray",$showPageArray);
        $this->assign("DepartmentArray",$DepartmentArray); //取得部門權限預設
        $this->assign("powerArray",$powerArray); //id 與 power參數
        $this->assign("powerArrayId",$powerArrayId);
        $this->assign("totalPage", $totalPage); //總頁數
        $this->assign("pageNumber", $pageNumber); //目前頁數
        $this->assign("pageArray", $pageArray); //頁數陣列
        $this->assign("adminAccEmpty", "<tr><td colspan='7' align='center'>無公司帳號資料</td></tr>"); //頁數陣列
        $this->display();
    }
    //TODO: 管理帳號新增
    public function formAddAdmin(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查 帳號 傳入 並且不為空
        if(!isset($request['addAccount']) || empty($request['addAccount'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//密碼為空，請重新輸入
        }
        //檢查是否有 addPassword 傳入 並且不為空
        if(!isset($request['addPassword']) || empty($request['addPassword'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//密碼為空，請重新輸入
        }
        if($request['addPassword'] !== $request['addCheckPassword']){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//密碼與確認密碼不符，請重新輸入。
        }

        $InternalAdmin = D("InternalAdmin");
        $data = array(
            'admin_account' => $request['addAccount'],
        );
        $return = $InternalAdmin->getAdminDataByAccount($data);
        if($return['admin_account'] === $request['addAccount']){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));//密碼與確認密碼不符，請重新輸入。
        }
        $nowTime = time();//取得現在時間戳
        //從 InternalAdminModel getMd5Password($password) 傳入密碼 取得加密後的密碼 作新增
        $password = $InternalAdmin->getMd5Password($request['addPassword']);
        $powerMain = "";//做power字串
        foreach ($request["addPageId"] as $value){
            $powerMain .= $value.",";
        }

        $data = array(
            "admin_account" => $request['addAccount'], //管理帳號
            "admin_password" => $password,
            "admin_status" => 0,
            "admin_createtime" => $nowTime,
            "admin_remark" => $request['addRemark'],
            "power_main" => $powerMain
        );
        $return = $InternalAdmin->addAdminData($data,$err);
        if($return === false){
            //否，顯示錯誤
            $this->error($err);
        }
        $sreach = array(
            'admin_account' => $request['addAccount'],
        );
        $return = $InternalAdmin->sreachAdminAccount($sreach);
        $addData = array(
            'operateLog_class'=>21, //新增管理帳號
            'operateLog_objectId'=>$return['admin_id'],
            'operateLog_objectAccount'=>$return['admin_account'],
            'operateLog_main'=> $data,
        );
        $addData['operateLog_main']['admin_password'] = $request['addPassword'];
        $this->addAdminOperateLog($addData);
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 管理修改
    public function formSetAdmin(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 Id 傳入 並且不為空
        if(!isset($request['setId']) || (empty($request['setId']) && $request['setId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//修改帳號為空，請重新登入。
        }
        $InternalAdmin = D("InternalAdmin");
        $nowTime = time();//取得現在時間戳

        $powerMain = "";//做power字串
        foreach ($request["setPageId"] as $value){
            $powerMain .= $value.",";
        }
        //檢查是否有修改密碼
        if(!empty($request['setPassword'])){
            if($request['setPassword'] !== $request['setCheckPassword']){
                $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//密碼與確認密碼不符，請重新輸入。
            }
            //從 CommonAgentModel getMd5Password($password) 傳入密碼 取得加密後的密碼 作修改
            $password = $InternalAdmin->getMd5Password($request['setPassword']);
            $data = array(
                "admin_id" => $request['setId'], //管理帳號
                "admin_password" => $password,
                "admin_modifyTime"=> $nowTime,
                "admin_remark" => $request['setRemark'],
                "power_main" => $powerMain
            );
        } else {
            $data = array(
                "admin_id" => $request['setId'], //管理帳號
                "admin_modifyTime"=> $nowTime,
                "admin_remark" => $request['setRemark'],
                "power_main" => $powerMain
            );
        }
        $return = $InternalAdmin->setAdminDataPageDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        $sreach = array(
            'admin_id' => $request['setId'],
        );
        $return = $InternalAdmin->sreachAdminAccount($sreach);
        $addData = array(
            'operateLog_class'=>22, //修改管理帳號
            'operateLog_objectId'=>$return['admin_id'],
            'operateLog_objectAccount'=>$return['admin_account'],
            'operateLog_main'=> $data,
        );
        $addData['operateLog_main']['admin_password'] = $request['setPassword'];
        $this->addAdminOperateLog($addData);
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 刪除公司帳號
    public function formDelAdmin(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setDomainId 傳入 並且不為空
        if(!isset($request['delId']) || (empty($request['delId']) && $request['delId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//刪除ID為空，請重新操作
        }
        $InternalAdmin = D("InternalAdmin");
        $data = array(
            "admin_id" => $request['delId']
        );
        $return = $InternalAdmin->delAdminDataById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 帳號停用
    public function formStopAdmin(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 ID 傳入 並且不為空
        if(!isset($request['stopId']) || (empty($request['stopId']) && $request['stopId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//傳入ID為空，請重新操作。
        }
        $InternalAdmin = D("InternalAdmin");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "admin_id" => $request['stopId'],
            "admin_status" => 1,
            "admin_modifyTime"=> $nowTime
        );
        $return = $InternalAdmin->setAdminDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//權限不足或操作錯誤，請重新登入。
    }
    //TODO: 啟用啟用
    public function formStartAdmin(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 ID 傳入 並且不為空
        if(!isset($request['startId']) || (empty($request['startId']) && $request['startId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//傳入ID為空，請重新操作。
        }
        $InternalAdmin = D("InternalAdmin");
        $nowTime = time();//取得現在時間戳
        $data = array(
            "admin_id" => $request['startId'],
            "admin_status" => 0,
            "admin_modifyTime"=> $nowTime
        );
        $return = $InternalAdmin->setAdminDataById($data);
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
    //TODO: ajax開關
    public function ajaxSwitch(){
        $request = $this->getRequest();
        //讀取 頁面資料
        $InternalAdmin = D("InternalAdmin");
        $nowTime = time();
        switch($request['mode_id']){
            case 'stopId':
                $data = array(
                    "admin_id" => $request['stopId'],
                    "admin_status" => 1,
                    "admin_modifyTime" => $nowTime
                );
                $return = $InternalAdmin->setAdminDataById($data);
                $sreach = array(
                    'admin_id' => $request['stopId'],
                );
                $return = $InternalAdmin->sreachAdminAccount($sreach);
                $addData = array(
                    'operateLog_class'=>23, //停權公司帳號
                    'operateLog_objectId'=>$return['admin_id'],
                    'operateLog_objectAccount'=>$return['admin_account'],
                    'operateLog_main'=> array(
                        "admin_id" => $request['startId'],
                        "admin_status" => 1,
                    ),
                );
                $this->addAdminOperateLog($addData);
                break;
            case 'startId':
                $data = array(
                    "admin_id" => $request['startId'],
                    "admin_status" => 0,
                    "admin_modifyTime" => $nowTime
                );
                $return = $InternalAdmin->setAdminDataById($data);
                $sreach = array(
                    'admin_id' => $request['startId'],
                );
                $return = $InternalAdmin->sreachAdminAccount($sreach);
                $addData = array(
                    'operateLog_class'=>24, //啟用公司帳號
                    'operateLog_objectId'=>$return['admin_id'],
                    'operateLog_objectAccount'=>$return['admin_account'],
                    'operateLog_main'=> array(
                        "admin_id" => $request['startId'],
                        "admin_status" => 0,
                    ),
                );
                $this->addAdminOperateLog($addData);
                break;
            default:
                break;
        }
    }
}