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
