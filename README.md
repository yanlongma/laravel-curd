## 一、简介：

一个 Laravel 5.3 表单实现 curd 快速入门教程（Demo）

[代码下载：https://github.com/yanlongma/laravel-curd](https://github.com/yanlongma/laravel-curd)

[原文链接：http://www.mayanlong.com/archives/2016/252.html](http://www.mayanlong.com/archives/2016/252.html)

Laravel 开发交流群（521295157），欢迎加入！

[ Laravel 系列视频教程：http://www.mayanlong.com/laravel.html](http://www.mayanlong.com/laravel.html)


## 二、安装：

#### 1. 连接数据库

修改 .env 配置文件

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

#### 2. 新建数据表

首先创建一个数据库 laravel，然后再创建数据表。

2.1 使用 Laravel 的迁移创建数据表

```
php artisan migrate
```

2.2 手动执行以下 SQL 创建数据表

```
DROP TABLE IF EXISTS students;

CREATE TABLE IF NOT EXISTS students(

	`id` INT AUTO_INCREMENT PRIMARY KEY ,
	`name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '姓名',
	`age` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄',
	`sex` TINYINT UNSIGNED NOT NULL DEFAULT 10 COMMENT '性别',	/* 10.未知 20.男 30.女 */

	`created_at` INT NOT NULL DEFAULT 0 COMMENT '新增时间',
	`updated_at` INT NOT NULL DEFAULT 0 COMMENT '修改时间'

)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='学生表';
```

#### 3. 访问

打开浏览器，输入你的项目地址，访问前请确认自己的地址，如下：

```
http://localhost:8888/laravel-curd/public/index.php
```

如果出现以下页面，则安装成功，您就可以开始 Laravel 的学习之旅啦！

![curd.png](http://www.mayanlong.com/usr/uploads/2016/09/1625446115.png)
