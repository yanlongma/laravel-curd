<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Student 模型
 *
 * Class Student
 * @package App
 */
class Student extends Model
{

    // 性别
    const SEX_UN = 10;      //未知
    const SEX_BOY = 20;     //男
    const SEX_GIRL = 30;    //女


    // 指定表名
    protected $table = 'students';

    // 指定主键
    protected $primaryKey = 'id';

    // 允许批量赋值的字段
    protected $fillable = ['name', 'age', 'sex'];

    //不允许批量赋值的字段
    protected $guarded = [];

    // 自动维护时间戳
    public $timestamps = true;

    // 设置保存created_at、updated_at时获取的时间格式
    protected function getDateFormat()
    {
        return time();
    }

    // 设置select时的时间格式
    protected function asDateTime($value)
    {
        return $value;
    }


    // 处理性别
    public function sex($ind = null)
    {
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女',
        ];

        if ($ind !== null) {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }

        return $arr;
    }


}