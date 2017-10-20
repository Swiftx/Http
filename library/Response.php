<?php
namespace Swiftx\Http\Component;
use Swiftx\Http\Interfaces\Cookie;

/**
 * 用户Http响应类
 * @package Swiftx\Http\Component
 */
class Response implements \Swiftx\Http\Interfaces\Response {

    /**
     * 状态码
     * @var int
     */
    protected $status = null;

    /**
     * 响应内容类型
     * @var string
     */
    protected $contentTypeMime = null;

    /**
     * 响应内容编码
     * @var string
     */
    protected $contentTypeCharset = null;

    /**
     * 设置跳转地址
     * @var string
     */
    protected $location = null;

    /**
     * Cookie选项
     * @var Cookie[]
     */
    protected $cookies = [];

    /**
     * 响应的数据
     * @var string
     */
    protected $content = '';

    /**
     * 设置状态参数
     * @param int $code
     */
    public function setStatus(int $code){
        $this->status = $code;
    }

    /**
     * 获取状态码
     * @return int
     */
    public function getStatus():?int {
        return $this->status;
    }

    /**
     * 设置内容类型
     * @param string $mime
     * @param string|null $charset
     */
    public function setContentType(string $mime, string $charset = null){
        $this->contentTypeMime = $mime;
        $this->contentTypeCharset = $charset;
    }

    /**
     * 读取内容类型
     * @return string
     */
    public function getContentType():?string {
        if($this->contentTypeMime) return null;
        $result = $this->contentTypeCharset;
        if($this->contentTypeCharset != null)
            $result .= '; charset='.$this->contentTypeCharset;
        return $result;
    }

    /**
     * 获取内容MIME类型
     * @return string
     */
    public function getContentTypeMime():?string {
        return $this->contentTypeMime;
    }

    /**
     * 获取内容编码类型
     * @return null|string
     */
    public function getContentTypeCharset():?string {
        return $this->contentTypeCharset;
    }

    /**
     * 设置用来重定向接收方到非请求URL的位置来完成请求或标识新的资源
     * @param string $url
     */
    public function setLocation(string $url){
        $this->location = $url;
    }

    /**
     * 读取用来重定向接收方到非请求URL的位置来完成请求或标识新的资源
     * @return string
     */
    public function getLocation():?string {
        return $this->location;
    }

    /**
     * 设置重定向
     * @param string $url
     * @param bool $forever
     */
    public function redirect(string $url, bool $forever = false){
        $this->setLocation($url);
        $this->setStatus($forever?301:302);
    }

    /**
     * 设置cookie项目
     * @param string $name
     * @param Cookie $cookie
     */
    public function setCookie(string $name, Cookie $cookie){
        $this->cookies[$name] = $cookie;
    }

    /**
     * 获取Cookie项目
     * @param string $name
     * @return Cookie
     */
    public function getCookie(string $name):?Cookie{
        if(array_key_exists($name, $this->cookies))
            return $this->cookies[$name];
        return null;
    }

    /**
     * 移除Cookie项
     * @param string $name
     */
    public function removeCookie(string $name){
        unset($this->cookies[$name]);
    }

    /**
     * 设置响应内容
     * @param string $content
     */
    public function setContent(string $content){
        $this->content = $content;
    }

    /**
     * 写入新内容
     * @param string $content
     */
    public function write(string $content){
        $this->content .= $content;
    }

    /**
     * 将数据响应进行输出
     */
    public function output(){
        // 设置访问状态码
        if($this->getStatus() != null)
            header('HTTP/1.1 '.$this->status.' '.self::STATUS[$this->status]);
        // 设置访问类型
        if($this->contentTypeMime != null)
            header('Content-type:'.$this->getContentType());
        // 设置重定向
        if($this->location != null)
            header('Location: '.$this->location);
        // 设置Cookies值
        foreach ($this->cookies as $name => $cookie){
            setcookie(
                $name,
                $cookie->getValue(),
                $cookie->getExpire(),
                $cookie->getPath(),
                $cookie->getDomain(),
                $cookie->getSecure(),
                $cookie->getHttpOnly()
            );
        }
        // 输出响应内容
        echo $this->content;
    }

}
