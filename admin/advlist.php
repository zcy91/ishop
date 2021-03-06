<?php
include '../conn.php';

 ?>
<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <meta name="description" content=""> -->
    <!-- <meta name="author" content=""> -->
    <!-- <link rel="icon" href="../../favicon.ico"> -->

    <title>广告管理</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="./css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="../js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->

  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">后台管理</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/admin/main.php">首页</a></li>
            <li><a href="/admin/goodslist.php">商品管理</a></li>
            <li><a href="/admin/userlist.php">用户管理</a></li>
            <li><a href="/admin/articlelist.php">文章管理</a></li>
            <li class="active"><a href="/admin/advlist.php">广告管理</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="/index.php">进入前台 <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>广告管理</h1>
        <p>这里是广告管理，你可以对广告进行增删改查的管理</p>
        <p>精彩购物，尽在聚宝盆商城！</p>
      </div>
<table class="table table-striped">
              <a href="addadv.php" class="btn btn-success">增加广告</a>
              <thead>
                <tr>
                  <th>id</th>
                  <th>名称</th>
                  <th>关键词</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
            <?php
            $sql = "SELECT * FROM adv";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // 输出每行数据
              while($row = $result->fetch_assoc()) {
                ?>

          <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["keywords"]; ?></td>
            <td>
              <a href="editadv.php?advid=<?php echo $row['id'];?>" class="btn btn-primary">编辑</a>
              <!-- 按钮触发模态框 -->
              <button  class="btn btn-danger" data-toggle="modal" onclick="deladv(<?php echo $row['id']?>)" data-target="#myModal">删除</button>
            </td>
          </tr>

                <?php

              }
            } else {
              echo "0 个结果";
            }
            $conn->close();
            ?>
          </tbody>
        </table>

        <!-- 模态框（Modal） -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">提示</h4>
                    </div>
                    <div class="modal-body">确认是否要删除？</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" id="del" class="btn btn-danger" >删除</button>
                        <script type="text/javascript">

                            function deladv(advid) {
                                $.post("/admin/deladv.php",{
                                  adid:advid,
                                },function(data,status){
                                  sleep(300);
                                  // if (data == 1) {
                                    alert('删除成功！');
                                  // }
                                  //休眠3秒
                                  sleep(300);
                                  //跳转商品列表
                                  location.href="/admin/advlist.php";

                                });
                            }
                            function sleep(n) { //n表示的毫秒数
                                   var start = new Date().getTime();
                                   while (true) if (new Date().getTime() - start > n) break;
                               }
                        </script>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->

    </div> <!-- /container -->



  </body>
</html>
