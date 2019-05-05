<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Request;
use \think\Db;

/**
 * 获取参数(包括文件信息)
 */
function getParam()
{
    return Request::instance()->param();
}
/**
 * 通用返回设置
 * @param $code 返回数值
 * @param $message 返回消息
 * @param $data    返回数据
 * @param string $type 返回类型
 */
function setReturn($code, $message = '数据不存在', $data = array(), $type = 1)
{
    if ($type == 2) {
        $return['a'] = $code;
        $return['b'] = $message;
    } else {
        $return['code'] = $code;
        $return['message'] = $message;
    }
    if (!empty($data)) $return['data'] = $data;
    return $return;
}
function format_result($status,$msg='',$data=array()) {
	if($status==1) {
		$jsonData['status'] = true;
	}
	
	$jsonData['msg'] = $msg; 
	  echo json_encode($jsonData, JSON_UNESCAPED_UNICODE);
	
}