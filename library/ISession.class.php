<?php
namespace Swiftx\Http;
/**
 * System方式处理Session的驱动程序
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 */
interface ISession extends \ArrayAccess{

    /**
     * ----------------------------------------------------------
     * 删除字段
     * ----------------------------------------------------------
     * @param null|string $key
     * ----------------------------------------------------------
     */
    public function Destroy($key=null);


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
    public function Value($key, $default = null);

    /**
     * ----------------------------------------------------------
     * 弹出元素，返回该元素的值，并从集合中删除
     * ----------------------------------------------------------
     * @param string $key             字段名
     * @param null|string $default    默认值
     * ----------------------------------------------------------
     * @return null|string
     */
    public function Pop($key, $default = null);

    /**
     * ----------------------------------------------------------
     * 设置Post的值
     * ----------------------------------------------------------
     * @param string $key   字段名
     * @param string $value 字段值
     * ----------------------------------------------------------
     */
    public function Set($key, $value);
	
}