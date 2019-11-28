<?php
/*
 * 公司帳號權限
 */
class InternalAdminSubPagepowerModel extends AdminModel {
    protected $tableName = "internal_admin_sub_pagepower";
    protected $tableId = "power_id";
    /*
     * 新增 公司帳號 權限
     */
    public function addAdminPagepowerData($data){
        if(empty($data["admin_id"]) && $data["admin_id"] !== '0'){
            return false;
        }
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
        return $return;
    }
    /*
     * 修改 公司帳號 權限
     */
    public function setAdminPagepowerDataById($data){
        if(empty($data["admin_id"]) && $data["admin_id"] !== '0'){
            return false;
        }
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == "admin_id"){continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `admin_id` = '{$data['admin_id']}';";
        $return = $this->execute($sql);
        return $return;
    }

    /*
     * 刪除 公司帳號 權限
     */
    public function delAdminPagepowerDataById($data){
        if(empty($data["admin_id"]) && $data["admin_id"] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `admin_id` = '{$data["admin_id"]}';";
        $return = $this->execute($sql);
        return $return;
    }
}