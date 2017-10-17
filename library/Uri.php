<?php
namespace Swiftx\Http\Component;
use League\Uri\Schemes\Http;
use Swiftx\Http\Interfaces\Uri as UriInterface;

/**
 * URI 实现类
 * @package Swiftx\Http\Component
 */
class Uri implements UriInterface {

    /**
     * UriHttp
     * @var Http
     */
    protected $http = null;

    /**
     * 请求参数
     * @var array|null
     */
    protected $params = null;

    /**
     * 构造函数
     * @param string $uri
     */
    public function __construct(string $uri=''){
        $this->setString($uri);
    }

    /**
     * 设置请求地址
     * @param string $http
     */
    public function setString(string $http){
        $this->http = Http::createFromString($http);
        $this->params = null;
    }

    /**
     * 读取请求地址
     * @return string
     */
    public function getString():string {
        return (string)$this->http;
    }

    /**
     * 设置协议
     * @param string $scheme
     */
    public function setScheme(string $scheme){
        $this->http = $this->http->withScheme($scheme);
    }

    /**
     * 读取协议
     * @return string
     */
    public function getScheme():string {
        return $this->http->getScheme();
    }

    /**
     * 设置用户信息
     * @param string $user
     * @param string|null $password
     */
    public function setUserInfo(string $user , string $password = null){
        $this->http = $this->http->withUserInfo($user, $password);
    }

    /**
     * 读取用户信息
     * @return string
     */
    public function getUserInfo():string {
        return $this->http->getUserInfo();
    }

    /**
     * 设置主机名
     * @param string $host
     */
    public function setHost(string $host){
        $this->http = $this->http->withHost($host);
    }

    /**
     * 读取主机名
     * @return string
     */
    public function getHost():string {
        return $this->http->getHost();
    }

    /**
     * 设置端口号
     * @param int|null $port
     */
    public function setPort(?int $port){
        $this->http = $this->http->withPort($port);
    }

    /**
     * 设置地址路径
     * @param string $path
     */
    public function setPath(string $path){
        $this->http = $this->http->withPath($path);
    }

    /**
     * 读取地址路径
     * @return string
     */
    public function getPath():string {
        return $this->http->getPath();
    }

    /**
     * 设置请求串
     * @param string $query
     */
    public function setQuery(string $query){
        $this->http = $this->http->withQuery($query);
        $this->params = null;
    }

    /**
     * 读取请求串
     * @return string
     */
    public function getQuery():string {
        return $this->http->getQuery();
    }

    /**
     * 批量读取参数
     * @return array
     */
    public function getParams():array {
        if($this->params !== null)
            return $this->params;
        $params = explode('&', $this->getQuery());
        $this->params = [];
        foreach ($params as $param){
            $param = explode('=', $param);
            $this->params[$param[0]] = $param[1];
        }
        return $this->params;
    }

    /**
     * 判断是否存在该参数
     * @param string $key
     * @return bool
     */
    public function hasParam(string $key):bool {
        $params = $this->getParams();
        return isset($params[$key]);
    }

    /**
     * 读取请求参数
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getParam(string $key, string $default=null):?string {
        if(!$this->hasParam($key))
            return $default;
        $params = $this->getParams();
        return $params[$key];
    }

    /**
     * 批量设置参数
     * @param array $data
     */
    public function setParams(array $data){
        foreach ($data as $key => &$param)
            $param = $key.'='.$param;
        $data = implode('&', $data);
        $this->setQuery($data);
        $this->params = $data;
    }

    /**
     * 设置请求参数
     * @param string $key
     * @param mixed $value
     */
    public function setParam(string $key, $value){
        $data = $this->getParams();
        $data[$key] = $value;
        $this->setParams($data);
    }

    /**
     * 设置锚元素
     * @param string $fragment
     */
    public function setFragment(string $fragment){
        $this->http = $this->http->withFragment($fragment);
    }

    /**
     * 读取锚元素
     * @return string
     */
    public function getFragment():string {
        return $this->http->getFragment();
    }

}