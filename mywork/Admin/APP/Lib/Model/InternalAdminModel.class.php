<?php
/*
 * 管理者帳號
 */
class InternalAdminModel extends AdminModel {
    protected $tableName = "internal_admin";
    protected $tableId = "admin_id";

    /*
     * 取得 管理者 資料
     * 登入使用
     */
    public function getAdminDataByAccount($data){
        if(empty($data['admin_account']) && $data['admin_account'] !== '0'){
            return false;
        }
        if($data['admin_account'] == 'game'){
            $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `admin_account` = '".$data['admin_account']."'
                LIMIT 1;";
        } else {
            $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `internal_admin_sub_pagepower` b ON(a.`admin_id`=b.`admin_id`)
                WHERE a.`admin_account` = '".$data['admin_account']."'
                LIMIT 1;";
        }
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }

    /*
     * 取得 管理者 資料
     * 取得頁面權限使用
     */
    public function getAdminDataPageDataById($data){
        if(empty($data['admin_id']) && $data['admin_id'] !== '0'){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `internal_admin_sub_pagepower` b ON(a.`admin_id`=b.`admin_id`)
                WHERE a.`admin_id` = '".$data['admin_id']."'
                LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }

    /*
     * 密碼MD5
     */
    public function getMd5Password($password){
        return md5($password . C("HASH_KEY"));
    }
    /*
     * 取得 管理者 資料
     * 公司帳號管理使用
     */
    public function getAdminData(){
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `internal_admin_sub_pagepower` b ON(a.`admin_id` = b.`admin_id`) ;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 新增 管理者 資料
     */
    public function addAdminData($data,&$err=""){

        $power_main = $data['power_main'];
        //開始事務處理
        $this->startTrans();

        $sql = "INSERT INTO `{$this->tableName}` ";
        $keysql = "";
        $valuesql = "";
        foreach ($data as $key => $value) {
            if($key == "power_main"){ continue;}
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
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_01"));
            return $return;
        }
        //新增成功 回傳ID
        $insertId = $this->getLastInsertId();
        if(empty($insertId)){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_02"));
            return false;
        }

        //把頁面權限 加入 common_agent_sub_pagepower
        $InternalAdminSubPagepower = D("InternalAdminSubPagepower");
        $data = array(
            "admin_id" => $insertId,
            "power_main" => $power_main
        );
        $return = $InternalAdminSubPagepower->addAdminPagepowerData($data);
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_03"));
            return false;
        }
        $this->commit();//事務處理成功

        return true;
    }
    /*
     * 修改 管理者 資料
     * 使用ID
     * 停權 啟用 使用
     */
    public function setAdminDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == "{$this->tableId}"){continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `{$this->tableId}` = '{$data[$this->tableId]}';";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 修改 管理者 資料
     * 使用ID
     */
    public function setAdminDataPageDataById($data,&$err=""){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $power_main = $data['power_main'];
        //開始事務處理
        $this->startTrans();
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == "{$this->tableId}"){continue;}
            if($key == "power_main"){ continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `{$this->tableId}` = '{$data[$this->tableId]}';";
        $return = $this->execute($sql);
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_01"));
            return $return;
        }

        $InternalAdminSubPagepower = D("InternalAdminSubPagepower");
        $data = array(
            "{$this->tableId}" => $data[$this->tableId],
            "power_main" => $power_main
        );
        $return = $InternalAdminSubPagepower->setAdminPagepowerDataById($data);
        if($return === false){
            $this->rollback();//事務處理失敗 回退
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_02"));
            return false;
        }
        $this->commit();//事務處理成功

        return true;
    }
    /*
     * 刪除 公司帳號
     * 使用ID
     */
    public function delAdminDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `{$this->tableId}` = '{$data[$this->tableId]}';";
        $return = $this->execute($sql);

        $InternalAdminSubPagepower = D("InternalAdminSubPagepower");
        $data = array(
            "{$this->tableId}" => $data[$this->tableId]
        );
        $return = $InternalAdminSubPagepower->delAdminPagepowerDataById($data);

        return $return;
    }
    /*
     * 取得總頁數
     */
    public function getTotalNumberAdminData(){
        $sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}` a
                JOIN `internal_admin_sub_pagepower` b ON(a.`admin_id` = b.`admin_id`) ;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 搜索分頁數
     */
    public function getAdminNumberData($data){
        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT " . $pageStart . "," . $pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `internal_admin_sub_pagepower` b ON(a.`admin_id` = b.`admin_id`){$pageSql};";
        $return = $this->query($sql);
        return $return;
    }
    /**
     * 搜索 帳號
     */
    public function sreachAdminAccount($data){
        if(!empty($data['admin_id'])){
            $whereSql = "WHERE a.`admin_id` = '{$data['admin_id']}'";
        }
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `internal_admin_sub_pagepower` b ON(a.`admin_id` = b.`admin_id`)
                {$whereSql}
                ORDER BY a.`admin_id` DESC";
        $return = $this->query($sql);
        return $return[0];
    }
}