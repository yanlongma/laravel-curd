<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


/**
 * Student 控制器
 *
 * Class StudentController
 * @package App\Http\Controllers
 */
class StudentController extends Controller
{

    // 学生列表
    public function lists(Request $request)
    {

        $conditions = [' 1=1 '];
        $params = [];

        $search = $request->input('Student');
        if(!empty($search['name'])) {
            $conditions[] = ' name = :name ';
            $params[':name'] = $search['name'];
        }

        if(!empty($search['age'])) {
            $conditions[] = ' age = :age ';
            $params[':age'] = $search['age'];
        }

        //$students = Student::paginate(3);
        //$students = Student::where('age', '>', 11)->paginate(3);
        $students = Student::whereRaw(implode('and', $conditions), $params)->paginate(4);

        return view('student.lists', [
            'students' => $students,
        ]);
    }

    // 添加
    public function create(Request $request)
    {
        $student = new Student();

        if ($request->isMethod('POST')) {

            /* 以下是两种验证方式 */

            // 1. 控制器验证
            /*
            $this->validate($request, [
                'Student.name' => 'required|min:2|max:20|unique:students,name',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'unique' => ':attribute 不能重复',
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);
            */

            // 2. Validator类验证
            $validator = \Validator::make($request->input(), [
                'Student.name' => 'required|min:2|max:20|unique:students,name',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'unique' => ':attribute 不能重复',
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            // PHP 中打印错误信息
            // dd($validator->errors()->first());exit;
            // dd($validator->errors());exit;

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $data = $request->input('Student');

            // 使用批量赋值新增
            if (Student::create($data) ) {
                return redirect('student/lists')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('student.create', [
            'student' => $student
        ]);
    }

    // 保存添加
    public function save(Request $request)
    {
        $data = $request->input('Student');

        // 使用模型新增
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ($student->save()) {
            return redirect('student/lists');
        } else {
            return redirect()->back();
        }

    }


    // 修改
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'Student.name' => 'required|min:2|max:20|unique:students,name,' . $student->id,
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'unique' => ':attribute 不能重复',
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];

            if ($student->save()) {
                return redirect('student/lists')->with('success', '修改成功-' . $id);
            }
        }

        return view('student.update', [
            'student' => $student
        ]);
    }


    // 查看详情
    public function detail($id)
    {
        $student = Student::find($id);

        return view('student.detail', [
            'student' => $student
        ]);
    }

    // 删除
    public function delete($id)
    {

        $student = Student::find($id);

        if ($student->delete()) {
            return redirect('student/lists')->with('success', '删除成功-' . $id);
        } else {
            return redirect('student/lists')->with('error', '删除失败-' . $id);
        }
    }


}