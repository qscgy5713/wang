<?php
/*
 * 會員銀行碼
 */
class CommonMemberBankdataModel extends AdminModel {
    protected $tableName = "common_member_bankdata";
    protected $tableId = "bankdata_id";


    /*
     * 取得 會員銀行碼 資料筆數
     *  會員綁定管理使用
     */
    public function getTotalNumberMemberBankData($data,&$err = ""){
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " WHERE b.`member_account` LIKE '%{$data['member_account']}%' OR a.`bankdata_code` LIKE '%{$data['member_account']}%'
                OR a.`bankdata_account` LIKE '%{$data['member_account']}%' OR a.`bankdata_name` LIKE '%{$data['member_account']}%'
                OR a.`bankdata_branch` LIKE '%{$data['member_account']}%' OR a.`bankdata_remark` LIKE '%{$data['member_account']}%'";
        }

        $sql = "SELECT count(*) AS totalNumber FROM `{$this->tableName}` a
                JOIN `common_member` b ON (a.`member_id` = b.`member_id`)
                {$whereSql};";
        $return = $this->query($sql);
        if($return === false){
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_01"));
            return false;
        }
        return $return[0];
    }

    /*
     * 取得 會員銀行碼 資料
     * 會員綁定管理使用
     */
    public function getMemberBankData($data){
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " WHERE b.`member_account` LIKE '%{$data['member_account']}%' OR a.`bankdata_code` LIKE '%{$data['member_account']}%'
                OR a.`bankdata_account` LIKE '%{$data['member_account']}%' OR a.`bankdata_name` LIKE '%{$data['member_account']}%'
                OR a.`bankdata_branch` LIKE '%{$data['member_account']}%' OR a.`bankdata_remark` LIKE '%{$data['member_account']}%'";
        }
        $pageStrat = ($data["page"]["pageNumber"]-1)*$data["page"]["number"];
        $pageEnd = $data["page"]["number"];
        $pageSql = " LIMIT ".$pageStrat.",".$pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_member` b ON (a.`member_id` = b.`member_id`)
                {$whereSql} {$pageSql};";

        $return = $this->query($sql);
        return $return;
    }
    /*
     * 修改 會員銀行碼 資料
     * 使用ID
     */
    public function setMemberBankDataById($data){
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
     * 刪除 會員銀行碼 資料
     * 使用ID
     */
    public function delMemberBankDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `{$this->tableId}` = '{$data[$this->tableId]}';";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 取得 會員銀行碼 資料
     * 會員綁定管理使用
     */
    public function getMemberBankDataForLog($data){
        $sql = "SELECT * FROM `{$this->tableName}` a
                JOIN `common_member` b ON (a.`member_id` = b.`member_id`)
                WHERE `bankdata_id` = '{$data['bankdata_id']}';";
        $return = $this->query($sql);
        return $return[0];
    }
}