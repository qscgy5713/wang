<?php
class AdminPageManageAction extends AdminAction {
    //TODO: 後台頁面管理 首頁
    public function index(){
        $request = $this->getRequest();
        //讀取 後台頁面資料
        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $return = $CommonAdminPageclassPage->getAdminPageData();
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //var_dump($return);
        $departmentArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "page_id"=>"id",
            "pageclass_id"=>"classId",
            "page_actionName"=>"actionName",
            "page_showName"=>"showName",
            "page_order"=>"order",
            "page_enabled"=>"enabled",
            "page_createtime"=>"createtime",
            "page_modifyTime"=>"modifyTime",
            "pageclass_showName"=>"classShowName"
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    case 'page_enabled'://頁面開關  轉換 文字
                        if($value[$key1] == 1){
                            $showStr = "啟用中";
                            break;
                        }
                        $showStr = "關閉中";
                        break;
                    case 'page_createtime'://頁面建立時間 時間戳 轉換 日期
                        $showStr = date('m-d H:i:s', $value[$key1]);
                        break;
                    case 'page_modifyTime'://頁面修改時間 時間戳 轉換 日期
                        $showStr = "無修改時間";
                        if(!empty($value[$key1])){
                            $showStr = date('m-d H:i:s', $value[$key1]);
                        }
                        break;
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $departmentArray[$key][$value1] = $showStr;
            }
        }
        //var_dump($departmentArray) ;
        $CommonAdminPageclass = D("CommonAdminPageclass");
        $return = $CommonAdminPageclass->getAdminPageClassDataByEnabled();

        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        //各部門總筆數
        foreach ($return as $key => $value) {
            $data['pageclass_id'] = $value['pageclass_id'];
            $classTotal = $CommonAdminPageclassPage->getClassNameToatlNumber($data);
            $classTotalArray[] = $classTotal['maxOrder'];
        }
        $classArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "pageclass_id"=>"classId",
            "pageclass_showName"=>"showName",
            "total" => "total"
        );
        $i = 0;
        foreach ($return as $key => $value){
            if(!empty($classTotalArray[$key])){
                foreach ($FieldChange as $key1 => $value1){
                    //欄位特別處理
                    switch ($key1){
                        case 'total':
                            $showStr = $classTotalArray[$key];
                            break;
                        default://未做設定 正常顯示
                            $showStr = $value[$key1];
                            break;
                    }
                    $classArray[$i][$value1] = $showStr;
                }
                $i++;
            }

        }
        $showArray = array();
        foreach ($classArray as $key => $value) {
            $i = 0;
            foreach ($departmentArray as $key1 => $value1) {
                if($value['classId'] == $value1['classId']){
                    $showArray[$value['showName']][$i++] = $value1;
                }
            }
        }
        //var_dump($showArray,$classArray);exit();
        $this->assign("classArray",$classArray);
        $this->assign("showArray",$showArray);
        $this->assign("showEmpty","<tr><td colspan='9' align='center'>無資料</td></tr>");
        $this->display();
    }
    //TODO: 新增後台頁面
    public function formAddAdminPage(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 addSite 傳入 並且不為空
        if(!isset($request['addActionName']) || empty($request['addActionName'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//頁面action名稱為空，請重新輸入
        }
        if(!isset($request['addShowName']) || empty($request['addShowName'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//頁面顯示名稱為空，請重新輸入
        }
        if(!isset($request['addClassId']) || empty($request['addClassId']) && $request['addClassId'] !== 0){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//頁面類別ID為空，請重新操作
        }
        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $data = array(
           "pageclass_id" => $request['addClassId'],
        );
        $return = $CommonAdminPageclassPage->getMaxOrderDataByClassId($data);
        $maxOrder = 0;
        if(!empty($return)){
            $maxOrder = $return['MaxOrder'];
        }
        $maxOrder++;
        $nowTime = time();//取得現在時間戳
        $data = array(
            "pageclass_id" => $request['addClassId'],
            "page_actionName" => $request['addActionName'],
            "page_showName" => $request['addShowName'],
            "page_order" => $maxOrder,
            "page_createtime" => $nowTime
        );
        $return = $CommonAdminPageclassPage->addAdminPageData($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        //是，顯示成功訊息
        $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
    }
    //TODO: 修改後台頁面
    public function formSetAdminPage(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 setDomainId 傳入 並且不為空
        if(!isset($request['setId']) || (empty($request['setId']) && $request['setId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//無選擇的ID，請重新選擇。
        }
        if(!isset($request['setActionName']) || empty($request['setActionName'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));//Action名稱為空，請重新輸入。
        }
        if(!isset($request['setShowName']) || empty($request['setShowName'])){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));//顯示名稱為空，請重新輸入。
        }

        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $data = array(
            "page_id" => $request['setId']
        );
        $return = $CommonAdminPageclassPage->getAdminPageDataById($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
        }
        $nowTime = time();//取得現在時間戳
        if($request['setClassId'] <> $return['pageclass_id']){
            //修改時 如果Class不同時 把 原本的Class 此ID排序 往後的都-1  把 page_order 新的 修改成新Class MaxOrder
            $data = array(
                "pageclass_id" => $return['pageclass_id'],
                "page_order" => $return['page_order']
            );
            $return = $CommonAdminPageclassPage->setAdminPageOrderByClassIdAndPageOrder($data);
            if($return === false){
                $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));
            }
            $data = array(
                "pageclass_id" => $request['setClassId']
            );
            $return = $CommonAdminPageclassPage->getMaxOrderDataByClassId($data);
            $maxOrder = 0;
            if(!empty($return)){
                $maxOrder = $return['MaxOrder'];
            }
            $maxOrder++;
            $data = array(
                "page_id" => $request['setId'],
                "pageclass_id" => $request['setClassId'],
                "page_actionName" => $request['setActionName'],
                "page_order" => $maxOrder,
                "page_showName" => $request['setShowName'],
                "page_modifyTime" => $nowTime
            );
        } else {
            $data = array(
                "page_id" => $request['setId'],
                "page_actionName" => $request['setActionName'],
                "page_showName" => $request['setShowName'],
                "page_modifyTime" => $nowTime
            );
        }
        $return = $CommonAdminPageclassPage->setAdminPageDataById($data);
        if($return === false){
            //否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_06')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_07')));//操作錯誤，請重新登入。
    }
    //TODO: 刪除後台頁面
    public function formDelAdminPage(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 delId 傳入 並且不為空
        if(!isset($request['delId']) || (empty($request['delId']) && $request['delId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//刪除網址為空，請重新操作
        }
        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $data = array(
            "page_id" => $request['delId']
        );
        $return = $CommonAdminPageclassPage->getAdminPageDataById($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02')));
        }
        $data = array(
            "pageclass_id" => $return['pageclass_id'],
            "page_order" => $return['page_order']
        );
        $return = $CommonAdminPageclassPage->setAdminPageOrderByClassIdAndPageOrder($data);
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));
        }
        $data = array(
            "page_id" => $request['delId']
        );
        $return = $CommonAdminPageclassPage->delAdminPageDataById($data);
        if($return === false){//否，顯示錯誤
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
        }
        //是，影響筆數為1，顯示成功訊息
        if($return === 1){
            $this->success(L(strtoupper('SECCESS_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_05')));//操作錯誤，請重新登入。
    }
    //TODO: 頁面停用
    public function formStopAdminPage(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 ID 傳入 並且不為空
        if(!isset($request['stopId']) || (empty($request['stopId']) && $request['stopId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//傳入ID為空，請重新操作。
        }
        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $data = array(
            "page_id" => $request['stopId'],
            "page_enabled" => 0,
        );
        $return = $CommonAdminPageclassPage->setAdminPageDataById($data);
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
    //TODO: 頁面啟用
    public function formStartAdminPage(){
        //使用 common.php filterStr($data) 公用函數 過濾取得輸入的資料
        $request = $this->getRequest();
        //檢查是否有 ID 傳入 並且不為空
        if(!isset($request['startId']) || (empty($request['startId']) && $request['startId'] !== 0)){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));//傳入ID為空，請重新操作。
        }
        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $data = array(
            "page_id" => $request['startId'],
            "page_enabled" => 1,
        );
        $return = $CommonAdminPageclassPage->setAdminPageDataById($data);
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

        switch ($request['className']) {
            case 'upSort':
                if(!isset($request['orderSort']) || empty($request['orderSort']) && $request['orderSort'] !== 0){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_0')));
                }

                $data = array(
                    'page_order' => $request['orderSort'],
                    'page_order2' => ($request['orderSort'] - 1),
                    'pageclass_id' => $request['sortId'],
                );
                break;

            case 'downSort':
                if(!isset($request['orderSort']) || empty($request['orderSort']) && $request['orderSort'] !== 0){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_0')));
                }

                $data = array(
                    'page_order' => $request['orderSort'],
                    'page_order2' => ($request['orderSort'] + 1),
                    'pageclass_id' => $request['sortId'],
                );
                break;

            default:
                if($return === false){
                    //否，顯示錯誤
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
                }
                break;
        }

        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $return = $CommonAdminPageclassPage->setSortAgentPageClassOrder($data);
        redirect(__APP__.'/AdminPageManage/index');
    }
    //TODO: 開關AJAX
    public function ajaxSwitch(){
        $request = $this->getRequest();
        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $nowTime = time();
        switch($request['mode_id']){
            case 'stopId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "page_id" => $request['stopId'],
                    "page_enabled" => 0,
                );
                $return = $CommonAdminPageclassPage->setAdminPageDataById($data);
                break;
            case 'startId':
                $nowTime = time();//取得現在時間戳
                $data = array(
                    "page_id" => $request['startId'],
                    "page_enabled" => 1,
                );
                $return = $CommonAdminPageclassPage->setAdminPageDataById($data);
                break;
            default:
                break;
        }
    }
}