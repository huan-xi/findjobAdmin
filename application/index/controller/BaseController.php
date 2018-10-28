<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/4
 * Time: 19:10
 */
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;

class BaseController extends Controller{
    public function __construct(Request $request = null)
    {
        if (Session::get('username')=='')
            $this->error("您还未登录,或登入信息已过期", url('Index/Login/index'));
        parent::__construct($request);
    }
}
