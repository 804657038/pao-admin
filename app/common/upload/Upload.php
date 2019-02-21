<?php
namespace app\common\upload;
use think\Controller;
use think\Request;
class Upload extends Controller{

    public function upload(){

    }

    public function base2img($base){  //base64转图片
        try{
            header("Content-type: text/html; charset=utf-8");

            $filePath = base64_decode($base);
            $toDay=date('Ymd');

            if(!file_exists("public/uploads/{$toDay}")){
                mkdir("public/uploads/{$toDay}/",0777,true);
            }
            $thumbNname=rand(999,10000) . date('YmdHis') . rand(0, 9999) . '.' . 'jpg';
            $keys = "public/uploads/{$toDay}/".$thumbNname;
            $path="/uploads/{$toDay}/".$thumbNname;

            file_put_contents($keys,$filePath);

            return $path;
        }catch(\Exception $e){
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }
}
