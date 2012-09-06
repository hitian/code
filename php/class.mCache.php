<?php

/**
  * Copyright (c) 2012,上海瑞创网络科技股份有限公司
  * 摘    要：memcache 操作类
  * 作    者：tianj<sffytian@gmail.com>
  * 修改日期：2012.08.28
  */
class mCache
{

    private static $_instance;

    private $mmc = null;

    private $version = 1;

    private function __construct()
    {
        $this->mmc = new memcache();
        $this->mmc->addServer('192.168.2.170', 11211);
        $this->mmc->addServer('192.168.2.117', 11211);
    }

    /**
     * 参 数：
     * 作 者：tianj<sffytian@gmail.com>
     * 功 能：单例类初始化
     * 修改日期：2012-09-04
     */
    public static function init()
    {
        if(! isset(self::$_instance))
        {
            $c = __CLASS__;
            self::$_instance = new $c();
        }
        return self::$_instance;
    }

    /**
     * 参 数：key,string，缓存名称
     *       var,string，缓存内容
     *       expire,int，过期时间
     * 作 者：tianj<sffytian@gmail.com>
     * 功 能：存储
     * 修改日期：2012-09-04
     */
    function set($key, $var, $expire = 3600)
    {
        if(! $this->mmc)
        {
            return false;
        }
        return $this->mmc->set($this->version . '_' . $key, $var, $expire);
    }

    /**
     * 参 数：key,string，缓存名称
     * 作 者：tianj<sffytian@gmail.com>
     * 功 能：获取
     * 修改日期：2012-09-04
     */
    function get($key)
    {
        if(! $this->mmc)
        {
            return false;
        }
        return $this->mmc->get($this->version . '_' . $key);
    }

    /**
     * 参 数：key,string，缓存名称
     *       var,string，自增数值
     * 作 者：tianj<sffytian@gmail.com>
     * 功 能：自增
     * 修改日期：2012-09-04
     */
    function incr($key, $value = 1)
    {
        if(! $this->mmc)
        {
            return false;
        }
        return $this->mmc->increment($this->version . '_' . $key, $value);
    }

    /**
     * 参 数：
     * 作 者：tianj<sffytian@gmail.com>
     * 功 能：自减
     * 修改日期：2012-09-04
     */
    function decr($key, $value = 1)
    {
        if(! $this->mmc)
        {
            return false;
        }
        return $this->mmc->decrement($this->version . '_' . $key, $value);
    }

    /**
     * 参 数：
     * 作 者：tianj<sffytian@gmail.com>
     * 功 能：删除
     * 修改日期：2012-09-04
     */
    function delete($key)
    {
        if(! $this->mmc)
        {
            return false;
        }
        return $this->mmc->delete($this->version . '_' . $key);
    }
}