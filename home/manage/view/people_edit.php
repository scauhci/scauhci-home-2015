<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php if (strcmp($method, 'new') == 0) echo '添加'; else echo '修改'; ?>成员</title>
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

        #content {
            width: 80%;
            margin: 0 auto;
        }

        .imgbox {
            border: 2px solid #337ab7;
            width: 120px;
            height: 150px;

        }

        .box {
            width: 100%;
            height: 240px;
        }

        .pht {
            width: 18%;
            float: left;

        }

        .msg {
            width: 80%;
            float: left;
        }

        #upload {
            position: relative;
            left: 16px;
        }


    </style>

<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <img src="./img/HCI.png" alt="HCI" width="100px" height="50px">
        </div>

        <div class="collapse navbar-collapse">

            <ul id="mytab" class="nav navbar-nav nav-pills" role="tablist">
                <li role="presentation"><a href="./index.php">主页</a></li>
                <li role="presentation"><a href="./index.php?method=new&t=articles">文章</a></li>
                <li role="presentation"><a href="./index.php?method=new&t=activities">活动</a></li>
                <li role="presentation" class="active"><a href="./index.php?method=new&t=people">成员</a></li>
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

<div id="content" class="content">

    <div class="panel panel-default panel-primary">

        <div class="panel-heading">
            <label class="panel-title">
                <?php
                if (strcmp($method, 'new') == 0)
                    echo '添加';
                elseif (strcmp($method, 'edit') == 0)
                    echo '修改';
                echo $cn[$t];
                ?>
            </label>
        </div>


        <div class="panel-body">
            <form enctype="multipart/form-data" method="POST" action="./model/subpep.php?method=<?php echo $method;
            if (isset($id)) echo '&id=' . $id; ?>">

                <div class="box">

                    <!--图片上传!-->
                    <div class="pht">
                        <div class="imgbox">
                            <img src="<?php if (isset($id)) echo $img; ?>" id="l" class="img-thumbnail"/>
                        </div>

                        <input type="file" id="lll" style="width:75px;height:30px;opacity:0" display:none name="img"/>
                        <button type="button" class="btn btn-primary" id="upload">上传头像</button>

                    </div>

                    <div class="msg">
                        <div class="form-group">
                            <label>成员名字</label>
                            <input type="text" class="form-control" value="<?php if (isset($id)) echo $name; ?>"
                                   name="name"
                                   placeholder="名字"/>

                        </div>

                        <!--性别!-->
                        <div>
                            <label>性别</label>
                            <select class="form-control" value="<?php if (isset($id)) echo $sex; ?>" name="sex">
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>

                        <!--年级!-->
                        <div>
                            <label>年级：</label>
                            <select class="form-control" name="grade">
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                            </select>
                        </div>

                        <!--方向!-->
                        <div>
                            <label>方向</label>
                            <select class="form-control" value="<?php if (isset($id)) echo $aspect; ?>" name="aspect">
                                <option value="前端">前端</option>
                                <option value="后台">后台</option>
                                <option value="安卓">安卓</option>
                            </select>
                        </div>

                        <!--专业 -->
                        <div>
                            <label>专业</label>
                            <input type="text" class="form-control" value="<?php if (isset($id)) echo $major; ?>"
                                   name="major"
                                   placeholder="专业"/>
                        </div>
                    </div>
                </div>
                <!--成员简介!-->
                <div class="form-group">
                    <label>成员简介</label>
                    <textarea name="mycontent" id="myeditor" style="width:100%;height:250px"></textarea>
                    <input type="hidden" id="mdtext" name="mdtext" />
                </div>

                <div class="pull-right">
                    <label for="ismd">markdown语法</label>
                    <input type="checkbox" id="ismd" name="md" value="yes">
                    <button type="submit" class="btn btn-primary">确定</button>
                    <button type="button" id="clear" class="btn btn-primary">清空</button>
                </div>
            </form>

        </div>
    </div>
</div>


<nav class="navbar navbar-default">
    <div class="container">

    </div>
</nav>

<script type="text/javascript" charset="utf-8" src="./Ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="./Ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="./Ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="./js/init.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor('myeditor');
    ue.addListener("ready", function() {
        <?php
            if(isset($id))
                echo "ue.setContent('".htmlentities($content)."');";
        ?>
    });
    var lll = document.getElementById('lll');
    var l = document.getElementById('l');
    lll.onchange = function () {
        var url = window.URL.createObjectURL(lll.files[0]);
        l.src = url;
    };
    document.getElementById('upload').onclick = function () {
        document.getElementById('lll').click();
    }
</script>
</body>
</html>