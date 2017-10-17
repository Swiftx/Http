<?php
namespace Swiftx\Http\Component;
use Swiftx\Http\Interfaces\Upload as UploadInterface;
/**
 * 上传文件类
 * @package Swiftx\Component\Httpd
 */
class Upload implements UploadInterface {

    /**
     * 文件名称
     * @var string
     */
    protected $name;

    /**
     * 文件扩展名
     * @var string
     */
    protected $ext_name;

    /**
     * 文件类型
     * @var string
     */
    protected $type;

    /**
     * 临时文件
     * @var string
     */
    protected $tmp_name;

    /**
     * 异常代码
     * @var int
     */
    protected $error;

    /**
     * 文件大小
     * @var int
     */
    protected $size;

    /**
     * 设置文件名
     * @param string $value
     */
    public function setName(string $value){
        $value = explode('.', $value);
        $this->name = $value[0];
        $this->ext_name = $value[1];
    }

    /**
     * 获取文件名
     * @return string
     */
    public function getName():string {
        return $this->name;
    }

    /**
     * 读取扩展名
     * @return string
     */
    public function getExtName():string {
        return $this->ext_name;
    }

    /**
     * 设置文件类型
     * @param string $value
     */
    public function setType(string $value){
        $this->type = $value;
    }

    /**
     * 设置错误代码
     * @param int $code
     */
    public function setError(int $code){
        $this->error = $code;
    }

    /**
     * 设置临时文件名
     * @param string $path
     */
    public function setTmpFile(string $path){
        $this->tmp_name = $path;
    }

    /**
     * 设置文件大小
     * @param int $value
     */
    public function setSize(int $value){
        $this->size = $value;
    }

    /**
     * 保存临时文件
     * @param string $path
     * @return bool
     */
    public function save(string $path){
        return move_uploaded_file($this->tmp_name, $path);
    }

}
