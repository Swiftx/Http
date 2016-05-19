<?php
namespace Swiftx\Http;
use Swiftx\System\Object;
/**
 * Swiftx对象方式Post处理程序
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 */
class Post extends Object implements \ArrayAccess{

    public function __tostring(){
        return $GLOBALS['HTTP_RAW_POST_DATA'];
    }

    /**
     * ArrayAccess接口，数组方式赋值方法
     * @param string $offset		数组方式键
     * @param string $value		数组方式值
     */
    public function offsetSet($offset, $value) {
        $_POST[$offset] = $value;
    }

    /**
     * ArrayAccess接口，数组方式取值方法
     * @param string $offset        数组方式键
     * @return mixed
     */
    public function offsetGet($offset) {
        return $_POST[$offset];
    }

    /**
     * ArrayAccess接口，数组方式isset方法
     * @param string $offset        数组方式键
     * @return bool
     */
    public function offsetExists($offset) {
        return $this->Exists($offset);
    }

    /**
     * ArrayAccess接口，数组方式unset方法
     * @param string $offset	数组方式键
     */
    public function offsetUnset($offset) {
        $this->Destroy($offset);
    }

    /**
     * 判断Cookie值是否存在
     * @param string $key   字段名
     * @return bool
     */
    public function Exists($key){
        return array_key_exists($key, $_POST);
    }

    /**
     * 删除字段
     * @param null|string $key
     */
    public function Destroy($key=null){
        if($key == null)
            $_POST = array();
        unset($_POST[$key]);
    }


    /**
     * 获取Post值，带默认方式
     * @param  string $key
     * @param  null $default
     * @return null|string
     */
    public function Value($key, $default = null){
        return array_key_exists($key, $_POST)?$_POST[$key]:$default;
    }

    /**
     * 弹出元素，返回该元素的值，并从集合中删除
     * @param string $key             字段名
     * @param null|string $default    默认值
     * @return null|string
     */
    public function Pop($key, $default = null){
        if(empty($_POST[$key]))
            return $default;
        $result = $_POST[$key];
        unset($_POST[$key]);
        return $result;
    }

    /**
     * 设置Post的值
     * @param string $key   字段名
     * @param string $value 字段值
     */
    public function Set($key, $value){
        $_POST[$key] = $value;
    }

}