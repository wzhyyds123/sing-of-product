<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class lyrics extends Model
{
    protected $table = "lyrics";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * 添加
     */
    public static function add($lyrics,$cname){
        $users_works_id = DB::table('users_works')->where('cname',$cname)->value('id');
        $a=count($lyrics); //计算列
        try {
            for($b=0;$b<$a;$b++){
                $lname= $lyrics[$b]['lname'];
                $lcard=$lyrics[$b]['lcard'];
                $lphone=$lyrics[$b]['lphone'];
                $data = self::create([
                        'lname' => $lname,
                        'lcard' => $lcard,
                        'lphone' => $lphone,
                        'users_works_id' => $users_works_id,
                    ]
                );
            }
            return $data;
        } catch (\Exception $e) {
            logError('添加失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 添加
     */
    public static function change($lyrics,$cname){
        $users_works_id = DB::table('users_works')->where('cname',$cname)->value('id');
        $a=count($lyrics); //计算列
        try {
            for($b=0;$b<$a;$b++){
                $lname= $lyrics[$b]['lname'];
                $lcard=$lyrics[$b]['lcard'];
                $lphone=$lyrics[$b]['lphone'];
                $data = self::update([
                        'lname' => $lname,
                        'lcard' => $lcard,
                        'lphone' => $lphone,
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
