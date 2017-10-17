<?php
namespace Swiftx\Http\Interfaces;

interface Session {

    /**
     * 获取ID
     * @return string
     */
    public function getID():string;

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