<?php
namespace Swiftx\Http;
use Swiftx\System\Object;

/**
 * 访问请求接收类,由系统为开发者提供该对象实例，不建议自行实例化该对象使用
 * @author		胡永强 <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 * @property Get Get
 * @property Post Post
 * @property File File
 * @property Cookie Cookie
 * @property string Script
 * @property string document
 * @property string Uri
 * @property string Protocol
 * @property string Host
 * @property string Url
 * @property string QueryString
 * @property int DevType
 * @property string UserAgent
 */
class Request extends Object implements IRequest {

    const Unknown = 0;  // 未知
    const DevWab = 1;   // 电脑网页
    const DevWap = 2;   // 手机网页
    const DevApp = 3;   // 手机应用

    /** @var Get */
    protected $_get;
    /** @var Post */
    protected $_post;
    /** @var Cookie */
    protected $_cookie;
    /** @var File */
    protected $_file;

    /**
     * 构造函数,对象初始化
     */
    public function __construct() {
        $this->_get = new Get();
        $this->_post = new Post();
        $this->_file = new File();
        $this->_cookie = new Cookie();
    }

    /**
     * 获取Get对象
     * @access Attribute 只读属性
     * @return Get
     */
    protected function _getGet(){
        if(empty($this->_get))
			$this->_get = new Get();
        return $this->_get;
    }

    /**
     * 获取Post对象
     * @access Attribute 只读属性
     * @return Post
     */
    protected function _getPost(){
        return $this->_post;
    }

    /**
     * 获取Cookie对象
     * @access Attribute 只读属性
     * @return Cookie
     */
    protected function _getCookie(){
        return $this->_cookie;
    }

    /**
     * 获取File对象
     * @access Attribute 只读属性
     * @return File
     */
    protected function _getFile(){
        return $this->_file;
    }

    /**
     * 请求的目标脚本
     * @access Attribute 只读属性
     * @return string
     */
    protected function _getScript(){
        return $_SERVER['SCRIPT_NAME'];
    }

    /**
     * 请求URI
     * @access Attribute 只读属性
     * @return string
     */
    protected function _getUri(){
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * GET请求窜
     * @access Attribute 只读属性
     * @return string
     */
    protected function _getQueryString(){
        return $_SERVER['QUERY_STRING'];
    }

    /**
     * 客户端设备类型
     * @return int
     */
    protected function _getDevType(){
        $UserAgent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $UserAgentCommentsBlock=preg_match('|\(.*?\)|',$UserAgent,$matches)>0?$matches[0]:'';
        $MobileOsList = [
            'Google Wireless Transcoder', 'Windows CE', 'WindowsCE', 'Symbian',
            'Android', 'armv6l', 'armv5', 'Mobile', 'CentOS', 'mowser', 'AvantGo',
            'Opera Mobi', 'J2ME/MIDP', 'Smartphone', 'Go.Web', 'Palm', 'iPAQ'];
        $MobileTokenList = [
            'Profile/MIDP', 'Configuration/CLDC-', '160×160', '176×220', '240×240',
            '240×320', '320×240', 'UP.Browser', 'UP.Link', 'SymbianOS', 'PalmOS',
            'PocketPC', 'SonyEricsson', 'Nokia', 'BlackBerry', 'Vodafone', 'BenQ',
            'Novarra-Vision', 'Iris', 'NetFront', 'HTC_', 'Xda_', 'SAMSUNG-SGH',
            'Wapaka', 'DoCoMo', 'iPhone', 'iPod'];
        foreach($MobileOsList as $substr)
            if(false!==strpos($UserAgentCommentsBlock, $substr)) return static::DevWap;
        foreach($MobileTokenList as $substr)
            if(false!==strpos($UserAgent, $substr)) return static::DevWap;
        return static::DevWab;
    }

    /**
     * 是否来自手机的
     * @return bool
     */
    protected function _getIsFromWap(){
       return $this->DevType == static::DevWap;
    }

    /**
     * 是否Ajax方式请求
     * @return bool
     */
    protected function _getAjax(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']));
    }

    /**
     * 获取请求的域名
     * @return mixed
     */
    protected function _getHost(){
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * 获取请求的协议类型
     * @return mixed
     */
    protected function _getProtocol(){
        return $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * 用户标识
     * @return null
     */
    protected function _getUserAgent(){
        if(isset($_SERVER['HTTP_USER_AGENT']))
            return $_SERVER['HTTP_USER_AGENT'];
        return null;
    }

    /**
     * 获取请求的Host
     * @return mixed
     */
    protected function _getUrl(){
        $protocol = explode('/',$this->Protocol);
        $protocol = strtolower($protocol[0]).'://';
        return $protocol.$this->Host.$this->Uri;
    }

    /**
     * 获取目标文档目录
     * @return string
     */
    protected function _getDocument(){
        return $_SERVER['DOCUMENT_ROOT'].$_SERVER['DOCUMENT_URI'];
    }

}

