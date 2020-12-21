<?php
/**
 * Created by PhpStorm.
 * User: Ferre
 * Date: 2020/10/28
 * Time: 11:22
 */

class PublicServe
{
    const VERSION = '1.0';
    const SET_DATE = '2020-10-01';

    /**
     * 拼凑富文本编辑器文件的完整文件路径
     * 业务场景：常用对app返回ueditor等富文本上传的图片、文件的url拼凑
     * @Author: Ferre
     * @create: 2020/10/28 11:48
     * @param $data 提供的数据
     * @param $supply_url 当前的正确URL 如：Yii::$app->request->hostInfo
     * @param $replace_dir 需要替换的目录 如： /files/
     * @return mixed
     */
    public static function supplyCompleteImg($data, $supply_url, $replace_dir)
    {
        $data = str_replace($replace_dir, $supply_url . $replace_dir, $data);
        return $data;
    }

    public static function issetSearch($search_data, $str)
    {
        if (strstr($str, ',')){
            $arr_str = explode(',', $str);
        }else{
            $arr_str = [$str];
        }

    }

    //TODO 多isset - html去除 - curl - 正则替换（特殊替换及通用替换） - 指定天数时间戳 or 特殊年月周时间戳获取 - ... GET POST 一键变化
}
