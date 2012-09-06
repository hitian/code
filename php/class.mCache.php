<?php

/**
  * Copyright (c) 2012,�Ϻ�������Ƽ��ɷ����޹�˾
  * ժ    Ҫ��memcache ������
  * ��    �ߣ�tianj<sffytian@gmail.com>
  * �޸����ڣ�2012.08.28
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
     * �� ����
     * �� �ߣ�tianj<sffytian@gmail.com>
     * �� �ܣ��������ʼ��
     * �޸����ڣ�2012-09-04
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
     * �� ����key,string����������
     *       var,string����������
     *       expire,int������ʱ��
     * �� �ߣ�tianj<sffytian@gmail.com>
     * �� �ܣ��洢
     * �޸����ڣ�2012-09-04
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
     * �� ����key,string����������
     * �� �ߣ�tianj<sffytian@gmail.com>
     * �� �ܣ���ȡ
     * �޸����ڣ�2012-09-04
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
     * �� ����key,string����������
     *       var,string��������ֵ
     * �� �ߣ�tianj<sffytian@gmail.com>
     * �� �ܣ�����
     * �޸����ڣ�2012-09-04
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
     * �� ����
     * �� �ߣ�tianj<sffytian@gmail.com>
     * �� �ܣ��Լ�
     * �޸����ڣ�2012-09-04
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
     * �� ����
     * �� �ߣ�tianj<sffytian@gmail.com>
     * �� �ܣ�ɾ��
     * �޸����ڣ�2012-09-04
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