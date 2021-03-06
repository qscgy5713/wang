<?php
/*
 * 後台頁面分類
 */
class CommonAdminPageclassModel extends CommonModel {
    protected $tableName = "common_admin_pageclass";
    /*
     * 取得後台頁面
     * 顯示 頁面 使用
     */
    public function getAdminPageClassDataUse(){
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `pageclass_enabled` = '1' ORDER BY `pageclass_order`;";
        $return = $this->cacheQuery($sql,600);
        return $return;
    }
    /*
     * 取得後台頁面
     * 頁面管理 使用
     */
    public function getAdminPageClassDataByEnabled(){
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `pageclass_enabled` = '1';";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得後台頁面
     * 頁面管理 使用
     */
    public function getAdminPageClassData(){
        $sql = "SELECT * FROM `{$this->tableName}`;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得 後台頁面 分類的最大排序
     * 頁面管理 使用
     */
    public function getMaxOrderData(){
        $sql = "SELECT MAX(`pageclass_order`) as MaxOrder FROM `{$this->tableName}`;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 新增後台頁面類別
     */
    public function addAdminPageClassData($data){
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
     * 修改 後台頁面 資料
     * 使用後台頁面ID
     */
    public function setAdminPageClassDataById($data){
        if(empty($data['pageclass_id']) && $data['pageclass_id'] !== '0'){
            return false;
        }
        $sql = "";
        foreach ($data as $key => $value) {
            if($key == 'pageclass_id'){continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }
        $sql .= " WHERE `pageclass_id` = '{$data['pageclass_id']}'";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 後台頁面  資料
     * 使用後台頁面ID
     */
    public function delAdminPageClassDataById($data){
        if(empty($data['pageclass_id']) && $data['pageclass_id'] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `pageclass_id` = '".$data['pageclass_id']."';";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 取得後台頁面 總筆數
     */
    public function getTotalNumberAdminPageClassData(){
        $sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}`;";
        $return = $this->query($sql);

        return $return[0];
    }
    /*
     * 搜索後台頁面 分頁
     */
    public function getAdminPageClassDataNumber($data){
        $sql = "SELECT * FROM `{$this->tableName}` ORDER BY `pageclass_order` ASC;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 代理頁面 排序
     */
    public function setSortAgentPageClassOrder($data){
        $sql = "UPDATE `{$this->tableName}` a ,`{$this->tableName}` b
            SET a.`pageclass_order`='{$data['pageclass_order2']}' ,
                b.`pageclass_order` = '{$data['pageclass_order']}'
            WHERE a.`pageclass_order` = '{$data['pageclass_order']}'
            AND b.`pageclass_order`='{$data['pageclass_order2']}'";
        $return = $this->query($sql);

        return $return;
    }
    /*
     * 取得 後台頁面 資料
     * 修改 頁面 比對資料使用
     */
    public function getAdminPageData($data){
        if(empty($data["pageclass_id"]) && $data["pageclass_id"]){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` WHERE `pageclass_id` = '{$data['pageclass_id']}'";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 把 pageclas_id 的 pageclass_order 排序往前 -1
     * 修改頁面到 別的 Class 使用
     * 使用 pageclas_id pageclass_order
     */
    public function setAdminPageOrderByClassIdAndPageOrder($data){
        if(empty($data["pageclass_order"]) && $data["pageclass_order"] !== '0'){
            return false;
        }
        $sql = "UPDATE `{$this->tableName}` SET `pageclass_order` = `pageclass_order` - 1
                WHERE  `pageclass_order` > '{$data['pageclass_order']}';";
        $return = $this->query($sql);
        return $return;
    }
}