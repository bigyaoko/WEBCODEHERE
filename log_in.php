<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <title>HZNU教务系统登录</title>
    <link rel="shortcut icon" href="#" />
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
  </head>
  <body>
  	<?php 
  	require_once ('connectvars.php');

    $error_msg = "";
    if(isset($_POST['submit']))
    {

      $dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      mysqli_query($dbc,'set names utf8');

      //抓取用户账号数据
      $user_userid = mysqli_real_escape_string($dbc,trim($_POST['userid']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
      if(!empty($user_userid) && !empty($user_password))
      {
        if($_POST['choice']=='option_std')
        {
          $query="
         SELECT id FROM students WHERE id='$user_userid'
          AND password = '$user_password'
          ";
        }
        else if($_POST['choice']=='option_admin')
        {
          $query="
          SELECT id FROM manager WHERE id='$user_userid'
          AND password = '$user_password'
          ";
        }
        else if($_POST['choice']=='option_tea')
        {
          $query="
          SELECT id FROM teacher WHERE id='$user_userid'
          AND password = '$user_password'
          ";
        }

         
         $data=mysqli_query($dbc,$query);
         $row=mysqli_fetch_array($data);
        
         if(mysqli_num_rows($data) >= 1)
         {
          if($_POST['choice']=='option_std')
          {
            $home_url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/student_page.php';
            header('Location:'.$home_url);
          }
         	else if($_POST['choice'] == 'option_admin')
          {
            $home_url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin_page.php';
            header('Location:'.$home_url);
          }
          else if($_POST['choice'] == 'option_tea')
          {
            $home_url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/teacher_page.php';
            header('Location:'.$home_url);
          }
         }
         else
         {
         	$error_msg='账号或密码不正确';
         	echo '<p class="error">' . $error_msg . '</p>';
         }

      }
      else
      {
      	$error_msg='请输入账号密码';
      	echo '<p class="error">' . $error_msg . '</p>';
      }
      mysqli_close($dbc);
    }
    
?>
    <header class="logo" role="banner">
      <img id="big_title" src="images/big_title.png" alt="title" class="img-responsive">

    </header><!-- /header -->
    <section class="content" role="main">
      <form enctype="multipart/form-data" id="sso" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>
        " method="post">
        <fieldset>
           <img id="hznu_logo" src="images/hznu.jpg" alt="HZNU" class="img-responsive">
          <legend class="text-primary">欢迎进入HZNU教务系统!</legend>
          <select name="choice" class="form-control">
            <option value="option_std">学生</option>
            <option value="option_tea">教师</option>
            <option value="option_admin">管理员</option>
          </select>
          <label for="userid"><span hidden="">HZNU ID</span>
            <input  type="text" name="userid" value="" placeholder="登录账号">
          </label>
          <label for="password"><span hidden="">HZNU ID密码</span>
            <input type="password" name="password" value="" placeholder="登录密码">
          </label>
         
          
        </fieldset>
        <div class="row">
          <input type="submit" name="submit" value="LOG IN" id="submit_log_in">
        </div>
      </form>
    </section>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>