<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/5
 * Time: 12:20
 */

namespace app\index\controller;


use app\index\extend\Constant;
use app\index\model\SystemModel;

class System extends BaseController
{
    public function index()
    {
        //客服信息会写
        $kf_phone = SystemModel::where(['s_key ' => 'KF_PHONE'])->select();
        if (!$kf_phone) {
            $kf_phone_s = new SystemModel();
            $kf_phone_s->s_key = 'KF_PHONE';
            $kf_phone_s->s_value = '未设置';
            $kf_phone_s->save();
            $kf_phone = $kf_phone_s;
        } else
            $kf_phone = $kf_phone[0];
        $kf_name = SystemModel::where(['s_key ' => 'KF_NAME'])->select();
        if (!$kf_name) {
            $kf_name_s = new SystemModel();
            $kf_name_s->s_key = 'KF_NAME';
            $kf_name_s->s_value = '未设置';
            $kf_name_s->save();
            $kf_name = $kf_name_s;
        } else
            $kf_name = $kf_name[0];
        $this->assign('phone', $kf_phone);
        $this->assign('name', $kf_name);
        return $this->fetch();
    }

    public function edit_kf()
    {
        $name = input('name');
        $name_id = input('name_id');
        $phone = input('phone');
        $phone_id = input('phone_id');
        $system_name = SystemModel::get($name_id);
        $system_p = SystemModel::get($phone_id);
        $system_name->save(['s_value' => $name]);
        $system_p->save(['s_value' => $phone]);
        json_return(['status' => 1, 'msg' => '修改成功']);
    }

    public function system_log()
    {
        return $this->fetch();
    }


    public function type()
    {
        $type = SystemModel::where(['s_key ' => 'WT'])->select();
        $this->assign('type', $type);
        return $this->fetch();
    }

    public function edit_type()
    {
        $name = input('name');
        $id = input('id');
        $system = SystemModel::get($id);
        if ($system->save(['s_value' => $name]))
            json_return(['status' => 1, 'msg' => '修改成功']);
        json_return(['status' => 0, 'msg' => '修改失败']);
    }

    public function del_type()
    {
        $id = input('id');
        if (SystemModel::destroy($id))
            json_return(['status' => 1, 'msg' => '删除成功']);
        json_return(['status' => 0, 'msg' => '数据为发生变化']);
    }

    public function add_type()
    {
        $name = input('name');
        $type = new SystemModel();
        $type->s_key = 'WT';
        $type->s_value = $name;
        if (SystemModel::where(['s_key' => 'WT', 's_value' => $name])->count() > 0)
            json_return(['status' => 0, 'msg' => '该工种已存在']);
        if ($type->save())
            json_return(['status' => 1, 'msg' => '添加成功']);
        json_return(['status' => 0, 'msg' => '添加失败']);
    }
}
