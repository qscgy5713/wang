<?php
/*
 * 網域
 */
class CommonAdminPageclassPageModel extends CommonModel {
    protected $tableName = "common_admin_pageclass_page";
    protected $tableId = "page_id";
    /*
     * 取得後台頁面
     * 顯示 頁面 使用
     */
    public function getAdminPageDataUse(){
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `page_enabled` = '1' ORDER BY `pageclass_id`, `page_order`;";
        $return = $this->cacheQuery($sql,600);
        return $return;
    }
    /*
     * 取得 後台頁面 資料
     * 修改 頁面 比對資料使用
     *
     */
    public function getAdminPageDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `{$this->tableId}` = '{$data[$this->tableId]}';";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 把 pageclas_id 的 page_order 排序往前 -1
     * 修改頁面到 別的 Class 使用
     * 使用 pageclas_id page_order
     */
    public function setAdminPageOrderByClassIdAndPageOrder($data){
        if(empty($data["pageclass_id"]) && $data["pageclass_id"] !== '0'){
            return false;
        }
        if(empty($data["page_order"]) && $data["page_order"] !== '0'){
            return false;
        }
        $sql = "UPDATE `{$this->tableName}` SET `page_order` = `page_order`-1
                WHERE `pageclass_id` = '{$data['pageclass_id']}' AND `page_order` > {$data['page_order']};";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得後台頁面
     * 頁面管理 使用
     */
    public function getAdminPageData(){
        $sql = "SELECT * FROM `{$this->tableName}` p,`common_admin_pageclass` c
                WHERE p.`pageclass_id` = c.`pageclass_id`
                ORDER BY `pageclass_order`,`page_order` ASC;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得 後台頁面 分類的最大排序
     * 頁面管理 使用
     */
    public function getMaxOrderDataByClassId($data){
        if(empty($data['pageclass_id']) && $data['pageclass_id'] !== '0'){
            return false;
        }
        $sql = "SELECT MAX(`page_order`) as MaxOrder FROM `{$this->tableName}` WHERE `pageclass_id` = '".$data['pageclass_id']."';";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 新增後台頁面
     */
    public function addAdminPageData($data){
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
    public function setAdminPageDataById($data){
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
        $sql .= " WHERE `{$this->tableId}` = '{$data[$this->tableId]}'";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 後台頁面  資料
     * 使用後台頁面ID
     */
    public function delAdminPageDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `page_id` = '".$data[$this->tableId]."';";
        $return = $this->execute($sql);
        return $return;
    }
    /*
     * 代理頁面 排序
     */
    public function setSortAgentPageClassOrder($data){
        $sql = "UPDATE `{$this->tableName}` a ,`{$this->tableName}` b
            SET a.`page_order`='{$data['page_order2']}' ,
                b.`page_order` = '{$data['page_order']}'
            WHERE a.`page_order` = '{$data['page_order']}'
            AND b.`page_order`='{$data['page_order2']}'
            AND a.`pageclass_id`='{$data['pageclass_id']}'
            AND b.`pageclass_id`='{$data['pageclass_id']}'";
        $return = $this->query($sql);

        return $return;
    }
    /*
     * 取得各部門 總筆數
     */
    public function getClassNameToatlNumber($data){
        $sql = "SELECT max(`page_order`) as maxOrder FROM `{$this->tableName}`
                WHERE `pageclass_id` = '{$data['pageclass_id']}'";

        $return = $this->query($sql);
        return $return[0];
    }
}