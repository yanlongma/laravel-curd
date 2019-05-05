@extends('common.layouts')

@section('content')

    @include('common.message')

    <form class="form-inline" role="form">
        <div class="form-group">
            <label class="sr-only" for="student-name">name</label>
            <input name="Student[name]" value="{{ Request('Student')['name'] }}" type="text"
                   class="form-control" id="student-name" placeholder="请输入查找的姓名">
        </div>
        <div class="form-group">
            <label class="sr-only" for="student-age">age</label>
            <input name="Student[age]" value="{{ Request('Student')['age'] }}"  type="text"
                   class="form-control" id="student-age" placeholder="请输入查找的年龄">
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>

    <br>

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <td>{{ $student->sex($student->sex) }}</td>
                    <td>{{ date('Y-m-d', $student->created_at) }}</td>
                    <td>
                        <a href="{{ url('student/detail', ['id' => $student->id]) }}">详情</a>
                        <a href="{{ url('student/update', ['id' => $student->id]) }}">修改</a>
                        <a href="{{ url('student/delete', ['id' => $student->id]) }}"
                                onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 分页  -->
    <div>
        <div class="pull-right">
            {{ $students->appends(Request::input())->render() }}
        </div>

    </div>
@stop