<?php
namespace Swiftx\Http\Interfaces;

/**
 * 请求对象实现类
 */
interface Request {

    /**
     * 设置请求方式
     * @param string $value
     * @return void
     */
    public function setMethod(string $value);

    /**
     * 获取请求方式
     * @return string
     */
    public function getMethod():string;

    /**
     * 设置时间戳
     * @param int $timestamp
     */
    public function setCreateTime(int $timestamp);

    /**
     * 获取时间戳
     * @return int
     */
    public function getCreateTime():int;

    /**
     * 设置Uri对象
     * @param Uri $uri
     */
    public function setUri(Uri $uri);

    /**
     * 获取Uri对象
     * @return Uri
     */
    public function getUri():?Uri;

    /**
     * 设置语言
     * @param string $value
     */
    public function setLanguage(string $value);

    /**
     * 设置语言
     * @param string[] ...$value
     */
    public function setLanguages(string ...$value);

    /**
     * 读取语言
     * @return string[]
     */
    public function getLanguages():array;

    /**
     * 设置Cookie对象
     * @param string $value
     */
    public function setCookie(string $key, string $value);

    /**
     * 获取Cookie对象
     * @return string|null
     */
    public function getCookie(string $key):?string ;

    /**
     * 获取SESSION对象
     * @return Session
     */
    public function getSession():?Session;

    /**
     * 设置SESSION对象
     * @param Session $value
     */
    public function setSession(Session $value);

    /**
     * 获取POST对象
     * @return Post
     */
    public function getPost():?Post;

    /**
     * 设置POST对象
     * @param Post $post
     */
    public function setPost(Post $post);

    /**
     * 设置上传对象
     * @param string $name
     * @param Upload $value
     */
    public function setUpload(string $name, Upload $value);

    /**
     * 获取文件上传者
     * @param string $name
     * @return Upload
     */
    public function getUpload(string $name):?Upload;

}