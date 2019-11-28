<?php
/*
 * 銀行碼
 */
class CommonBankcodeModel extends AdminModel {
    protected $tableName = "common_bankcode";
    protected $tableId = "bankcode_id";
    /*
     * 取得 銀行碼 資料
     * 銀行代碼管理使用
     */
    public function getBankcodeData(){
        $sql = "SELECT * FROM `{$this->tableName}` ORDER BY `bankcode_code` ASC;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 新增 銀行碼 資料
     */
    public function addBankcodeData($data){
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
     * 修改 銀行碼 資料
     * 使用ID
     */
    public function setBankcodeDataById($data){
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
     * 刪除 銀行碼
     * 使用ID
     */
    public function delBankcodeDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `{$this->tableId}` = '{$data[$this->tableId]}';";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 取得頁數資料
     */
    public function getTotalNumberBankcodeNumber($data){
        if(empty($data['selectBank'])) {
            $whereSql = "";
        } else {
            $whereSql = "WHERE `bankcode_code` = '{$data['selectBank']}'
                    OR `bankcode_name` LIKE '%{$data['selectBank']}%'";
        }
        $sql = "SELECT count(*) AS totalNumber FROM `{$this->tableName}` {$whereSql}";
        $return = $this->query($sql);

        return $return;
    }
    /*
     * 搜尋分頁數
     */
    public function getBankcodeNumberData($data, &$err = ""){
        if(empty($data['selectBank'])) {
            $whereSql = "";
        } else {
            $whereSql = "WHERE `bankcode_code` = '{$data['selectBank']}'
                    OR `bankcode_name` LIKE '%{$data['selectBank']}%'";
        }
        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT " . $pageStart . "," . $pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` {$whereSql} ORDER BY `bankcode_code` ASC {$pageSql};";
        $return = $this->query($sql);

        if($return === false){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_02'));
            return fasle;
        }
        return $return;
    }
}