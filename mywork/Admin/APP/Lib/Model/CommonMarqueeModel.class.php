<?php
/*
 * 前後台跑馬燈
 */
class CommonMarqueeModel extends CommonModel {
    protected $tableName = "common_marquee";
    protected $tableId = "marquee_id";
    /*
     * 取得Client跑馬燈
     */
    public function getClientMarqueeData(){
        $sql = "SELECT `marquee_text` FROM `common_marquee`
                WHERE `marquee_belong` = '1' AND marquee_enabled = '1'
                ORDER BY `marquee_order` ASC;";
        $return = $this->cacheQuery($sql, 300);//緩存查詢 60秒內有效
        return $return;
    }
    /*
     * 取得Agent跑馬燈
     */
    public function getAgentMarqueeData(){
        $sql = "SELECT `marquee_text` FROM `common_marquee`
                WHERE `marquee_belong` = '2' AND marquee_enabled = '1'
                ORDER BY `marquee_order` ASC;";
        $return = $this->cacheQuery($sql, 300);//緩存查詢 60秒內有效
        return $return;
    }
    /*
     * 取得Admin跑馬燈
     */
    public function getAdminMarqueeData(){
        $sql = "SELECT `marquee_text` FROM `common_marquee`
                WHERE `marquee_belong` = '3' AND marquee_enabled = '1'
                ORDER BY `marquee_order` ASC;";
        $return = $this->cacheQuery($sql, 300);//緩存查詢 60秒內有效

        return $return;
    }
    /*
     * 取得跑馬燈資料
     * 跑馬燈管理 使用
     */
    public function getMarqueeDate(){
        $sql = "SELECT * FROM `{$this->tableName}` ORDER BY `marquee_belong`,`marquee_order` ASC;";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 新增跑馬燈
     */
    public function addMarqueeData($data){
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
     * 修改 跑馬燈 資料
     * 使用跑馬燈ID
     */
    public function setMarqueeDataById($data){
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
     * 刪除跑馬燈 資料
     * 使用跑馬燈ID
     */
    public function delMarqueeById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "DELETE FROM `{$this->tableName}`
                WHERE `{$this->tableId}` = '{$data["{$this->tableId}"]}';";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 搜尋跑馬燈 隸屬資料 是否一樣
     * 使用跑馬燈ID
     */
    public function getMarqueeBelongDataById($data){
        if(empty($data["{$this->tableId}"]) && $data["{$this->tableId}"] !== '0'){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}`
                WHERE `{$this->tableId}` = '{$data["{$this->tableId}"]}' LIMIT 1;";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 取得 隸屬資料 最大的排序
     * 使用跑馬燈ID
     */
    public function getMarqueeBelongOrderDataById($data){
        if(empty($data["marquee_belong"]) && $data["marquee_belong"] !== '0'){
            return false;
        }
        $sql = "SELECT Max(`marquee_order`) as MaxOrder FROM `{$this->tableName}`
                WHERE `marquee_belong` = '{$data["marquee_belong"]}';";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0];
    }
    /*
     * 修改 跑馬燈排序 高變低
     * 使用 隸屬資料 和 排序
     */
    public function setMarqueeOrderHighLowDataByBelong($data){
        if(empty($data["marquee_belong"]) && $data["marquee_belong"] !== '0'){
            return false;
        }
        if(empty($data["marquee_order"]) && $data["marquee_order"] !== '0'){
            return false;
        }
        $sql = "UPDATE `{$this->tableName}` SET `marquee_order` = `marquee_order`-1
                WHERE `marquee_belong` = '{$data["marquee_belong"]}'
                AND `marquee_order` > '{$data["marquee_order"]}';";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 跑馬燈排序 高變低
     */
    public function setSortAgentPageClassOrder($data){
        $sql = "UPDATE `{$this->tableName}` a ,`{$this->tableName}` b
            SET a.`marquee_order`='{$data['marquee_order2']}' ,
                b.`marquee_order` = '{$data['marquee_order']}'
            WHERE a.`marquee_order` = '{$data['marquee_order']}'
            AND b.`marquee_order`='{$data['marquee_order2']}'
            AND a.`marquee_belong` = '{$data['marquee_belong']}'
            AND b.`marquee_belong` = '{$data['marquee_belong']}'
            AND a.`marquee_id` = '{$data['marquee_id']}'";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得 後台頁面 資料
     * 修改 頁面 比對資料使用
     */
    public function getMarqueePageData($data){
        if(empty($data['marquee_id']) && $data['marquee_id']){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` WHERE `marquee_id` = '{$data['marquee_id']}';";
        $return = $this->query($sql);
        return $return[0];
    }
    /*
     * 把 marquee_id 的 marquee_order 排序-1
     * 修改頁面 別的Class 使用
     * 使用 marquee_id marquee_order
     */
    public function setMarqueePageOrderByClassIdAndPageOrder($data){
        if(empty($data['marquee_order']) && $data['marquee_order']){
            return false;
        }
        if(empty($data['marquee_belong']) && $data['marquee_belong']){
            return false;
        }
        $sql ="UPDATE `{$this->tableName}` SET `marquee_order` = `marquee_order`-1
                WHERE `marquee_order` > '{$data['marquee_order']}'
                AND `marquee_belong` = '{$data['marquee_belong']}';";
        $return = $this->query($sql);
        return $return;
    }
}