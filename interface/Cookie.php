<?php
namespace Swiftx\Http\Interfaces;

interface Cookie {

    /**
     * 魔术方法
     * @return string
     */
    public function __toString():string ;

    /**
     * 设置Cookie值
     * @param string $value
     */
    public function setValue(string $value);

    /**
     * 获取Cookie值
     * @return string
     */
    public function getValue():string ;

    /**
     * 设置过期时间
     * @param int $timestamp
     * @param bool $relative
     */
    public function setExpire(int $timestamp, bool $relative = false);

    /**
     * 获取过期时间
     * @return int
     */
    public function getExpire():?int ;

    /**
     * 设置有效路径
     * @param string $value
     */
    public function setPath(string $value);

    /**
     * 获取有效路径
     * @return string
     */
    public function getPath():?string ;

    /**
     * 设置有效域名
     * @param string $value
     */
    public function setDomain(string $value);

    /**
     *
     * @return string
     */
    public function getDomain():?string ;

    /**
     * 设置是否仅通过安全的 HTTPS 连接传给客户端
     * @param bool $value
     */
    public function setSecure(bool $value);

    /**
     * 查看是否仅通过安全的 HTTPS 连接传给客户端
     * @return bool
     */
    public function getSecure():bool ;

    /**
     * 设置仅可通过 HTTP 协议访问
     * @param bool $value
     */
    public function setHttpOnly(bool $value);

    /**
     * 查看仅可通过 HTTP 协议访问
     * @return bool
     */
    public function getHttpOnly():bool ;

}