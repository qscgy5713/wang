<?php
/**
 * 系統紀錄
 */
class CommonSystemLogModel extends AdminModel {
	
	protected $tableName = "common_system_log";
	/*
	 * 取得總筆數
	 */
	public function getSystemLogDataTotal($data){
		$sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}` WHERE (`log_createTime` BETWEEN '{$data["startTime"]}' AND '{$data["endTime"]}')";
		$return = $this->query($sql);
		return $return[0];
	}
	/**
	 * 取得時間內資料
	 */
	public function getSystemLogData($data){
		$pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
		$pageEnd = $data['page']['number'];
		$pageSql = "LIMIT {$pageStart}, {$pageEnd}";
		$sql = "SELECT * FROM `{$this->tableName}` WHERE (`log_createTime` BETWEEN '{$data["startTime"]}' AND '{$data["endTime"]}') ORDER BY `log_id` DESC {$pageSql}";
		$return = $this->query($sql);
		return $return;
	}
}