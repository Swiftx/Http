<?php
namespace Swiftx\Http\Component;
use Swiftx\Http\Interfaces\Request as RequestInterfaces;
use Swiftx\Http\Interfaces\Post as PostInterfaces;
use Swiftx\Http\Interfaces\Cookie as CookieInterfaces;
use Swiftx\Http\Interfaces\Session as SessionInterfaces;
use Swiftx\Http\Interfaces\Upload as UploadInterfaces;
use Swiftx\Http\Interfaces\Uri as UriInterfaces;

/**
 * 用户Http请求类
 * @package Swiftx\Http\Component
 */
class Request implements RequestInterfaces {

    /**
     * 请求方式
     * @var string
     */
    protected $method = null;

    /**
     * 到达时间
     * @var int
     */
    protected $create_time = null;

    /**
     * 请求参数
     * @var string[]
     */
    protected $params = [];

    /**
     * 目标Uri地址
     * @var UriInterfaces
     */
    protected $uri = null;

    /**
     * Cookie
     * @var string[]
     */
    protected $cookie = [];

    /**
     * SESSION
     * @var SessionInterfaces
     */
    protected $session = null;

    /**
     * POST数据
     * @var PostInterfaces
     */
    protected $post = null;

    /**
     * 上传文件集
     * @var UploadInterfaces[]
     */
    protected $uploads = [];

    /**
     * 语言类型
     * @var string[]
     */
    protected $languages = [];

    /**
     * 设置请求方式
     * @param string $value
     * @return void
     */
    public function setMethod(string $value){
        $this->method = strtoupper($value);
    }

    /**
     * 获取请求方式
     * @return string
     */
    public function getMethod():string{
        return $this->method;
    }

    /**
     * 设置时间戳
     * @param int $timestamp
     */
    public function setCreateTime(int $timestamp){
        $this->create_time = $timestamp;
    }

    /**
     * 获取时间戳
     * @return int
     */
    public function getCreateTime():int{
        return $this->create_time;
    }

    /**
     * 设置附加参数
     * @param string $key
     * @param string $value
     */
    public function setParam(string $key, string $value){
        $this->params[$key] = $value;
    }

    /**
     * 获取附加参数
     * @param string $key
     * @return null|string
     */
    public function getParam(string $key):?string {
        if(array_key_exists($key, $this->params))
            return $this->params[$key];
        return $this->getUri()->getParam($key);
    }

    /**
     * 设置Uri对象
     * @param UriInterfaces $uri
     */
    public function setUri(UriInterfaces $uri){
        $this->uri = $uri;
    }

    /**
     * 获取Uri对象
     * @return UriInterfaces
     */
    public function getUri(): ?UriInterfaces{
        return $this->uri;
    }

    /**
     * 设置Cookie对象
     * @param string $key
     * @param string $value
     */
    public function setCookie(string $key, string $value){
        $this->cookie[$key] = $value;
    }

    /**
     * 获取Cookie对象
     * @return string|null
     */
    public function getCookie(string $key):?string {
        if(array_key_exists($key, $this->cookie))
            return $this->cookie[$key];
        return null;
    }

    /**
     * 设置SESSION对象
     * @param SessionInterfaces $value
     */
    public function setSession(SessionInterfaces $value) {
        $this->session = $value;
    }

    /**
     * 获取SESSION对象
     * @return SessionInterfaces
     */
    public function getSession(): ?SessionInterfaces {
        return $this->session;
    }

    /**
     * 设置POST对象
     * @param PostInterfaces $post
     */
    public function setPost(PostInterfaces $post){
        $this->post = $post;
    }

    /**
     * 获取POST对象
     * @return PostInterfaces
     */
    public function getPost(): ?PostInterfaces{
        return $this->post;
    }

    /**
     * 设置上传对象
     * @param string $name
     * @param UploadInterfaces $value
     */
    public function setUpload(string $name, UploadInterfaces $value){
        $this->uploads[$name] = $value;
    }

    /**
     * 获取文件上传者
     * @param string $name
     * @return UploadInterfaces
     */
    public function getUpload(string $name): ?UploadInterfaces {
        if(isset($this->uploads[$name]))
            return $this->uploads[$name];
        return null;
    }

    /**
     * 设置语言
     * @param string $value
     */
    public function setLanguage(string $value) {
        if(in_array($value, $this->languages)) return;
        $this->languages[] = $value;
    }

    /**
     * 设置语言
     * @param string[] ...$value
     */
    public function setLanguages(string ...$value) {
        $this->languages = array_values(array_unique($value));
    }

    /**
     * 读取语言
     * @return string[]
     */
    public function getLanguages(): array {
        return $this->languages;
    }

    /**
     * 对象深拷贝
     */
    public function __clone(){
        if($this->uri != null)
            $this->uri = clone $this->uri;
        if($this->session != null)
            $this->session = clone $this->session;
        foreach ($this->uploads as &$upload)
            $upload = clone $upload;
    }

    /**
     * 从全局数组捕获Request对象
     * @return RequestInterfaces
     */
    public static function captureFromGlobals(): RequestInterfaces{
        // 创建请求对象
        $request = new Request();
        $request->setMethod($_SERVER['REQUEST_METHOD']);
        $request->setCreateTime($_SERVER['REQUEST_TIME']);

        // 全局数据构造URI对象
        $uri = new Uri();
        $uri->setScheme($_SERVER['SERVER_PROTOCOL']);
        $uri->setHost($_SERVER['HTTP_HOST']);
        $uri->setPort((int)$_SERVER['SERVER_PORT']);
        $uri->setPath($_SERVER['DOCUMENT_URI']);
        $uri->setParams($_GET);
        $request->setUri($uri);

        // 全局数据构造POST对象
        $post = new Post();
        $post->setRawData(file_get_contents("php://input"));
        $post->setData($_POST);
        $request->setPost($post);

        // 创建Cookie的数据
        foreach ($_COOKIE as $key => $value)
            $request->setCookie($key, $value);

        // 从全局数据构造Upload
        foreach($_FILES as $key => $item){
            $upload = new Upload();
            $upload->setName($item['name']);
            $upload->setType($item['type']);
            $upload->setTmpFile($item['tmp_name']);
            $upload->setError($item['error']);
            $upload->setSize($item['size']);
            $request->setUpload($key, $upload);
        }

        // 全局数据构造SESSION
        session_start();
        $session = new Session();
        $session->setID(session_id());
        $session->mapData($_SESSION);
        $request->setSession($session);

        // 返回构造完成的请求对象
        return $request;
    }

}