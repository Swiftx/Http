<?php
namespace Swiftx\Http\Interfaces;

/**
 * POST数据
 * @package Swiftx\Interfaces\Httpd
 */
interface Post {

    /**
     * 读取原始数据
     * @return string
     */
    public function getRawData():string ;

    /**
     * 设置原始数据
     * @param string $value
     */
    public function setRawData(string $value);

    /**
     * 判断是否存在
     * @param string $key
     * @return bool
     */
    public function exists(string $key):bool;

    /**
     * 设置POST值
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value);

    /**
     * 读取POST值
     * @param string $key
     * @param mixed $default
     */
    public function get(string $key, $default=null);

}