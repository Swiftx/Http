<?php
namespace Swiftx\Http;
use Swiftx\System\Object;

/**
 * Swiftx对象方式上传文件实体
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2015-11-19
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 * @property int Status 上传状态
 * @property string Name 文件名
 * @property int Size 文件大小
 * @property string Suffix 文件后缀
 * @property string Type 文件类型
 * @property string Md5 文件指纹
 */
class Upload extends Object{

    const Success = 1;  // 上传成功
    const Error = 0;    // 上传失败
    const Null = 2;     // 没有内容
	
	protected $_name;
    protected $_size;
    protected $_temp;
    protected $_suffix;
    protected $_type;
    protected $_state;

    /**
     * @param $argument
     */
	public function __construct($argument) {
		$this->_name = $argument['name'];
        if(empty($argument['type'])){
            $this->_type = null;
            $this->_suffix = null;
        }else{
            $argument['type'] = explode('/', $argument['type']);
            $this->_type = $argument['type'][0];
            $this->_suffix = $argument['type'][1];
        }
		$this->_size = $argument['size'];
		$this->_temp = $argument['tmp_name'];
		$this->_state = $argument['error'];
	}

    /**
     * 文件名
     * @return string
     */
    protected function _getName(){
		return $this->_name;
	}

    /**
     * 文件状态
     * @return mixed
     */
    protected function _getStatus(){
		switch($this->_state){
            case 0:
                return static::Success;
            case 1:
            case 2:
            case 3:
                return static::Error;
            case 4:
            case 5:
                return static::Null;
        }
	}

    /**
     * 文件指纹
     * @return string
     */
    protected function _getMd5(){
		return md5_file($this->_temp);
	}

    /**
     * 文件内容
     * @return string
     */
    protected function _getContents(){
		return file_get_contents($this->_temp);
	}

    /**
     * 文件后缀
     * @return mixed
     */
    protected function _getSuffix(){
		return $this->_suffix;
	}

    /**
     * 文件大小
     * @return mixed
     */
    protected function _getSize(){
		return $this->_size;
	}

    /**
     * 文件类型
     * @return mixed
     */
    protected function _getType(){
		return $this->_type;
	}

    /**
     * 保存文件
     * @param $path
     * @return bool
     */
	public function Save($path){
		return move_uploaded_file($this->_temp, $path);
	}

}