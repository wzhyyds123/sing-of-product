<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\yjx\registerRequest;
use App\Models\yjx\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * 注册
     * @param Request $registeredRequest
     * @return JsonResponse
     * @throws \Exception
     */
    public function registered (registerRequest $registeredRequest)
    {
        $count = Users::checknumber($registeredRequest);   //检测账号密码是否存在
        if($count == 0)
        {
            $student_id = Users::createUser(self::userHandle($registeredRequest));

            return  $student_id ?
                json_success('注册成功!',$student_id,200  ) :
                json_fail('注册失败!',null,100  ) ;
        }
        else{
            return
                json_success('注册失败!该工号已经注册过了！',null,100  ) ;
        }
    }

    /**
     * 登录
     * @param Request $request
     * @return JsonResponse
     */
    public function login(registerRequest $request)
    {
        $collegename=$request['collegename'];
       // $level=Users::where('account',$account)->value('level');
        $credentials = self::credentials($request);   //从前端获取账号密码


        $token = auth('api')->attempt($credentials);   //获取token
        $data['token']=$token;
        $data['collegename']=$collegename;

        return $token?
            json_success('登录成功!',$data,  200):
            json_fail('登录失败!账号或密码错误',null, 100 ) ;
        //       json_success('登录成功!',$this->respondWithToken($token,$user),  200);
    }

    /**
     * 封装token的返回方式
     */
    protected function respondWithToken($token, $msg)
    {
        // $data = Auth::user();
        return json_success( $msg, array(
            'token' => $token,
            //设置权限  'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ),200);
    }
    /**
     * 获取账号密码返回
     */
    protected function credentials($request)   //从前端获取账号密码
    {
        return ['collegename' => $request['collegename'], 'password' => $request['password']];
    }
    /**
     * 对密码进行哈希256加密
     */
    protected function userHandle($request)   //对密码进行哈希256加密
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['collegename'] = $registeredInfo['collegename'];
        //$registeredInfo['level'] = $request['level'];
        return $registeredInfo;
    }

    public static function userHandle111($password)   //对密码进行哈希256加密
    {
        $red = bcrypt($password);
        return $red;
    }
    /**
     * 修改密码
     */
    public function again(Request $registeredRequest)
    {
        $collegename     = $registeredRequest['collegename'];
        $newpassword = $registeredRequest['newpassword'];
//dd($newpassword);
        $password3 = self::userHandle111($newpassword);
        $red = DB::table('users')->where('collegename', '=', $collegename)->update([
            'password' => $password3
        ]);
        return $red ?
            json_success('修改成功!', $red, 200) :
            json_fail('修改失败!', null, 100);
    }



}
