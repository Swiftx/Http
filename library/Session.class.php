<?php
namespace Swiftx\Http;
use Swiftx\System\Object;
/**
 * System方式处理Session的驱动程序
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 */
class Session extends Object implements ISession {
    
    /**
     * ----------------------------------------------------------
     * ArrayAccess接口，数组方式赋值方法
     * ----------------------------------------------------------
     * @param string $offset		数组方式键
     * @param string $value		数组方式值
     * ----------------------------------------------------------
     */
    public function offsetSet($offset, $value) {
        $_SESSION[$offset] = $value;
    }

    /**
     * ----------------------------------------------------------
     * ArrayAccess接口，数组方式取值方法
     * ----------------------------------------------------------
     * @param string $offset        数组方式键
     * ----------------------------------------------------------
     * @return mixed
     */
    public function offsetGet($offset) {
        return $_SESSION[$offset];
    }

    /**
     * ----------------------------------------------------------
     * ArrayAccess接口，数组方式isset方法
     * ----------------------------------------------------------
     * @param string $offset        数组方式键
     * ----------------------------------------------------------
     * @return bool
     */
    public function offsetExists($offset) {
        return $this->Exists($offset);
    }

    /**
     * ----------------------------------------------------------
     * ArrayAccess接口，数组方式unset方法
     * ----------------------------------------------------------
     * @param string $offset	数组方式键
     * ----------------------------------------------------------
     */
    public function offsetUnset($offset) {
        $this->Destroy($offset);
    }

    /**
     * ----------------------------------------------------------
     * 判断Cookie值是否存在
     * ----------------------------------------------------------
     * @param string $key   字段名
     * ----------------------------------------------------------
     * @return bool
     */
    public function Exists($key){
        return array_key_exists($key, $_SESSION);
    }

    /**
     * ----------------------------------------------------------
     * 删除字段
     * ----------------------------------------------------------
     * @param null|string $key
     * ----------------------------------------------------------
     */
    public function Destroy($key=null){
        if($key == null)
            $_SESSION = array();
        unset($_SESSION[$key]);
    }


    /**
     * ----------------------------------------------------------
     * 获取Post值，带默认方式
     * ----------------------------------------------------------
     * @param string $key
     * @param null $default
     * ----------------------------------------------------------
     * @return null|string
     * ----------------------------------------------------------
     */
    public function Value($key, $default = null){
        return array_key_exists($key, $_SESSION)?$_SESSION[$key]:$default;
    }

    /**
     * ----------------------------------------------------------
     * 弹出元素，返回该元素的值，并从集合中删除
     * ----------------------------------------------------------
     * @param string $key             字段名
     * @param null|string $default    默认值
     * ----------------------------------------------------------
     * @return null|string
     */
    public function Pop($key, $default = null){
        if(empty($_SESSION[$key]))
            return $default;
        $result = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $result;
    }

    /**
     * ----------------------------------------------------------
     * 设置Post的值
     * ----------------------------------------------------------
     * @param string $key   字段名
     * @param string $value 字段值
     * ----------------------------------------------------------
     */
    public function Set($key, $value){
        $_SESSION[$key] = $value;
    }
	
}