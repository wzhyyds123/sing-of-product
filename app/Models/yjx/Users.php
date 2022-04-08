<?php

namespace App\Models\yjx;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

 class Users extends Authenticatable implements JWTSubject
{
    use Notifiable ;

     protected $table = 'users';
     protected $remeberTokenName = NULL;
     protected $guarded = [];
     protected $fillable = [ 'collegename','password'];
    /* protected $hidden = [
         'password',
     ];*/
     protected $timestamp=false;

     public function getJWTCustomClaims()
     {
         // TODO: Implement getJWTCustomClaims() method.
         return [];
     }


     public function getJWTIdentifier()
     {
         // TODO: Implement getJWTIdentifier() method.
         return $this->getKey();
     }
     /**
      * 创建用户
      *
      * @param array $array
      * @return |null
      * @throws \Exception
      */
     public static function createUser($array = [])
     {
         try {

             $student_id = self::create([
                 'collegename'=>$array['collegename'],
                 'password'=>$array['password']
             ]);
             //  $student_id=self::select('id')->where('account','=',$array['account']);
             //echo "student_id:" . $student_id;
             return $student_id ?
                 $student_id :
                 false;
         } catch (\Exception $e) {
             logError('添加用户失败!', [$e->getMessage()]);
             die($e->getMessage());
             return false;
         }
     }

     /**
      * 查询该工号是否已经注册
      * 返回该工号注册过的个数
      * @param $request
      * @return false
      */
     public static function checknumber($request)
     {
         $student_job_number = $request['collegename'];
         try{
             $count = self::select('collegename')
                 ->where('collegename',$student_job_number)
                 ->count();
             //echo "该账号存在个数：".$count;
             //echo "\n";
             return $count;
         }catch (\Exception $e) {
             logError("账号查询失败！", [$e->getMessage()]);
             return false;
         }
     }

     /**
      * 修改密码
      *
      * @param $account
      * @param $password
      * @return mixed
      */
     public static function updatepa ($collegename,$password){
         $res= Users::where('collegename',$collegename)->update([
             'password'=> $password  ,
         ]);
         return $res;

     }



}
