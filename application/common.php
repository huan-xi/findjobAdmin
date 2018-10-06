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
function json_return($data)
{
    exit(json_encode($data, 320));
}
function json_return_msg($status,$msg)
{
    json_return(['statu'=>$status,'msg'=>$msg]);
}
//密码加密
function encrypt($str)
{
    return md5(md5("AUTH_CODE") . $str);
}
//审核输出过滤器
function valid_out($valid)
{
    if ($valid == "1") echo "待审核"; else if ($valid == "2") echo "已通过"; else "未通过";
}
//状态输出过滤器
function status_out($status)
{
    switch ($status){
        case \app\index\extend\Constant::getODERSTATUSWAITE():
            echo "待完成";
            break;
        case \app\index\extend\Constant::getODERSTATUSCANCEL():
            echo "已取消";
            break;
        case \app\index\extend\Constant::getODERSTATUSDELETE():
            echo "已删除";
            break;
        case \app\index\extend\Constant::getODERSTATUSFINISH():
            echo "已完成";
            break;
        default:
            echo "异常";
    }
}
//判断app代理
function isApp()
{
    $agent = \think\Request::instance()->header('user-agent');
    return $agent == 'TGTapp' ? true : false;
}

function getUUID()
{
    return md5(time() . mt_rand(1, 999999999));
}

//图片上传
function upload($file='image',$path='image')
{
    $file=request()->file($file);
    if($file){
        $info=$file->move(ROOT_PATH . 'public' . DS . "uploads/$path");
        $filename=$info->getSaveName();
        return "/public/uploads/$path/" . strtr($filename, '\\', '/');
    }
    return false;
}
