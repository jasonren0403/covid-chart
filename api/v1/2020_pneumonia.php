<?php

/**
 * @param $sql
 * @return mixed
 */
function execute_sql($sql)
{
    include '../db.conf.php';
    $conn = new mysqli(IP, USER, PASS, DB);
    if (!$conn) {
        $conn->close();
        return array("Error"=>"db");
    } else {
        $conn->set_charset("utf8");
        $cursor = $conn->query($sql);
        $res1 = array();
        if ($cursor) {
            while ($row = $cursor->fetch_assoc()) {
                array_push($res1, $row);
            }
            $cursor->free();
        }
        $conn->close();
        return $res1;
    }
}

header('Access-Control-Allow-Origin: *');
$action = $_POST['action'] ?? '';
$res = array("res" => "", "contents" => array());

if (empty($action)) {
    $res['res'] = "error";
    goto formatjson;
} elseif (strcmp($action, 'getlatest') == 0) {
    $sql = "select * from web.`2020_pneumonia` order by last_since desc limit 1";
    $res["contents"] = execute_sql($sql);
} elseif (strcmp($action, 'getfull') == 0) {
    $sql = "select * from web.`2020_pneumonia`";
    //todo:这样返回数据(很容易)会被折叠，应分段调用getsingleday
    $start = date('Y-m-d', strtotime('2020-02-09 00:00:00'));
    $res["contents"] = execute_sql($sql);
} elseif (strcmp($action, 'getsingleday') == 0) {
    $date = $_POST['param'] ?? '';
    /*param second*/
    $datestr = date('Y-m-d', intval($date));
    if (empty($date)) {
        $res["res"] = "error: no date param";
        goto formatjson;
    }
    $sql = "select * from `2020_pneumonia` where last_since between '$datestr 00:00:00' and '$datestr 23:59:59'";
    $res["query"] = $datestr;
    $res["contents"] = execute_sql($sql);
} else {
    $res["res"] = "error";
    goto formatjson;
}

if (!empty($res['contents'])) $res["res"] = 'success';
else {
    if(in_array("Error",$res['contents'])){
        $res['res'] = "database error!";
        $res["contents"]=array();
    }
    if (isset($_POST['debug']) && $_POST['debug'] === 'true') $res['error_message'] = mysqli_connect_error();
}
//echo($_SERVER['REQUEST_TIME']);

formatjson:
header("Content-type:application/json;charset=UTF-8");
echo json_encode($res, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
