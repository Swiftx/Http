<?php
namespace Swiftx\Http\Interfaces;

interface Upload {

    /**
     * 设置文件名
     * @param string $value
     */
    public function setName(string $value);

    /**
     * 获取文件名
     * @return string
     */
    public function getName():string ;

    /**
     * 读取扩展名
     * @return string
     */
    public function getExtName():string ;

    /**
     * 设置文件类型
     * @param string $value
     */
    public function setType(string $value);

    /**
     * 设置错误代码
     * @param int $code
     */
    public function setError(int $code);

    /**
     * 设置临时文件名
     * @param string $path
     */
    public function setTmpFile(string $path);

    /**
     * 设置文件大小
     * @param int $value
     */
    public function setSize(int $value);

    /**
     * 保存临时文件
     * @param string $path
     * @return bool
     */
    public function save(string $path);

}