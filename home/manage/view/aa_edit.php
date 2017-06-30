<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>
        <?php if (strcmp($method, 'new') == 0) echo '新建' . $cn[$t]; else echo '修改' . $cn[$t]; ?>
    </title>
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
                <li role="presentation" <?php if (strcmp($t, 'articles') == 0) echo 'class="active"'; ?>><a
                        href="./index.php?method=new&t=articles">文章</a></li>
                <li role="presentation" <?php if (strcmp($t, 'activities') == 0) echo 'class="active"'; ?>><a
                        href="./index.php?method=new&t=activities">活动</a></li>
                <li role="presentation"><a href="./index.php?method=new&t=people">成员</a></li>
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
                    echo '新建';
                elseif (strcmp($method, 'edit') == 0)
                    echo '修改';
                echo $cn[$t];
                ?>
            </label>
        </div>


        <div class="panel-body">
            <form method="post"
                  action="./model/subaa.php?method=<?php echo $method . '&type=' . $t;
                  if (isset($id)) echo '&id=' . $id; ?>">
                <div class="form-group">
                    <label><?php echo $cn[$t]; ?>标题</label>
                    <input type="text" class="form-control" value="<?php if (isset($id)) echo $title; ?>" name="title"
                           placeholder="标题"/>
                    <label>作者</label>
                    <input type="text" class="form-control" value="<?php if (isset($id)) echo $author; ?>" name="author"
                           placeholder="标题"/>

                </div>
                <div class="form-group">
                    <label>分类</label>
                    <select class="form-control" value="<?php if (isset($id)) echo $classify; ?>" name="classify">
                        <?php foreach ($class_set as $value) {
                            echo "<option value={$value['name']}>{$value['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo $cn[$t]; ?>内容</label>
                    <textarea name="mycontent" id="myeditor" style="width:100%;height:250px"></textarea>
                    <input type="hidden" id="mdtext" name="mdtext" />
                </div>
                <div class="pull-right">
                    <label for="ismd">markdown语法</label>
                    <input type="checkbox" id="ismd" name="md" value="yes">
                    <button type="submit" id="confirm" class="btn btn-primary">确定</button>
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
<script src="./Ueditor/ueditor.config.js"></script>
<script src="./Ueditor/ueditor.all.min.js"></script>
<script src="./Ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    var ue = UE.getEditor('myeditor');
    ue.addListener("ready", function() {
        <?php
            if(isset($id))
                echo "ue.setContent('".htmlentities($content)."');";
        ?>
    });
</script>
<script src="./js/init.js"></script>
</body>
</html>