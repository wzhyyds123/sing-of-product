<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\yjx\managerRequest1;
use App\Http\Requests\Requests\yjx\managerRequest2;
use App\Models\yjx\manager;
use App\Models\yjx\Users;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**yjx
     * 添加
     *
     * @param Request $request
     * @return false|\Illuminate\Http\JsonResponse
     *
     */
    public static function add(Request $request)
    {
        try {
            $collegename = $request['collegename'];
            $count = Users::checknumber($collegename);
            if ($count == 0) ;

            $registeredInfo = $request->except('password_confirmation');
            $registeredInfo['password'] = bcrypt($registeredInfo['password']);
            $registeredInfo['collegename'] = $registeredInfo['collegename'];
            $student_id = Users::createUser($registeredInfo);

            return  $student_id ?
                json_success('注册成功!',$student_id,200  ) :
                json_fail('注册失败!',null,100  ) ;


        } catch (\Exception $e) {
            logError("学校添加失败！", [$e->getMessage()]);
            return false;
        }
    }

    /**yjx
     * 修改学校名称
     * @param managerRequest1 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function modify(managerRequest1 $request){
        $collegename = $request['collegename'];
        $newcollegename = $request['newcollegename'];

        $res = manager::modify($collegename,$newcollegename);

        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);

    }

    /**yjx
     * 删除学校记录
     * @param managerRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function delete(managerRequest2 $request){
        $collegename = $request['collegename'];
        $res = manager::delete1($collegename);
        return $res ?
            json_success("操作成功", $res, 200) :
            json_fail("操作失败", $res, 100);

    }

    /**yjx
     * 展示所有学校
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall(){
        $res = manager::showall();
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);
    }

    /**yjx
     * 用名称查学校
     * @param managerRequest2 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(managerRequest2 $request){
        $collegename = $request['collegename'];
        $res = manager::show($collegename);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }

    /***yjx
     * 提交详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showxx(Request $request){
        $cname = $request['cname'];
        $res = manager::showxx($cname);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', $res, 100);

    }


}
