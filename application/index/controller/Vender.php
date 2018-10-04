<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/4
 * Time: 19:09
 */
namespace app\index\controller;

use app\index\extend\AjaxPage;
use app\index\model\UserModel;

class  User extends BaseController {
    function userList(){
        $count=0;
        $this->assign('count', $count);
        $this->assign('start_time', time() - 62208000);
        $this->assign('end_time', time());
        return $this->fetch();
    }
    public function ajaxindex()
    {
        $post = input('post.');
        // 搜索条件
        $p=input('p/d');
        $start_time = strtotime($post['start_time'])*1000;
        $end_time = strtotime($post['end_time'])*1000;
        $key_type = $post['key_type'];
        $key = $post['keywords'];
        $pageCount = '10';
        $status= $post['status']=='100'?'status =1 or status = 0':'status='.$post['status'];
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
        return $this->fetch();
    }
}
