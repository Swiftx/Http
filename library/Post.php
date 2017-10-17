<?php
namespace Swiftx\Http\Component;
use Swiftx\Http\Interfaces\Post as InterfacePost;

/**
 * Post实现类
 * @package Swiftx\Httpd
 */
class Post implements InterfacePost {

    /**
     * 原始数据
     * @var string
     */
    protected $rawData = '';

    /**
     * 解析数据
     * @var array
     */
    protected $arrData = [];

    /**
     * 读取原始数据
     * @return string
     */
    public function getRawData():string{
        return $this->rawData;
    }

    /**
     * 设置原始数据
     * @param string $value
     */
    public function setRawData(string $value){
        $this->rawData = $value;
    }

    /**
     * 设置数据集合
     * @param array $value
     */
    public function setData(array $value){
        $this->arrData = $value;
    }

    /**
     * 判断是否存在
     * @param string $key
     * @return bool
     */
    public function exists(string $key):bool{
        return isset($this->arrData[$key]);
    }

    /**
     * 设置POST值
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value){
        $this->arrData[$key] = $value;
    }

    /**
     * 读取POST值
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null){
        if(!$this->exists($key)) return $default;
        return $this->arrData[$key];
    }

}
