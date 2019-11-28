<?php
/**
 * 公司變更紀錄
 */
class InternalAdminOperateLogModel extends AdminModel{
	protected $tableName = "internal_admin_operate_log";
	/**
	 * 檢視 操作紀錄
	 */
	public function getAdminOperateLogData(){
		$sql = "SELECT * FROM `{$this->tableName}`";
		$return = $this->query($sql);

		return $return;
	}
	/**
	 * 新增 操作紀錄
	 */
	public function addAdminOperateLogData($data){
		$sql ="INSERT INTO `{$this->tableName}`";
		$keySql = "";
		$valSql = "";
		foreach ($data as $key => $value) {
			if(empty($keySql)){
				$keySql = "(`{$key}`";
			} else {
				$keySql .= ",`{$key}`";
			}
			if(empty($valSql)){
				$valSql = "('{$value}'";
			} else {
				$valSql .= ",'{$value}'";
			}
		}
		$sql .= "{$keySql} ) VALUES {$valSql});";
		$return = $this->query($sql);
		return $return;
	}
	/*
     * 取得登入狀態
     * 登入狀態 0登入失敗 1登入成功
     */
    public function getOperateLogClassStr($data){
        $returnStr = "";
        switch ($data){
            case "0":
                $returnStr = "登入失敗";
                break;
            case "1":
                $returnStr = "登入成功";
                break;
            case "11":
                $returnStr = "新增代理";
                break;
            case "12":
                $returnStr = "修改代理";
                break;
            case "13":
                $returnStr = "停權代理";
                break;
            case "14":
                $returnStr = "啟用代理";
                break;
            case "21":
                $returnStr = "新增公司帳號";
                break;
            case "22":
                $returnStr = "修改公司帳號";
                break;
            case "23":
                $returnStr = "停權公司帳號";
                break;
            case "24":
                $returnStr = "啟用公司帳號";
                break;
            case "31":
                $returnStr = "修改會員銀行紀錄";
                break;
            case "32":
                $returnStr = "刪除會員銀行紀錄";
                break;
            case "41":
                $returnStr = "停權會員紀錄";
                break;
            case "42":
                $returnStr = "啟用會員紀錄";
                break;
            default:
                $returnStr = "";
                break;
        }
        return $returnStr;
    }
    /*
     * 取得 登入資料
     * 登入查詢使用
     */
    public function getAdminOperateLoggDataTotalNum($data,&$err=""){
        $sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}`
        				WHERE ( `operateLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}')
                ORDER BY `operateLog_createTime` DESC;";
        $return = $this->query($sql);
        return $return[0];
    }
    /*
     * 搜索分頁數
     */
    public function getAdminOperateLogNumberData($data){
        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT {$pageStart}, {$pageEnd}";

        $sql ="SELECT * FROM `{$this->tableName}` WHERE ( `operateLog_createTime` BETWEEN '{$data['startTime']}' AND '{$data['endTime']}')
            ORDER BY `operateLog_createTime` DESC {$pageSql};";
        $return = $this->query($sql);

        return $return;
    }
}