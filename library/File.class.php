<?php
namespace Swiftx\Http;
use Swiftx\System\Object;
/**
 * Swiftx对象方式File处理程序
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 */
class File extends Object implements \ArrayAccess{

    /**
     * 判断上传文件是否存在
     * @param string $key 字段名
     * @return bool
     */
    public function Exists($key){
        return isset($_FILES[$key]);
    }

    /**
     * ArrayAccess接口，数组方式赋值方法
     * @param string $offset 数组方式键
     * @param string $value 数组方式值
     * @throws Exception
     */
    public function offsetSet($offset, $value) {
        throw new Exception('调用方法不正确',500);
    }

    /**
     * ArrayAccess接口，数组方式取值方法
     * @param string $offset 数组方式键
     * @return null|Upload
     * @throws Exception
     */
    public function offsetGet($offset) {
        if(empty($_FILES[$offset]))
            throw new Exception('上传的内容不存在',500);
        new Upload($_FILES[$offset]);
        return new Upload($_FILES[$offset]);
    }

    /**
     * ArrayAccess接口，数组方式isset方法
     * @param string $offset 数组方式键
     * @return bool
     */
    public function offsetExists($offset) {
        return $this->Exists($offset);
    }

    /**
     * ArrayAccess接口，数组方式unset方法
     * @param string $offset		数组方式键
     */
    public function offsetUnset($offset) {
        unset($_FILES[$offset]);
    }

}