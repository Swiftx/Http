<?php
namespace Swiftx\Http;
/**
 * 访问请求接收类,由系统为开发者提供该对象实例，不建议自行实例化该对象使用
 * @author		胡永强 <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 * @property Get $Get
 * @property Post $Post
 * @property File $File
 * @property Cookie $Cookie
 * @property string $Script
 * @property string $document
 * @property string $Uri
 * @property string $Protocol
 * @property string $Host
 * @property string $Url
 * @property int $DevType
 * @property string UserAgent
 */
interface IRequest {

    /**
     * ----------------------------------------------------------
     * 魔术方法Get
     * ----------------------------------------------------------
     * @access Attribute
     * ----------------------------------------------------------
     * @param string $name
     * ----------------------------------------------------------
     * @return mixed
     * ----------------------------------------------------------
     */
    public function __get($name);

    /**
     * ----------------------------------------------------------
     * 魔术方法Set
     * ----------------------------------------------------------
     * @access Attribute
     * ----------------------------------------------------------
     * @param string $name
     * @param mixed $value
     * ----------------------------------------------------------
     */
    public function __set($name,$value);

}

