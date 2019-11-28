<?php
/**
 * 管理Action
 */
class AdminAction extends CommonAction {
    /**
     * 初始化
     */
    protected function _initialize() {
        // 執行父類初始化
        parent::_initialize();

        $this->getLangArray();//取得語系檔陣列到前端

        $sietData = C('SIETDATA');
        $titleName = "";
        switch ($sietData){
            case 'test':
                $titleName = "管理";
                break;
            case 'demo':
                $titleName = "管理";
                break;
            case 'official':
                $titleName = "管理";
                break;
        }
        $this->assign("titleName",$titleName);

        $host = explode(".",$_SERVER['HTTP_HOST']);
        switch (count($host)){
            case 3:
                if($host[1] == ""){
                    exit();
                }
                break;
            case 2:
                if($host[0] == ""){
                    exit();
                }
                break;
        }

        $request = $this->getRequest();


        $returnArray = array(
            "ajaxGetMemberPoint",
            "ajaxRemakeMemberGameAccount",
            "ajaxOpenMemberGameAccount",
            "searchMemberName", 
            "eachGameDetail",
            "formDelAdmin",//公司帳號管理 刪除公司帳號
            "formStopAdmin",//公司帳號管理 停權公司帳號
            "formStartAdmin",//公司帳號管理 啟用公司帳號
            "ajaxSwitch",//公司帳號管理 啟用、停用公司帳號
            "formSortAgentPageClass",//排序
            "getAjaxUnprocessedForm",//取得未處理訂單
        );
        if(in_array($request['_URL_'][1], $returnArray)){
            if(!($this->isAdminLogin())){
                exit();
            }
            return;
        }

        //var_dump($_SESSION);exit();

        //判斷代理是否已登入
        if(!($this->isAdminLogin())){
            //否，無登入狀態
            $this->assign("isLogin","false");
            if($request['_URL_'][0] != 'AdminIndex'){
                redirect(__APP__.'/AdminIndex/index');
            }
            return;
        }

        //判定有 登入後 所做的事
        $this->getAdminData();

        //是，登入狀態，判斷 公司帳號 是否停權
        if($this->isAdminLosePower()){
            //是  倒回首頁 顯示停權 視窗
            $status = $_SESSION['Admin']['status'];
            unset($_SESSION['Admin']);
            //$this->assign("waitSecond","15");
            $this->assign("jumpUrl","__APP__/AdminIndex/index");
            switch($status){
                case 1://一般停權
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
                    break;
            }
            return;
        }

        //判斷 代理 是否被踢登出 或 重複登入
        if($this->isAdminOutLogin()){
            //是  倒回首頁 顯示停權 視窗
            unset($_SESSION['Admin']);
            //$this->assign("waitSecond","15");
            $this->assign("jumpUrl","__APP__/AdminIndex/index");
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03')));
            return;
        }

        $showPageArray = $this->getPageArray($request);


        //頁面權限管理
        if(!empty($request['_URL_'][0])){
            if($_SESSION['Admin']['account'] != 'game'){
                $actionNamePower = cookie('admin_adminActionPower');
                if(!empty($actionNamePower)){
                    $actionNamePowerArray = explode(",", $actionNamePower);
                    if(!in_array($request['_URL_'][0],$actionNamePowerArray) && $request['_URL_'][0] != 'AdminIndex' ){
                        $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_04')));
                        exit();
                        //redirect(__APP__.'/AdminIndex/index');
                    }
                    //&& $request['_URL_'][0] != 'Admin'
                }
            }
        }

        $this->getAdminMarquee();//跑馬燈
        $this->getAdminAnnouncement();//全版公告

        $_SESSION['Admin']['isFirstLogin'] = '0';//讀取後 改完 不是第一次登入
        $this->assign("isLogin","true");
        $this->assign("adminAccount",$_SESSION['Admin']['account']);
        $this->assign("showPageArray",$showPageArray);
    }
    protected function getRandStr($len)//驗證碼使用
    {
        $chars = array(
            "0", "1", "2","3", "4", "5", "6", "7", "8", "9"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars);
        $output = "";
        for ($i=0; $i<$len; $i++)
        {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }

    /*
     * 讀取用戶資料
     * 重新取得 帳號 資訊
     */
    protected function getAdminData(){
        if((time() - $_SESSION['Admin']['isRenewLoad']) > 5){
            if(strtolower($_SESSION['Admin']['account']) != "game"){
                $InternalAdmin = D("InternalAdmin");
                $data = array(
                    "admin_id" => $_SESSION['Admin']['id']
                );
                $return = $InternalAdmin->getAdminDataPageDataById($data);
                if($return === false){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
                }
                $_SESSION['Admin']['uid'] = $return['admin_uid'];
                $_SESSION['Admin']['status'] = $return['admin_status'];
                $_SESSION['Admin']['pageData'] = substr($return['power_main'],0,-1);
            } else {
                $InternalAdmin = D("InternalAdmin");
                $data = array(
                    "admin_account" => $_SESSION['Admin']['account'] //登入的帳號
                );
                $return = $InternalAdmin->getAdminDataByAccount($data);
                if($return === false){
                    $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
                }
                $_SESSION['Admin']['uid'] = $return['admin_uid'];
                $_SESSION['Admin']['status'] = $return['admin_status'];
            }
        }
    }
    /*
     * 判斷 帳號 是否登入
     */
    protected function isAdminLogin() {
        //判斷 SESSION 是否存在
        if(!isset($_SESSION['Admin']['account']) && !isset($_SESSION['Admin']['id'])){
            //否，回傳 false
            return false;
        }
        //是，回傳 true
        return true;
    }
    /*
     *  判斷 帳號 是否被踢除或異地登入
     */
    protected function isAdminOutLogin() {
        //game可以多重登入
        if($_SESSION['Admin']['account'] == 'game'){
            return false;
        }
        //判斷 uid 是否與SESSION 的 login_uid 一致
        if($_SESSION['Admin']['uid'] === $_SESSION['Admin']['login_uid']){
            //是，回傳 false
            return false;
        }
        //否，回傳 true
        return true;
    }
    /*
     *  判斷 帳號 是否停權
     */
    protected function isAdminLosePower() {
        //判斷 common_member member_status 是否是停權狀態
        if($_SESSION['Admin']['status'] == 1){
            //是，回傳 true
            return true;
        }
        //否，回傳 false
        return false;
    }
    //TODO:跑馬燈
    protected function getAdminMarquee(){
        //從 CommonMarqueeModel getAdminMarqueeData() 取得前台跑馬燈資料
        $CommonMarquee = D("CommonMarquee");
        $return = $CommonMarquee->getAdminMarqueeData();
        if ($return === false) {
            //$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $marqueeShowArray = array();
        foreach($return as $value){
            $textArray = json_decode($value['marquee_text'], true);
            $data = array(
                'marquee_text' => $textArray[$_COOKIE['think_language']]
            );
            array_push($marqueeShowArray, $data);
        }
        $this->assign("marqueeArray",$marqueeShowArray);
    }
    //TODO:全版公告
    protected function getAdminAnnouncement(){
        //從 CommonAnnouncementModel getAdminAnnouncementData() 取得前台跑馬燈資料
        $CommonAnnouncement = D("CommonAnnouncement");
        $return = $CommonAnnouncement->getAdminAnnouncementData();
        if ($return === false) {
            //$this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        if(count($return) == 0){
            $this->assign("announcementBool",false);
        } else {
            $this->assign("announcementBool",true);
        }
        $this->assign("announcementArray",$return);
    }
    /*
     *  取得頁面資訊
     */
    protected function getPageArray($request){

        $CommonAdminPageclass = D("CommonAdminPageclass");//讀取頁面Class
        $return = $CommonAdminPageclass->getAdminPageClassDataUse();
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $classArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "pageclass_id"=>"id",
            "pageclass_showName"=>"showName"
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $classArray[$key][$value1] = $showStr;
            }
        }

        $CommonAdminPageclassPage = D("CommonAdminPageclassPage");
        $return = $CommonAdminPageclassPage->getAdminPageDataUse();
        if($return === false){
            $this->error(L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01')));
        }
        $pageArray = array();
        //使用欄位轉換  資料庫欄位 => 輸出名稱
        $FieldChange = array(
            "page_id"=>"id",
            "pageclass_id"=>"classId",
            "page_actionName"=>"actionName",
            "page_showName"=>"showName"
        );
        $showStr = "";
        foreach ($return as $key => $value){
            foreach ($FieldChange as $key1 => $value1){
                //欄位特別處理
                switch ($key1){
                    default://未做設定 正常顯示
                        $showStr = $value[$key1];
                        break;
                }
                $pageArray[$key][$value1] = $showStr;
            }
        }
        $showPageArray = array();
        $actionNamePower = "";
        $classShowName = "";//前端顯示 的 頁面類別
        $pageShowName = "";
        //var_dump($request['_URL_'][0]);
        if(strtolower($_SESSION['Admin']['account']) == 'game'){
            foreach($classArray as $classkey => $classvalue){
                $i = 0;
                foreach($pageArray as $pagekey => $pagevalue){
                    if($classvalue['id'] == $pagevalue['classId']){
                        if(empty($actionNamePower)){
                            $actionNamePower = $pagevalue['actionName'];
                        } else {
                            $actionNamePower .= ",".$pagevalue['actionName'];
                        }
                        $showPageArray[$classvalue['showName']][$i] = $pagevalue;
                        $i++;
                        if($request['_URL_'][0] == $pagevalue['actionName']){
                            $classShowName = $classvalue['showName'];
                            $pageShowName = $pagevalue['showName'];
                        }
                    }
                }
            }
        } else {
            $powerArray = explode(",",$_SESSION['Admin']['pageData']);
            foreach($classArray as $classkey => $classvalue){
                $i = 0;
                foreach($pageArray as $pagekey => $pagevalue){
                    if (in_array($pagevalue['id'], $powerArray)) {
                        if($classvalue['id'] == $pagevalue['classId']){
                            if(empty($actionNamePower)){
                                $actionNamePower = $pagevalue['actionName'];
                            } else {
                                $actionNamePower .= ",".$pagevalue['actionName'];
                            }
                            $showPageArray[$classvalue['showName']][$i] = $pagevalue;
                            $i++;
                            if($request['_URL_'][0] == $pagevalue['actionName']){
                                $classShowName = $classvalue['showName'];
                                $pageShowName = $pagevalue['showName'];
                            }
                        }
                    }
                }
            }
        }
        $this->assign("classShowName",$classShowName);//前端顯示 的 頁面類別
        $this->assign("pageShowName",$pageShowName);
        cookie('adminActionPower',$actionNamePower,'expire=600&prefix=admin_');
        return $showPageArray;
    }
    /**
     * 新增 操作紀錄
     * @param [array] $addData
     */
    protected function addAdminOperateLog($addData){
        $InternalAdminOperateLog = D("InternalAdminOperateLog");
        $ip = getIp();
        $ip = get_ip_inet_pton($ip);
        $nowTime = time();
        $data = array(
            'admin_id'=>$_SESSION['Admin']['id'],
            'admin_account'=>$_SESSION['Admin']['account'],
            'operateLog_class'=>$addData['operateLog_class'],
            'operateLog_objectId'=>$addData['operateLog_objectId'],
            'operateLog_objectAccount'=>$addData['operateLog_objectAccount'],
            'operateLog_main'=>json_encode($addData['operateLog_main']),
            'operateLog_createTime'=>$nowTime,
            'operateLog_ip'=>$ip,
            'operateLog_url'=>get_url(),
        );
        $return = $InternalAdminOperateLog->addAdminOperateLogData($data);
    }
}