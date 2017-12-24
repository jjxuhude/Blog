<?php
namespace App\Lib;
class Data implements \ArrayAccess{
    protected $_data = array();
    
    protected static $_underscoreCache = array();
    
    protected $_syncFieldsMap = array();
    
    
    
    protected function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        self::$_underscoreCache[$name] = $result;
        return $result;
    }
    
    
    
    public function getData($key='', $index=null)
    {
        if (''===$key) {
            return $this->_data;
        }
    
        $default = null;
    
        // accept a/b/c as ['a']['b']['c']
        if (strpos($key,'/')) {
            $keyArr = explode('/', $key);
            $data = $this->_data;
            foreach ($keyArr as $i=>$k) {
                if ($k==='') {
                    return $default;
                }
                if (is_array($data)) {
                    if (!isset($data[$k])) {
                        return $default;
                    }
                    $data = $data[$k];
                } elseif ($data instanceof \App\Lib\Data) {
                    $data = $data->getData($k);
                } else {
                    return $default;
                }
            }
            return $data;
        }
    
        // legacy functionality for $index
        if (isset($this->_data[$key])) {
            if (is_null($index)) {
                return $this->_data[$key];
            }
    
            $value = $this->_data[$key];
            if (is_array($value)) {
                if (isset($value[$index])) {
                    return $value[$index];
                }
                return null;
            } elseif (is_string($value)) {
                $arr = explode("\n", $value);
                return (isset($arr[$index]) && (!empty($arr[$index]) || strlen($arr[$index]) > 0))
                ? $arr[$index] : null;
            } elseif ($value instanceof \App\Lib\Data) {
                return $value->getData($index);
            }
            return $default;
        }
        return $default;
    }
    
    protected function _camelize($name)
    {
        return $this->uc_words($name, '');
    }
    
    
    public function assign($key, $value=null)
    {
        if (is_array($key)) {
            foreach ($key as $k=>$v) {
                $this->assign($k, $v);
            }
        }
        else {
            $this->_data[$key] = $value;
        }
        return $this;
    }
    
    public function setData($key, $value=null)
    {
        $this->_hasDataChanges = true;
        if(is_array($key)) {
            $this->_data = $key;
            $this->_addFullNames();
        } else {
            $this->_data[$key] = $value;
            if (isset($this->_syncFieldsMap[$key])) {
                $fullFieldName = $this->_syncFieldsMap[$key];
                $this->_data[$fullFieldName] = $value;
            }
        }
        return $this;
    }
    
    protected function _addFullNames()
    {
        $existedShortKeys = array_intersect($this->_syncFieldsMap, array_keys($this->_data));
        if (!empty($existedShortKeys)) {
            foreach ($existedShortKeys as $key) {
                $fullFieldName = array_search($key, $this->_syncFieldsMap);
                $this->_data[$fullFieldName] = $this->_data[$key];
            }
        }
    }
    
    
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                //Varien_Profiler::start('GETTER: '.get_class($this).'::'.$method);
                $key = $this->_underscore(substr($method,3));
                $data = $this->getData($key, isset($args[0]) ? $args[0] : null);
                //Varien_Profiler::stop('GETTER: '.get_class($this).'::'.$method);
                return $data;
    
            case 'set' :
                //Varien_Profiler::start('SETTER: '.get_class($this).'::'.$method);
                $key = $this->_underscore(substr($method,3));
                $result = $this->setData($key, isset($args[0]) ? $args[0] : null);
                //Varien_Profiler::stop('SETTER: '.get_class($this).'::'.$method);
                return $result;
    
            case 'uns' :
                //Varien_Profiler::start('UNS: '.get_class($this).'::'.$method);
                $key = $this->_underscore(substr($method,3));
                $result = $this->unsetData($key);
                //Varien_Profiler::stop('UNS: '.get_class($this).'::'.$method);
                return $result;
    
            case 'has' :
                //Varien_Profiler::start('HAS: '.get_class($this).'::'.$method);
                $key = $this->_underscore(substr($method,3));
                //Varien_Profiler::stop('HAS: '.get_class($this).'::'.$method);
                return isset($this->_data[$key]);
        }
        throw new \Exception("Invalid method ".get_class($this)."::".$method."(".print_r($args,1).")");
    }
    
    /**
     * Attribute getter (deprecated)
     *
     * @param string $var
     * @return mixed
     */
    
    public function __get($var)
    {
        $var = $this->_underscore($var);
        return $this->getData($var);
    }
    
    /**
     * Attribute setter (deprecated)
     *
     * @param string $var
     * @param mixed $value
     */
    public function __set($var, $value)
    {
        $var = $this->_underscore($var);
        $this->setData($var, $value);
    }
    
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]);
    
    }
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return isset($this->_data[$offset]);
    
    }
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        $this->_data[$offset] = $value;
    
    }
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    
    }
    
    function uc_words($str, $destSep='_', $srcSep='_')
    {
        return str_replace(' ', $destSep, ucwords(str_replace($srcSep, ' ', $str)));
    }
}