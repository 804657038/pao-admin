<?php

namespace app\admin\controller;
use think\cache\driver\Redis as RedisModel;
use think\Exception;

class Redis {
    protected $config=[
        'host'       => 'r-wz902c70019fd004.redis.rds.aliyuncs.com',
        'port'       => 6379,
        'password'   => 'Zz2381788',
        'select'     => 0,
        'timeout'    => 0,
        'expire'     => 0,
        'persistent' => false,
        'prefix'     => '',
    ];

    public function clear($tag=null){
        $Redis=new RedisModel($this->config);
        $Redis->clear($tag);
    }
    public function del($key){
        $Redis=new RedisModel($this->config);
        $Redis->rm($key);
    }
    public function rpush($keys,$value){  //入队

        $Redis=new RedisModel($this->config);
        if(is_array($value)){
            foreach ($value as $key=>$val){
                $Redis->rpush($keys,json_encode($val));
            }
        }else{
            $Redis->rpush($keys,json_encode($value));
        }
    }
    public function lpop($keys){
        $Redis=new RedisModel($this->config);
        $list=$Redis->lpop($keys);
        return json_decode($list,true);
    }
    public function get($key){
        $Redis=new RedisModel($this->config);
        $list=$Redis->get($key);
        return $list;
    }

    public function set($key,$value,$expire=''){
        $Redis=new RedisModel($this->config);
        $Redis->set($key,$value,$expire);
    }
//    public function add(){
//        $Redis=new RedisModel($this->config);
//        $Redis->Zincrby('reslist',1.1,1);
//    }
//
    public function lists(){
        try{
            $redis=new RedisModel($this->config);
            $res=$redis->zrange('redlist',0,-1);

            foreach ($res as $key=>$value){
                $r=$redis->zScore('redlist',$value);

            }
//
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
    public function rm(){
        $this->del('redlist');
    }

}
?>