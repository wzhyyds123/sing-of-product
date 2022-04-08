<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class composer extends Model
{
    protected $table = "composer";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * 添加
     */
    public static function add($composer,$cname){
        $users_works_id = DB::table('users_works')->where('cname',$cname)->value('id');
        $a=count($composer); //计算列
        try {
            for($b=0;$b<$a;$b++){
                $composername= $composer[$b]['composername'];
                $cphone=$composer[$b]['cphone'];
                $ccard=$composer[$b]['ccard'];
                $data = self::create([
                        'composername' => $composername,
                        'cphone' => $cphone,
                        'ccard' => $ccard,
                        'users_works_id' => $users_works_id,
                    ]
                );
            }
            return $data;
        } catch (\Exception $e) {
            logError('增添失败', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 修改
     */
    public static function change($composer,$cname){
        $users_works_id = DB::table('users_works')->where('cname',$cname)->value('id');
        $a=count($composer); //计算列
        try {
            for($b=0;$b<$a;$b++){
                $composername= $composer[$b]['composername'];
                $cphone=$composer[$b]['cphone'];
                $ccard=$composer[$b]['ccard'];
                $data = self::update([
                        'composername' => $composername,
                        'cphone' => $cphone,
                        'ccard' => $ccard,
                        'users_works_id' => $users_works_id,
                    ]
                );
            }
            return $data;
        } catch (\Exception $e) {
            logError('修改失败', [$e->getMessage()]);
            return false;
        }
    }
}
