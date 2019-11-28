<?php
class InternalAdminLoginLogModel extends AdminModel {
    protected $tableName = "internal_admin_login_log";
    protected $tableId = "loginLog_id";

    /*
     * 取得 登入資料
     * 登入查詢使用
     */
    public function getAdminLoginLogData($data,&$err=""){
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
    public function getAdminLoginLogStatusStr($data){
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
     * 新增 公司帳號登入 資料
     */
    public function addAdminLoginLogData($data,&$err){
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
    public function getTotalNumberAdminLoginLogData($data){$whereSql = "";
        $whereSql = "";
        if(!empty($data['admin_account'])){
            $whereSql = " AND `admin_account` LIKE '%{$data['admin_account']}%'";
        }

        $sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}`
                WHERE (`loginLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}'){$whereSql}
                ORDER BY `loginLog_createTime` DESC;";
        $return = $this->query($sql);
        return $return;
    }

    /*
     * 搜索分頁
     */
    public function getAdminLoginLogNumberData($data, &$err = ""){
        $whereSql = "";
        if(!empty($data['admin_account'])){
            $whereSql = " AND `admin_account` LIKE '%{$data['admin_account']}%'";
        }

        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = "LIMIT " . $pageStart . "," . $pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` WHERE (`loginLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}') {$whereSql} ORDER BY `loginLog_createTime` DESC {$pageSql};";
        $return = $this->query($sql);

        if($return === false){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return false;
        }
        return $return;
    }
    /*
     * 搜尋 會員 帳號
     */
    public function searchMemberByMemberAccount($data){

        $sql = "SELECT `admin_account`
                FROM `{$this->tableName}`
                WHERE `admin_account` LIKE '" . $data['admin_account'] . "%'
                LIMIT " . $data['limit'];
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
}