<?php
namespace Swiftx\Http\Interfaces;

/**
 * Http请求响应类
 * @package Swiftx\Http\Interfaces
 */
interface Response {

    /**
     * 状态码
     */
    const STATUS = [
        100 => "Continue",
        101 => "Switching Protocols",
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        307 => "Temporary Redirect",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Time-out",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Large",
        415 => "Unsupported Media Type",
        416 => "Requested range not satisfiable",
        417 => "Expectation Failed",
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Time-out"
    ];

    /**
     * 设置状态参数
     * @param int $code
     */
    public function setStatus(int $code);

    /**
     * 获取状态码
     * @return int
     */
    public function getStatus():?int;

    /**
     * 设置内容类型
     * @param string $mime
     * @param string|null $charset
     */
    public function setContentType(string $mime, string $charset = null);

    /**
     * 读取内容类型
     * @return string
     */
    public function getContentType():?string ;
    /**
     * 获取内容MIME类型
     * @return string
     */
    public function getContentTypeMime():?string;

    /**
     * 获取内容编码类型
     * @return null|string
     */
    public function getContentTypeCharset():?string ;

    /**
     * 设置用来重定向接收方到非请求URL的位置来完成请求或标识新的资源
     * @param string $url
     */
    public function setLocation(string $url);

    /**
     * 读取用来重定向接收方到非请求URL的位置来完成请求或标识新的资源
     * @return string
     */
    public function getLocation():?string;

    /**
     * 设置重定向
     * @param string $url
     * @param bool $forever
     */
    public function redirect(string $url, bool $forever = false);

    /**
     * 设置cookie项目
     * @param string $name
     * @param Cookie $cookie
     */
    public function setCookie(string $name, Cookie $cookie);

    /**
     * 获取Cookie项目
     * @param string $name
     * @return Cookie
     */
    public function getCookie(string $name):?Cookie;

    /**
     * 移除Cookie项
     * @param string $name
     */
    public function removeCookie(string $name);

    /**
     * 设置响应内容
     * @param string $content
     */
    public function setContent(string $content);

    /**
     * 写入新内容
     * @param string $content
     */
    public function write(string $content);

    /**
     * 将数据响应进行输出
     */
    public function output();

}