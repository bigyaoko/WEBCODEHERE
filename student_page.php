 <?php 
 require_once ('connectvars.php');
 $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      mysqli_query($dbc,'set names utf8');
 $query="
         SELECT name,sex,position,direction,phone FROM teacher
          ";
 $data = mysqli_query($dbc, $query);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="css/std_page.css">
 	<title>学生端页面</title>
 </head>
 <body>
 	<form enctype="multipart/form-data" id="sso" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 		<legend class="text-primary">欢迎登录学生端！</legend>
 	<div class="info" role="main">
 		<table class="table table-bordered table-hover table-condensed">
 		<thead>
 			<tr>
 				<th>姓名</th>
 				<th>性别</th>
 				<th>职务</th>
 				<th>研究方向</th>
 				<th>联系方式</th>
 			</tr>
 		</thead>
 		<tbody>

 			<?php
 					while($row=mysqli_fetch_array($data))
 			        {
 				        echo '<tr><td>' . $row['name'] . '</td>';
 				        echo '<td>' . $row['sex'] . '</td>';
 				        echo '<td>' . $row['position'] . '</td>';
 				        echo '<td>' . $row['direction'] . '</td>';
 				        echo '<td>' . $row['phone'] . '</td></tr>';
 			        }		
 			?>
 		</tbody>
 	</table>
 	</div>
 	</form>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </body>
 </html>
