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

    /**
     * 对不存在的参数置空，避免CRM强类型错误notice
     * @Author: Ferre
     * @create: 2020/12/30 14:02
     * @param $search_data
     * @param $str
     * @return mixed
     */
    public static function issetSearch($search_data, $str)
    {
        if (strstr($str, ',')){
            $arr_str = explode(',', $str);
        }else{
            $arr_str = [$str];
        }
        foreach ($arr_str as $k => $v){
            if (!in_array($k, $search_data)){
                $search_data[$k] = '';
            }
        }
        return $search_data;
    }

    /**
     * 发送请求 GET OR POST (可带参数,GET拼接在URL中，post为第三个参数)
     * @Author: Ferre
     * @create: 2021/1/11 14:11
     * @param string $type
     * @param $url
     * @param string $arr
     * @return bool|false|string
     */
    public static function sendRequest($type = 'GET', $url, $arr = '')
    {
        if ($type == 'GET'){
            $data = file_get_contents($url);
        }elseif ($type == 'POST'){
            $data = self::curl_post($url, $arr);
        }
        return $data;
    }

    /**
     * CURL-POST 方法
     * @Author: Ferre
     * @create: 2021/1/11 14:04
     * @param $url
     * @param $data
     * @return bool|string
     */
    public static function curl_post($url, $data)
    {
        $url = str_replace(' ','+',$url);
        $ch  = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);  //定义超时3秒钟
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        //执行并获取url地址的内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        return $output;
    }

    //TODO 多isset - html去除 - curl - 正则替换（特殊替换及通用替换） - 指定天数时间戳 or 特殊年月周时间戳获取 - ... GET POST 一键变化
}
