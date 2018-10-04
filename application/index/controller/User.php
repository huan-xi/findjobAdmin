<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/4
 * Time: 19:09
 */

namespace app\index\controller;

use app\index\extend\AjaxPage;
use app\index\extend\Constant;
use app\index\model\UserModel;

class  User extends BaseController
{
    function userList()
    {
        $count = (new UserModel())->count();
        $this->assign('count', $count);
        $this->assign('start_time', time() - 62208000);
        $this->assign('end_time', time());
        return $this->fetch();
    }

    //删除用户
    public function del_user()
    {
        $user_id = input('user_id');
        $user = UserModel::get($user_id);
        if ($user->save(['status' => Constant::getROUESTATUSFORBID()]))
            json_return(['status' => 1, 'msg' => '用户已禁用']);
        json_return(['status' => 0, 'msg' => '用户禁用失败']);
    }

    public function ajaxindex()
    {
        $post = input('post.');
        // 搜索条件
        $p = input('p/d');
        $start_time = strtotime($post['start_time']) * 1000;
        $end_time = strtotime($post['end_time']) * 1000;
        $key_type = $post['key_type'];
        $key = $post['keywords'];
        $pageCount = '10';
        $status = $post['status'] == '100' ? 'status =1 or status = 0' : 'status=' . $post['status'];
        try {
            //   $users=UserModel::all();
            $users = (new UserModel())
                ->where('create_time', 'between', "$start_time,$end_time")
                ->where("$key_type", 'like', "%$key%")
                ->where($status)
                ->page($p, $pageCount)
                ->select();
            $count = (new UserModel())
                ->where('create_time', 'between', "$start_time,$end_time")
                ->where("$key_type", 'like', "%$key%")
                ->where($status)
                ->count();
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        }
        $page = new AjaxPage($count, $pageCount);
        $this->assign('page', $page->show());
        $this->assign('users', $users);
        $this->assign('count',$count);
        return $this->fetch();
    }
}
