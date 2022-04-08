<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usersworks extends Model
{
    protected $table = "users_works";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * 添加
     */
    public static function add($cname,$work,$creativetime,$worktime,$singer,$brief,$song,$mp3,$copyright,$plphone,$plname){
        try {
               $data = self::create([
                   'cname'=>$cname,
                   'work'=>$work,
                   'creativetime'=>$creativetime,
                   'worktime'=>$worktime,
                   'singer'=>$singer,
                   'brief'=>$brief,
                   'song'=>$song,
                   'mp3'=>$mp3,
                   'copyright'=>$copyright,
                   'plphone'=>$plphone,
                   'plname'=>$plname,
               ]);
            return $data;
        } catch (\Exception $e) {
            logError('添加失败', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 删除
     */
    public static function deletee($id){
        try {
            $data = self::where('id',$id)->delete();
            return $data;
        } catch (\Exception $e) {
            logError('删除失败', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 修改
     */
    public static function change($cname,$work,$creativetime,$worktime,$singer,$brief,$song,$mp3,$copyright,$plphone,$plname){
        try {
            $data = self::update([
                'cname'=>$cname,
                'work'=>$work,
                'creativetime'=>$creativetime,
                'worktime'=>$worktime,
                'singer'=>$singer,
                'brief'=>$brief,
                'song'=>$song,
                'mp3'=>$mp3,
                'copyright'=>$copyright,
                'plphone'=>$plphone,
                'plname'=>$plname,
            ]);
            return $data;
        } catch (\Exception $e) {
            logError('修改失败', [$e->getMessage()]);
            return false;
        }
    }
}
