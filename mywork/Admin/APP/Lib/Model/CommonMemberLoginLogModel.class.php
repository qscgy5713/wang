<?php
/*
 * 會員登入紀錄
 */
class CommonMemberLoginLogModel extends AdminModel {
    protected $tableName = "common_member_login_log";
    protected $tableId = "loginLog_id";
    /*
     * 取得 會員登入資料 
     * 使用 統計腳本
     */
    public function getMemberLoginLogUseStatistics($data,&$err=""){
        if(empty($data["startTime"]) && $data["startTime"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        if(empty($data["endTime"]) && $data["endTime"] !== '0'){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "SELECT * FROM  `{$this->tableName}`
                WHERE (`loginLog_createTime` BETWEEN '{$data["startTime"]}' AND '{$data["endTime"]}')";
        $return = $this->query($sql);
        if($return === false){//否，顯示錯誤
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        return $return;
    }
    /*
     * 取得會員 重複IP資料
     */
    public function getMemberRepeatIpData($data,&$err=""){
        if(empty($data['member_account']) && $data['member_account'] !== 0){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        if(empty($data['repeatTime']) && $data['repeatTime'] !== 0){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        $sql = "SELECT `loginLog_ip`,count(`member_account`) as number,GROUP_CONCAT(`member_account`) as allAccount FROM (
                	SELECT DISTINCT `member_account`,`loginLog_ip` FROM `{$this->tableName}` WHERE `loginLog_createTime` > '{$data['repeatTime']}'
                ) as a GROUP BY `loginLog_ip`
                HAVING count(`member_account`) > 1 AND allAccount LIKE '%{$data['member_account']}%'";
        $return = $this->query($sql);
        if($return === false){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_03'));
            return false;
        }
        $returnArray = array();
        foreach ($return as $key => $value){
            $accountArray = explode(',', $value['allAccount']);
            //因為帳號 %帳號% 搜尋 可能會有不等於帳號的結果 因此篩選掉
            if(in_array($data['member_account'],$accountArray)){
                array_push($returnArray,$value);
            }
        }
        return $returnArray;
    }
    /*
     * 取得 登入資料
     * 登入查詢使用
     */
    public function getMemberLoginLogData($data,&$err=""){
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE (`loginLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}')
                ORDER BY `loginLog_createTime` DESC;";
        $return = $this->query($sql);
        return $return;
    }
    
    /*
     * 取得登入狀態
     * 登入狀態 0登入失敗 1登入成功
     */
    public function getMemberLoginLogStatusStr($data){
        $returnStr = "";
        switch ($data){
            case "0":
                $returnStr = "登入失敗";
                break;
            case "1":
                $returnStr = "登入成功";
                break;
            default:
                $returnStr = "";
                break;
        }
        return $returnStr;
    }
    /*
     * 新增 管理者 資料
     */
    public function addMemberLoginLogData($data,&$err = ""){
        $sql = "INSERT INTO `{$this->tableName}` ";
        $keysql = "";
        $valuesql = "";
        foreach ($data as $key => $value) {
            if(empty($keysql)){
                $keysql = " (`{$key}`";
            } else {
                $keysql .= ",`{$key}`";
            }
            if(empty($valuesql)){
                $valuesql = " ('{$value}'";
            } else {
                $valuesql .= ",'{$value}'";
            }
        }
        $sql .= $keysql.") VALUES ".$valuesql.");";
        $return = $this->query($sql);
        if($return === false){//否，顯示錯誤
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        return $return;
    }

    /*
     * 取得頁數資料 
     */
    public function getTotalNumberLoginLogData($data){
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " AND `member_account` LIKE '%{$data['member_account']}%'";
        }

        $sql = "SELECT COUNT(*) AS totalNumber 
                FROM `{$this->tableName}` 
                WHERE (`loginLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}')
                {$whereSql} 
                ORDER BY `loginLog_createTime` DESC;";
        $return = $this->query($sql);

        return $return;
    }

    /*
     * 搜索分頁
     */
    public function getLoginLogNumberData($data, &$err = ""){
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " AND `member_account` LIKE '%{$data['member_account']}%'";
        }

        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT " . $pageStart . "," . $pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` 
                WHERE (`loginLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}')
                {$whereSql} 
                ORDER BY `loginLog_createTime` DESC{$pageSql};";
        $return = $this->query($sql);

        if($return === false){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        return $return;
    }
    /*
     * 前端 text 下拉單使用
     * 搜尋 會員 帳號
     */
    public function searchMemberByMemberAccount($data){
        
        $sql = "SELECT `member_account`
                FROM `{$this->tableName}`
                WHERE `member_account` LIKE '" . $data['member_account'] . "%'
                LIMIT " . $data['limit'];
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 取得會員登入資料
     * 託售確認頁面處理
     */
    public function getMemberLoginDataUseProcessWithdraw($data,&$err=""){
        if(empty($data['member_id']) && $data['member_id'] !== 0){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `member_id` = '{$data['member_id']}' AND `loginLog_status` = 1
                ORDER BY `loginLog_createTime` DESC LIMIT 5";
        $return = $this->query($sql);
        if($return === false){
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_01"));
            return false;
        }
        return $return;
    }
}