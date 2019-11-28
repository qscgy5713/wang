<?php
/*
 * 會員信件
 */
class CommonMemberMailModel extends CommonModel{
	protected $tableName = "common_member_mail";

	/*
	 * 取得會員信件
	 */
	public function getCommonMemberMailData(){
		$sql = "SELECT {$this->tableName}.*, common_member.member_account  FROM `{$this->tableName}` INNER JOIN `common_member` ON {$this->tableName}.member_id = common_member.member_id WHERE `mail_status` = '2' ORDER BY `mail_id` DESC;";

		$return = $this->query($sql);

		return $return;
	}

	/*
	 *
	 */
	public function addCommonMemberMailData($data){
		$sql = "INSERT INTO `{$this->tableName}`";
		$keysql = "";
		$valuesql = "";

		foreach ($data as $key => $value) {
			if(empty($keysql)){
				$keysql = "(`{$key}`";
			} else {
				$keysql .= ",`{$key}`";
			}

			if(empty($valuesql)){
				$valuesql = "('{$value}'";
			} else {
				$valuesql .= ",'{$value}'";
			}
		}

		$sql .= $keysql . ") VALUES " . $valuesql . ");";
		$return = $this->query($sql);

		return $return;
	}

	/*
	 * 修改 會員信件 資料
	 * 回覆訊息
	 */
	public function replyCommonMemberMailData($data){
		if(empty($data['mail_id']) && $data['mail_id'] !== '0'){
            return false;
        }

        $sql = "";

        foreach ($data as $key => $value) {
            if($key == 'mail_id'){continue;}
            if(empty($sql)){
                $sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
            } else {
                $sql .= ",`{$key}` = '{$value}'";
            }
        }

        $sql .= " WHERE `mail_id` = '{$data['mail_id']}'";

        $return = $this->execute($sql);

        return $return;

	}
	/**
	 * 取得回覆資料筆數
	 */
	public function getCommonMemberMailReplyNumberData($data){
		if(!empty($data['member_account'])){
			$whereSql = " AND common_member.`member_account` = '{$data['member_account']}'";
		}
		$sql = "SELECT COUNT(*) AS totalNumber  FROM `{$this->tableName}` INNER JOIN `common_member` ON {$this->tableName}.member_id = common_member.member_id
			WHERE (`mail_status` = '0' OR `mail_status` = '1')
			AND (`mail_createTime` BETWEEN '{$data["startTime"]}' AND '{$data["endTime"]}') {$whereSql}
			ORDER BY `mail_id` DESC;";
		$return = $this->query($sql);
		return $return[0];
	}
	/**
	 * 取得回覆 資料
	 */
	public function getCommonMemberMailReplyPageData($data){
		if(!empty($data['member_account'])){
			$whereSql = " AND common_member.`member_account` = '{$data['member_account']}'";
		}
		$startSql = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
		$endSql = $data['page']['number'];
		$pageSql = " LIMIT {$startSql},{$endSql}";
		$sql = "SELECT {$this->tableName}.*, common_member.member_account  FROM `{$this->tableName}` INNER JOIN `common_member` ON {$this->tableName}.member_id = common_member.member_id
			WHERE (`mail_status` = '0' OR `mail_status` = '1')
			AND (`mail_createTime` BETWEEN '{$data["startTime"]}' AND '{$data["endTime"]}') {$whereSql}
			ORDER BY `mail_id` DESC {$pageSql};";
		$return = $this->query($sql);
		return $return;
	}
	/*
	 * 取得會員信件
	 */
	public function getCommonMemberMailDataMemberId($data){
		if(empty($data['member_id']) && $data['member_id'] !== 0){
            $err = L(strtoupper('ERROR_' . __CLASS__ . '_' . __FUNCTION__ . '_01'));
            return false;
        }
		$sql = "SELECT {$this->tableName}.*, common_member.member_account  FROM `{$this->tableName}` INNER JOIN `common_member` ON {$this->tableName}.member_id = common_member.member_id
			WHERE `mail_status` = '2' AND {$this->tableName}.`member_id` = '{$data['member_id']}' ORDER BY `mail_id` DESC;";
		$return = $this->query($sql);
		if($return === false){
            $err = L(strtoupper("ERROR_" . __CLASS__ . "_" . __FUNCTION__ . "_01"));
            return false;
        }
		return $return;
	}
}
