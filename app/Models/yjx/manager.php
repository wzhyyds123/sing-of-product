<?php

namespace App\Models\yjx;

use App\Http\Controllers\user\UserController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class manager extends Model
{
    protected $table = 'users';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable = ['collegename','password' ];

    protected $timestamp=false;

    /**
     * 修改
     *
     * @param $collegename
     * @param $newcollegename
     * @return false
     */
    public static function modify($collegename,$newcollegename){
        try{
            $id = self::where('collegename',$collegename)->value('id');
            //dd($id);
            $res = self::where('id',$id)
                ->update(['collegename' => $newcollegename]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('修改名称失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 删除
     * @param $CollegeName
     * @return false
     */
    public static function delete1($CollegeName){
        try {

            $res = self::where('CollegeName','=',$CollegeName)->delete();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){
            logError('删除错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 所有
     * @return false
     */
    public static function showall(){
        try {
            $res = self::select()
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 用名称查找
     * @param $collegename
     * @return false
     */
    public static function show($collegename){
        try {
            $res =self::select()->
            where('collegename',$collegename)
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 详情
     * @param $cname
     * @return false|\Illuminate\Support\Collection
     */
    public static function showxx($cname){
        try {
            $res =DB::table('users_works')->
            where('cname',$cname)
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }






}
