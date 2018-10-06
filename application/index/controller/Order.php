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
use app\index\model\OrderModel;

class  Order extends BaseController
{
    function index()
    {
        $count = 0;
        $this->assign('count', $count);
        $this->assign('start_time', time() - 62208000);
        $this->assign('end_time', time());
        return $this->fetch();
    }

    //编辑用户
    public function change_status()
    {
        $user_id = input('order_id');
        $status = input('status');
        $user = OrderModel::get($user_id);
        if ($user->save(['status' => $status, 'end_time' => time()*1000]))
            json_return(['status' => 1, 'msg' => '修改成功']);
        json_return(['status' => 0, 'msg' => '数据没发生变动']);
    }

    public function ajaxindex()
    {
        $post = input('post.');
        // 搜索条件
        $p = input('p/d');
        $start_time = strtotime($post['start_time']) * 1000;
        $end_time = strtotime($post['end_time']) * 1000;
        $pageCount = '10';
        $sort = $post['sort'];
        $status = $post['status'] == '100' ? 'status = 1  or status = 2  or status = 3  or status = 4  or status = 5 ' : 'status = ' . $post['status'];
        try {
            //   $users=OrderModel::all();
            $users = (new OrderModel())
                ->where('create_time', 'between', "$start_time,$end_time")
                ->where($status)
                ->order('create_time', $sort)
                ->select();
            $count = (new OrderModel())
                ->where('create_time', 'between', "$start_time,$end_time")
                ->where($status)
                ->count();
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        }
        $page = new AjaxPage($count, $pageCount);
        $this->assign('page', $page->show());
        $this->assign('users', $users);
        $this->assign('count', $count);
        return $this->fetch();
    }
}
