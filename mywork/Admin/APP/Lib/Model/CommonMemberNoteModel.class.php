<?php
class CommonMemberNoteModel extends AdminModel{
	protected $tableName = "common_member_note";
	/*
	 * 取得後台頁面
	 * 頁面管理使用
	 */
	public function getCommonMemberNoteData(){
		$sql = "SELECT * FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`)";
		$return = $this->query($sql);

		return $return;
	}

	/*
	 * 新增後台頁面類別
	 */
	public function addCommonMemberNoteData($data){
		if(!isset($data['member_id'])){
            return false;
        }

		$sql = "INSERT INTO `{$this->tableName}`";
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
	public function setCommonMemberNoteData($data){
		if(empty($data['member_id']) && $data['member_id'] !== '0'){
			return false;
		}

		$sql = "";
		foreach ($data as $key => $value) {
			if($key == 'member_id'){continue;}
			if(empty($sql)){
				$sql = "UPDATE `{$this->tableName}` SET `{$key}` = '{$value}'";
			} else {
				$sql .= ",`{$key}` = '{$value}'";
			}
		}

		$sql .= " WHERE `member_id` = '{$data['member_id']}';";
		$return = $this->execute($sql);
		return $return;
	}
    /*
     * 取得總筆數
     */
    public function getTotalNumberCommonMemberNoteData($data){
        if(empty($data['className'])){
        	return false;
        }
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " AND b.`member_account` LIKE '%{$data['member_account']}%'";
        }

        $sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`) WHERE `{$data['className']}` = 1 {$whereSql};" ;
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 搜索分頁數
     */
    public function getCommonMemberNoteNumberData($data){
    	if(empty($data['className'])){
        	return false;
        }
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = "AND b.`member_account` LIKE '%{$data['member_account']}%'";
        }

        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT " . $pageStart . "," . $pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`) WHERE `{$data['className']}` = 1 {$whereSql} {$pageSql}";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 分辨新增帳號是否有重複
     */
    public function checkCommonMemberNoteId($data){
    	$sql = "SELECT a.`member_id` FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`) WHERE b.`member_account` = '{$data['member_account']}' LIMIT 1;";
    	$return = $this->query($sql);
    	if($return === false){
    		return false;
    	}
    	return $return;
    }
    /*
     * 搜尋 會員 帳號
     */
    public function searchMemberByMemberAccount($data){
        $sql = "SELECT `member_account`
                FROM `common_member`
                WHERE `member_account` ='{$data['member_account']}';";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 搜尋 會員 ID
     */
    public function searchMemberByMemberId($data){
        $sql = "SELECT `member_id`
                FROM `common_member`
                WHERE `member_account` ='{$data['member_account']}';";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return[0]['member_id'];
    }
    /*
     * 搜尋 新增會員 帳號
     */
    public function searchAddMemberByMemberAccount($data){
        $sql = "SELECT `member_account`
                FROM `common_member`
                WHERE `member_account` LIKE '{$data['member_account']}%' LIMIT {$data['limit']};";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /*
     * 搜尋 common_member_note會員 帳號
     */
    public function searchNoteMemberByMemberAccount($data){
        if(empty($data['className'])){
            return false;
        }
        $sql = "SELECT * FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`) WHERE b.`member_account` LIKE '{$data['member_account']}%' AND `{$data['className']}` = '1'";
        $return = $this->query($sql);
        if($return === false){
            return false;
        }
        return $return;
    }
    /**
     * FOR 會員風控使用 MemberRiskcontrol
     */
    public function getNoteMemberForRiskcontrol($data){
        $sql = "SELECT a.*, b.`member_account` FROM `{$this->tableName}` a
                INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`)
                WHERE a.`member_id` = '{$data['member_id']}';";
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 取得總筆數
     */
    public function getTotalNumberCommonMemberNoteDataForNote($data){
        if(empty($data['className'])){
            return false;
        }
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " AND b.`member_account` LIKE '%{$data['member_account']}%'
                        OR a.`note_rechargeLastCode` LIKE '%{$data['member_account']}%'
                        OR a.`note_rechargeArea` LIKE '%{$data['member_account']}%'";
        }

        $sql = "SELECT COUNT(*) AS totalNumber FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`) WHERE `{$data['className']}` = 1 {$whereSql};" ;
        $return = $this->query($sql);
        return $return;
    }
    /*
     * 搜索分頁數
     */
    public function getCommonMemberNoteNumberDataForNote($data){
        if(empty($data['className'])){
            return false;
        }
        $whereSql = "";
        if(!empty($data['member_account'])){
            $whereSql = " AND b.`member_account` LIKE '%{$data['member_account']}%'
                        OR a.`note_rechargeLastCode` LIKE '%{$data['member_account']}%'
                        OR a.`note_rechargeArea` LIKE '%{$data['member_account']}%'";
        }

        $pageStart = ($data['page']['pageNumber'] - 1) * $data['page']['number'];
        $pageEnd = $data['page']['number'];
        $pageSql = " LIMIT " . $pageStart . "," . $pageEnd;

        $sql = "SELECT * FROM `{$this->tableName}` a INNER JOIN `common_member` b ON (a.`member_id` = b.`member_id`) WHERE `{$data['className']}` = 1 {$whereSql} {$pageSql}";
        $return = $this->query($sql);
        return $return;
    }
}