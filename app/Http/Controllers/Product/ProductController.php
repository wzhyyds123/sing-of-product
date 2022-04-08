<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Add;
use App\Http\Requests\Change;
use App\Http\Requests\Delete;
use App\Models\composer;
use App\Models\lyrics;
use App\Models\usersworks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * 表单填写添加 （前端传输数组字段为  lyrics composer   ）
     */

    public function addproduct(Add $request)
    {
        $cname =  auth('api')->user()->collegename;
        $work  =  $request['work'];
        $creativetime  = $request['creativetime'];
        $worktime  = $request['worktime'];
        $singer  = $request['singer'];
        $brief  = $request['brief'];
        $song  = $request['song'];
        $mp3  = $request['mp3'];
        $copyright  = $request['copyright'];
        $plphone  = $request['plphone'];
        $plname  = $request['plname'];
        $composer = $request['composer'];  //composer表曲作者数组
        $lyrics = $request['lyrics'];    // lyrics词作者数组

        $res1 = usersworks::add($cname,$work,$creativetime,$worktime,$singer,$brief,$song,$mp3,$copyright,$plphone,$plname);
        $res2 = composer::add($composer,$cname);
        $res3 = lyrics::add($lyrics,$cname);

        $data['res1']=$res1;
        $data['res2']=$res2;
        $data['res3']=$res3;
        return $data?   //判断
            json_success("添加成功",$data,200):
            json_fail("添加失败",null,100);
    }
    /**
     * 删除表
     */

    public function delete(Delete $request)
    {

        $id  =  $request['id'];
        $data = usersworks::deletee($id);

        return $data?   //判断
            json_success("删除成功",$data,200):
            json_fail("删除失败",null,100);
    }
    /**
     * 表单填写修改 （前端传输数组字段为  lyrics composer   ）
     */

    public function change(Change $request)
    {
        $cname =  auth('api')->user()->collegename;
        $work  =  $request['work'];
        $creativetime  = $request['creativetime'];
        $worktime  = $request['worktime'];
        $singer  = $request['singer'];
        $brief  = $request['brief'];
        $song  = $request['song'];
        $mp3  = $request['mp3'];
        $copyright  = $request['copyright'];
        $plphone  = $request['plphone'];
        $plname  = $request['plname'];
        $composer = $request['composer'];  //composer表曲作者数组
        $lyrics = $request['lyrics'];    // lyrics词作者数组

        $res1 = usersworks::change($cname,$work,$creativetime,$worktime,$singer,$brief,$song,$mp3,$copyright,$plphone,$plname);
        $res2 = composer::change($composer,$cname);
        $res3 = lyrics::change($lyrics,$cname);

        $data['res1']=$res1;
        $data['res2']=$res2;
        $data['res3']=$res3;
        return $data?   //判断
            json_success("修改成功",$data,200):
            json_fail("修改失败",null,100);
    }
    /**
     * 查看表
     */

    public function find()
    {
        $cname =  auth('api')->user()->collegename;
        $id =   DB::table('users_works')->where('cname',$cname)->value('id');

        $res1 = DB::table('users_works')->where('id',$id)->get();
        $res2 = DB::table('composer')->where('users_works_id',$id)->get();
        $res3 = DB::table('lyrics')->where('users_works_id',$id)->get();
        $data['res1']=$res1;
        $data['res2']=$res2;
        $data['res3']=$res3;
        return $data?   //判断
            json_success("查询成功",$data,200):
            json_fail("查询失败",null,100);
    }

}
