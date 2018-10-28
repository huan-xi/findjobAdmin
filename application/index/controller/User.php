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
use app\index\model\VenderModel;
use think\console\command\make\Model;

class  User extends BaseController
{
  public function userList()
    {
        $count = 0;
        $this->assign('count', $count);
        $this->assign('start_time', time() - 62208000);
        $this->assign('end_time', time());
        return $this->fetch();
    }
    public function details(){
      $user_id=input('user_id');
      $user=UserModel::get($user_id);
      $this->assign('user',$user);
      return $this->fetch();
    }
    public function change(){
      $data=input('post.');
      $user=VenderModel::get($data['user_id']);
      $user->save(['phone'=>$data['phone'],'name'=>$data['name'],'type'=>$data['type']]);
      echo "修改成功";
    }
    //启用用户
    public function able_user()
    {
        $user_id = input('user_id');
        $user = UserModel::get($user_id);
        if ($user->save(['status' => Constant::getROUESTATUSNORMAL()]))
            json_return(['status' => 1, 'msg' => '用户已启用']);
        json_return(['status' => 0, 'msg' => '用户启用失败']);
    }
    //通过审核
    public function pass(){
        $user_id = input('user_id');
        $user = UserModel::get($user_id);
        if ($user->save(['valid' => 2]))
            json_return(['status' => 1, 'msg' => '用户已通过']);
        json_return(['status' => 0, 'msg' => '操作失败,确定该用户未通过审核吗']);
    }
    //不通过审核
    public function not_pass(){
        $user_id = input('user_id');
        $user = UserModel::get($user_id);
        if ($user->save(['valid' => 3]))
            json_return(['status' => 1, 'msg' => '用户已通过']);
        json_return(['status' => 0, 'msg' => '数据没发生变化']);
    }
    //编辑用户
    public function edit_user()
    {
        $user_id = input('user_id');
        $phone = input('phone');
        $name = input('name');
        $user_id = UserModel::get($user_id);
        if ($user_id->save(['phone' => $phone, 'name' => $name]))
            json_return(['status' => 1, 'msg' => '修改用户成功']);
        json_return(['status' => 0, 'msg' => '修改用户失败']);
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
        $sort = $post['sort'];
        $valid = $post['valid'];
        if ($valid == '100')
            $valid = 'valid = 1 or valid = 2 or valid = 3';
        else
            $valid = 'valid= ' . $valid;
        $status = $post['status'] == '100' ? 'status = ' . Constant::getROUESTATUSNORMAL() . ' or status = ' . Constant::getROUESTATUSFORBID() : 'status = ' . $post['status'];
        try {
            //   $users=UserModel::all();
            $users = (new UserModel())
                ->where('create_time', 'between', "$start_time,$end_time")
                ->where("$key_type", 'like', "%$key%")
                ->where($status)
                ->where($valid)
                ->order('create_time', $sort)
                ->page($p, $pageCount)
                ->select();
            $count = (new UserModel())
                ->where('create_time', 'between', "$start_time,$end_time")
                ->where("$key_type", 'like', "%$key%")
                ->where($valid)
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
