<?php
namespace Swiftx\Http\Interfaces;

/**
 * 资源请求接口
 * @package Swiftx\Router
 */
interface Uri {

    /**
     * 设置请求地址
     * @param string $uri
     */
    public function setString(string $uri);

    /**
     * 读取请求地址
     * @return string
     */
    public function getString():string ;

    /**
     * 设置协议
     * @param string $scheme
     */
    public function setScheme(string $scheme);

    /**
     * 读取协议
     * @return string
     */
    public function getScheme():string ;

    /**
     * 设置用户信息
     * @param string $user
     * @param string|null $password
     */
    public function setUserInfo(string $user , string $password = null);

    /**
     * 读取用户信息
     * @return string
     */
    public function getUserInfo():string ;

    /**
     * 设置主机名
     * @param string $host
     */
    public function setHost(string $host);

    /**
     * 读取主机名
     * @return string
     */
    public function getHost():string ;

    /**
     * 设置端口号
     * @param int|null $port
     */
    public function setPort(?int $port);

    /**
     * 设置地址路径
     * @param string $path
     */
    public function setPath(string $path);

    /**
     * 读取地址路径
     * @return string
     */
    public function getPath():string ;

    /**
     * 设置请求串
     * @param string $query
     */
    public function setQuery(string $query);

    /**
     * 读取请求串
     * @return string
     */
    public function getQuery():string ;

    /**
     * 批量读取参数
     * @return array
     */
    public function getParams():array ;

    /**
     * 判断是否存在该参数
     * @param string $key
     * @return bool
     */
    public function hasParam(string $key):bool ;

    /**
     * 读取请求参数
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getParam(string $key, string $default=null):?string ;

    /**
     * 批量设置参数
     * @param array $data
     */
    public function setParams(array $data);

    /**
     * 设置请求参数
     * @param string $key
     * @param mixed $value
     */
    public function setParam(string $key, $value);

    /**
     * 设置锚元素
     * @param string $fragment
     */
    public function setFragment(string $fragment);

    /**
     * 读取锚元素
     * @return string
     */
    public function getFragment():string;

}