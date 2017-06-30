<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>HCI后台管理</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style type="text/css">
        .searcharticle {
            padding-right: 100px;
        }

        #mytab a:hover {
            color: white;
            background-color: #337ab7;
        }

        #logout {
            color: white;
            background-color: #337ab7;
        }

        .content {
            width: 80%;
            margin: 0 auto;
        }

        a:active {
            background: #337ab7;
        }
    </style>

<body>
<nav class="navbar navbar-default" role="navigation">      <!--导航条！-->
    <div class="container">

        <div class="navbar-header">
            <img src="./img/HCI.png" alt="HCI" width="100px" height="50px">
        </div>

        <div class="collapse navbar-collapse">

            <ul id="mytab" class="nav navbar-nav nav-pills" role="tablist">
                <li role="presentation" id="btn-cho" class="active"><a href="#">主页</a></li>
                <li role="presentation"><a href="./index.php?t=articles&method=new">文章</a></li>
                <li role="presentation"><a href="./index.php?t=activities&method=new">活动</a></li>
                <li role="presentation"><a href="./index.php?t=people&method=new">成员</a></li>
            </ul>

            <form class="navbar-form navbar-right" action="./model/logout.php" method="get">
                <div>
                    <label><?php echo $_SESSION["name"] . ",你好!"; ?></label>
                    <input type="submit" value="注销" class="btn btn-default"/>
                </div>
            </form>
        </div>

    </div>

</nav>
<div class="container">
    <div class="content">                      <!--已有博客文章版块！-->

        <div class="panel panel-default panel-primary">

            <div class="panel-heading">
                <form class="form-inline">
                    <label class="panel-title">文章列表</label>

                    <div class="form-group searcharticle pull-right">
                        <label for="exampleInputEmail1">
                            <small>搜索文章</small>
                        </label>
                        <input type="text" class="form-control"/>
                        <input type="submit" class="btn btn-default" value="搜索">
                    </div>
                </form>

            </div>

            <div class="panel-body">
                <?php $t = 'articles';
                require "aa_show.php"; ?>
            </div>

        </div>
    </div>

    <div class="content">           <!--已有活动模块！-->

        <div class="panel panel-default panel-primary">

            <div class="panel-heading">
                <form class="form-inline">
                    <label class="panel-title">已有活动</label>

                    <div class="form-group searcharticle pull-right">
                        <label for="exampleInputEmail1">
                            <small>搜索活动</small>
                        </label>
                        <input type="text" class="form-control"/>
                        <input type="submit" class="btn btn-default" value="查询">
                    </div>
                </form>

            </div>


            <div class="panel-body">
                <?php $t = 'activities';
                require "aa_show.php"; ?>
            </div>
        </div>
    </div>

    <div class="content">                      <!--已有hci成员模块！-->

        <div class="panel panel-default panel-primary">

            <div class="panel-heading">
                <form class="form-inline">
                    <label class="panel-title">HCI成员</label>

                    <div class="form-group searcharticle pull-right">
                        <label for="exampleInputEmail1">
                            <small>查询成员</small>
                        </label>
                        <input type="text" class="form-control"/>
                        <input type="submit" class="btn btn-default" value="查询"/>
                    </div>
                </form>

            </div>

            <div class="panel-body">
                <?php $t = 'people';
                require "people_show.php"; ?>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-default">
    <div class="container">

    </div>
</nav>
</body>
</html>