<?php
//公用函數

/*
 *  過濾字串
 */
function filterStr($data) {

    if (is_array($data)) {
        // 參數為陣列, 使用遞迴過濾內容
        foreach ($data as $key => $val) {
            $data[$key] = filterStr($val);
        }
    } else if (is_string($data)) {
        if (!is_json($data)) {
            // 非json字串, 進行特殊字元過濾
            // $data = mysql_escape_string(strip_tags(trim($data)));
            $data = htmlspecialchars($data);

            $data = dowith_sql($data);
            // $data = str_replace(" ", "&nbsp;", $data);
        } else {
            // json字串, decode後進行過濾
            $data_s = json_decode($data, true);
            if (is_array($data_s)) {
                // 參數為陣列, 使用遞迴過濾內容
                foreach ($data_s as $key => $val) {
                    $data_s[$key] = filterStr($val);
                }
            } else {
                // $data_s = mysql_escape_string(strip_tags(trim($data_s)));
                $data_s = trim(htmlspecialchars(trim($data_s)));

                $data_s = dowith_sql($data_s);
                // $data_s = str_replace(" ", "&nbsp;", $data_s);
            }
            $data = json_encode($data_s);
        }
    }

    return $data;
}
function dowith_php($str) {
    $str = str_ireplace("<?php","",$str);
    $str = str_ireplace("define(","",$str);
    $str = str_ireplace("require(","",$str);
    $str = str_ireplace("require ","",$str);
    $str = str_ireplace("include (","",$str);
    $str = str_ireplace("include ","",$str);
    $str = str_ireplace("curl_init ","",$str);
    $str = str_ireplace("curl_exec ","",$str);
    return $str;
}
function dowith_sql($str) {
    $str = str_ireplace(" and ","",$str);
    $str = str_ireplace(" execute ","",$str);
    $str = str_ireplace(" update ","",$str);
    $str = str_replace(" count ","",$str);
    $str = str_replace(" chr ","",$str);
    $str = str_replace(" mid ","",$str);
    $str = str_replace(" master ","",$str);
    $str = str_replace(" truncate ","",$str);
    $str = str_replace(" char ","",$str);
    $str = str_replace(" declare ","",$str);
    $str = str_ireplace("select ","",$str);
    $str = str_ireplace("create ","",$str);
    $str = str_ireplace("delete ","",$str);
    $str = str_ireplace("insert ","",$str);
    $str = str_ireplace(" or ","",$str);
    $str = str_ireplace("--","",$str);
    $str = str_ireplace("'","",$str);
    $str = str_ireplace("=","",$str);
    $str = str_replace(array("\r", "\n", "\r\n", "\n\r"), '', $str);
    //echo $str;
    return $str;
}
/*
 * 判斷是否為json
 */
function is_json($string) {

    return is_array(json_decode($string, true));
}
/*
 * 取得用戶真實IP
 */
function getIp(){
    if(isset($_SERVER)){
        if(isset($_SERVER[HTTP_X_FORWARDED_FOR])){
            $ip = $_SERVER[HTTP_X_FORWARDED_FOR];
        }elseif(isset($_SERVER[HTTP_CLIENT_IP])) {
            $ip = $_SERVER[HTTP_CLIENT_IP];
        }else{
            $ip = $_SERVER[REMOTE_ADDR];
        }
    }else{
        //不允许就使用getenv获取
        if(getenv("HTTP_X_FORWARDED_FOR")){
            $ip = getenv( "HTTP_X_FORWARDED_FOR");
        }elseif(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        }else{
            $ip = getenv("REMOTE_ADDR");
        }
    }

    return $ip;
}

function get_os(){
    $oAgent = str_replace(';','|',$_SERVER['HTTP_USER_AGENT']);
    //$oAgent = $_SERVER['HTTP_USER_AGENT'];
   return $oAgent;
}

function get_url(){
    return $_SERVER['HTTP_HOST'];
}

/*
 * 驗證手機號碼
 */
function isPhone($str) {
    if (preg_match("/^09[0-9]{2}-[0-9]{3}-[0-9]{3}$/", $str)) {
        return true;    // 09xx-xxx-xxx
    } else if(preg_match("/^09[0-9]{2}-[0-9]{6}$/", $str)) {
        return true;    // 09xx-xxxxxx
    } else if(preg_match("/^09[0-9]{8}$/", $str)) {
        return true;    // 09xxxxxxxx
    } else {
        return false;
    }
}
/*
 * 取得IP 轉換 int格式
 */
function get_ip_inet_pton($ip){
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return sprintf('%u',ip2long($ip));
    } else if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return ip2long6($ip);
    } else {
        return '';
    }
}
/*
 * 取得IP 轉換  原始格式
 */
function get_ip_inet_ntop($ip){
    $ip4 = long2ip($ip);
    if(filter_var($ip4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && $ip4 != '255.255.255.255') {
        $ipArray = explode(".",$ip4);
        $number = 2;//要隱藏的數量
        $ip = "";
        for($i=0;$i<count($ipArray);$i++){
            if(!empty($ip)){
                $ip .= ".";
            }
            if($i < $number){
                $ip .= "*";
            } else {
                $ip .= $ipArray[$i];
            }
        }
        return $ip;
    } else {
        $ip6 = long2ip6($ip);
        $ipArray = explode(":",$ip6);
        $number = 2;//要隱藏的數量
        $ip = "";
        for($i=0;$i<count($ipArray);$i++){
            if(!empty($ip)){
                $ip .= ":";
            }
            if($i < $number){
                $ip .= "*";
            } else {
                $ip .= $ipArray[$i];
            }
        }
        return $ip;
    }
    /*
     if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
     return long2ip($ip);
     } else if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
     return long2ip6($ip);
     } else {
     return '1';
     }
     return inet_ntop($ip);*/
}
/*
 * array 轉成  json
 */
function array_to_json($array){
    foreach($array as $key => $value){
        if(is_string($key) || is_string($value)) {
            $new_array[urlencode($key)] = urlencode($value);
        } else {
            $new_array[$key] = $value;
        }
    }
    return urldecode(json_encode($new_array));
}
function getSecondsChange($time){
    $d = floor($time / (3600*24));
    $h = floor(($time % (3600*24)) / 3600);
    $m = floor((($time % (3600*24)) % 3600) / 60);
    if($d>'0'){
        return $d.'天'.$h.'小時'.$m.'分';
    }else{
        if($h!='0'){
            return $h.'小時'.$m.'分';
        }elseif($m!='0'){
            return $m.'分';
        } else {
            return $time.'秒';
        }
    }
}
function isDate($dateString){
    return strtotime(date('Y-m-d',strtotime($dateString))) === strtotime($dateString);
    /*date函數會給月和日補零，所以最終用unix時間戳來校驗*/
}

/**
 * IPV6 地址转换为整数
 * @param $ipv6
 * @return string
 */
function ip2long6($ipv6)
{
    $ip_n = inet_pton($ipv6);
    $bits = 15; // 16 x 8 bit = 128bit
    $ipv6long = '';
    while ($bits >= 0) {
        $bin = sprintf("%08b", (ord($ip_n[$bits])));
        $ipv6long = $bin . $ipv6long;
        $bits--;
    }
    return $ipv6long;
}
/**
 * 整数转换为 IPV6 地址
 * @param $ipv6long
 * @return string
 */
function long2ip6($ipv6long)
{
    $bin = $ipv6long;
    if (strlen($bin) < 128) {
        $pad = 128 - strlen($bin);
        for ($i = 1; $i <= $pad; $i++) {
            $bin = "0" . $bin;
        }
    }
    $bits = 0;
    $ipv6 = '';
    while ($bits <= 7) {
        $bin_part = substr($bin, ($bits * 16), 16);
        $ipv6 .= dechex(bindec($bin_part)) . ":";
        $bits++;
    }
    // compress
    return substr($ipv6, 0, -1);
}
/**
 * 取得 頁數 陣列 演算法
 * @param int $pageNumber 當前頁數
 * @param int $totalPage 總頁數
 * @param int $pageMoreNumber 一頁最多幾頁
 * @return array 顯示的頁數陣列
 */
function getPageArray($pageNumber,$totalPage,$pageMoreNumber){
    $pageArray = array();
    if($totalPage > $pageMoreNumber){
        $startPage = 2;
        $endPage = 2;
        if($pageNumber-2 < 1){
            $endPage += (1-($pageNumber-2));
            $startPage -= (1-($pageNumber-2));
        }
        if($pageNumber+2 > $totalPage){
            $startPage += ($pageNumber+2-$totalPage);
            $endPage -= ($pageNumber+2-$totalPage);
        }
        for($i=$pageNumber-$startPage;$i<=$pageNumber+$endPage;$i++){
            array_push($pageArray, $i);
        }
    } else {
        for($i=1;$i<=$totalPage;$i++){
            array_push($pageArray, $i);
        }
    }
    return $pageArray;
}
/**
 * [changeNum description]
 * @param  [string]  $text  原始字串
 * @param  [string]  $sys   替換符號
 * @param  integer $start 顯示開頭幾個字元
 * @param  integer $end   最多幾個字元
 * @param  integer $num   切割字串數量
 * @return [srting]         返回字串
 */
function changeNum($text, $sys, $start = 2, $end = 6, $num = 1){
    $text = str_split($text,$num);
    for($i = $start; $i <= $end; $i++){
        $text[$i] = $sys ;
    }
    $str = "";
    foreach($text as $key => $val){
        $str .= $text[$key];
    }
    return $str;
}