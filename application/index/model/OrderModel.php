<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/4
 * Time: 19:45
 */
namespace app\index\model;
use think\Model;
class OrderModel extends Model{

    protected $name='p_order';
    protected $pk='order_id';

    public function user(){
        return $this->hasOne('UserModel')->field('name');
    }
}
