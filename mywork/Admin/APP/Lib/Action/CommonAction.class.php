<?php

class CommonAction extends Action {
    /**
     * 初始化
     */
    protected function _initialize() {
        //宣告台灣時區
        date_default_timezone_set('Asia/Taipei');
        
        // 跳過過濾字串參數
        $ignore = array();
        
        // $_REQUEST過濾
        foreach ($_REQUEST as $key => $val) {
            if (!in_array($key, $ignore)) {
                $_REQUEST[$key] = filterStr($val);
            }
        }
        $sietData = C('SIETDATA');
        switch ($sietData){
            case 'demo':
                if(isset($_SESSION['demoTest'])){
                    $demoTest = $_SESSION['demoTest'];
                } else {
                    $demoTest = $_REQUEST['demoTest'];
                }
                if($demoTest !== 'aaa123'){
                    exit();
                }
                $_SESSION['demoTest'] = $demoTest;
                break;
            default:
                break;
        }
        $this->getLangArray();//取得語系檔陣列到前端
    }
    /**
     * 取得Request資料
     *
     * @return array
     */
    protected function getRequest() {
        
        foreach ($_REQUEST as $key => $val) {
            if (is_array($val)) {
                $data[$key] = ($val);
            } else {
                $data[$key] = trim($val);
            }
        }
        
        return $data;
    }
    /*
     * 語系檔陣列
     */
    protected function getLangArray(){
        if(!isset($_COOKIE['think_language'])){
            $_COOKIE['think_language'] = 'zh-tw';
        } else {
            $_COOKIE['think_language'] = strtolower($_COOKIE['think_language']);
        }
        
        $langArray = array(
            'zh-tw' => array(
                'iconName' => 'icon-hk',
                'cnName' => '繁體中文',
                'langCode' => 'zh-tw'
            ),
            'zh-cn' => array(
                'iconName' => 'icon-china',
                'cnName' => '简体中文',
                'langCode' => 'zh-cn'
            ),
            'en-us' => array(
                'iconName' => 'icon-usa',
                'cnName' => 'English',
                'langCode' => 'en-us'
            ),
        );
        if(empty($langArray[$_COOKIE['think_language']])){
            $_COOKIE['think_language'] = 'zh-tw';
        }
        $showLangArray = array();
        foreach($langArray as $key => $value){
            if($key != $_COOKIE['think_language']){
                array_push($showLangArray,$langArray[$key]);
            }
            if($key == $_COOKIE['think_language']){
                $this->assign('currentIconName',$value['iconName']);
                $this->assign('currentCnName',$value['cnName']);
            }
        }
        $this->assign('langStr',$_COOKIE['think_language']);//當前正在使用的版本標記
        $this->assign('showLangArray',$showLangArray);
    }
}