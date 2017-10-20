<?php
namespace Swiftx\Http\Component;
/**
 * Cookie对象
 * @package Swiftx\Httpd\Component
 */
class Cookie implements \Swiftx\Http\Interfaces\Cookie {

    /**
     * Cookie值
     * @var string
     */
    protected $value = '';

    /**
     * 有效期
     * @var string
     */
    protected $expire = null;

    /**
     * 服务器路径
     * @var string
     */
    protected $path = null;

    /**
     * 有效域名
     * @var string
     */
    protected $domain = null;

    /**
     * 仅通过安全的 HTTPS 连接传给客户端
     * @var bool
     */
    protected $secure = null;

    /**
     * 仅可通过 HTTP 协议访问
     * @var bool
     */
    protected $httpOnly = null;

    /**
     * 魔术方法
     * @return string
     */
    public function __toString():string {
        return $this->getValue();
    }

    /**
     * 设置Cookie值
     * @param string $value
     */
    public function setValue(string $value){
        $this->value = $value;
    }

    /**
     * 获取Cookie值
     * @return string
     */
    public function getValue():string {
        return $this->value;
    }

    /**
     * 设置过期时间
     * @param int $timestamp
     * @param bool $relative
     */
    public function setExpire(int $timestamp, bool $relative = false){
        $this->expire = $timestamp+($relative?time():0);
    }

    /**
     * 获取过期时间
     * @return int
     */
    public function getExpire():?int {
        return $this->expire;
    }

    /**
     * 设置有效路径
     * @param string $value
     */
    public function setPath(string $value){
        $this->path = $value;
    }

    /**
     * 获取有效路径
     * @return string
     */
    public function getPath():?string {
        return $this->path;
    }

    /**
     * 设置有效域名
     * @param string $value
     */
    public function setDomain(string $value){
        $this->domain = $value;
    }

    /**
     *
     * @return string
     */
    public function getDomain():?string {
        return $this->domain;
    }

    /**
     * 设置是否仅通过安全的 HTTPS 连接传给客户端
     * @param bool $value
     */
    public function setSecure(bool $value){
        $this->secure = $value;
    }

    /**
     * 查看是否仅通过安全的 HTTPS 连接传给客户端
     * @return bool
     */
    public function getSecure():bool {
        return (bool)$this->secure;
    }

    /**
     * 设置仅可通过 HTTP 协议访问
     * @param bool $value
     */
    public function setHttpOnly(bool $value){
        $this->httpOnly = $value;
    }

    /**
     * 查看仅可通过 HTTP 协议访问
     * @return bool
     */
    public function getHttpOnly():bool {
        return (bool)$this->httpOnly;
    }

}