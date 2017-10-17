<?php
namespace Swiftx\Http\Component;
use Swiftx\Http\Interfaces\Session as InterfaceSession;

/**
 * Class Session
 * @package Swiftx\Component\Httpd
 */
class Session implements InterfaceSession {

    /**
     * 编号
     * @var string
     */
    protected $id;

    /**
     * SESSION数据
     * @var string[]
     */
    protected $data;

    /**
     * 设置编号
     * @param string $value
     */
    public function setID(string $value){
        $this->id = $value;
    }

    /**
     * 获取ID
     * @return string
     */
    public function getID():string{
        return $this->id;
    }

    /**
     * 映射数据
     * @param array $value
     */
    public function mapData(array &$value){
        $this->data = &$value;
    }

    /**
     * 设置数据
     * @param array $value
     */
    public function setData(array $value){
        $this->data = $value;
    }

    /**
     * 判断是否存在
     * @param string $key
     * @return bool
     */
    public function exists(string $key):bool {
        return isset($this->data[$key]);
    }

    /**
     * 设置POST值
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value){
        $this->data[$key] = $value;
    }

    /**
     * 读取POST值
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public function get(string $key, $default = null){
        if(!$this->exists($key)) return $default;
        return $this->data[$key];
    }

}
