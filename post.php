<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>留言板</title>
</head> 
<body>

<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = '留言';
  require_once('header.php');

  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">请<a href="login.php">登录</a></p>';
    exit();
  }

  // Show the navigation menu
  require_once('navmenu.php');
  
  error_reporting(E_ALL & ~E_NOTICE); 
  
  // 包含表单验证类
  require_once('validation.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('Error connecting to MySQL server.');
  mysqli_set_charset($dbc,'utf8');
  $output_form = true;

  
  if (isset($_POST['Submit'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $qq = $_POST['qq'];
  $liuyan = $_POST['liuyan'];
  $output_form = false;
  
  
  if(empty($name) || empty($email) || empty($qq) || empty($liuyan) ) {
   //if any is blank   
      echo '您有一项或多项未填写。<br />';
      $output_form = true;
  } else{
  $query = "INSERT INTO list(name,email,qq,liuyan)  VALUES ('$name', '$email', '$qq','$liuyan')";
  mysqli_query($dbc, $query)
    or die('Error querying database.');

  echo '您的留言提交成功!';
  
  $output_form = false;
  }

  mysqli_close($dbc);
  
  }

  if ($output_form) {
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name">姓名：</label>
    <input type="text" id="name" name="name"  value="<?php  echo $name ?>"/><br />
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php  echo $email ?>" /><br />
    <label for="qq">QQ:</label>
    <input type="text" id="qq" name="qq" value="<?php  echo $qq ?>" /><br />
    <label for="liuyan">留言:</label><br />
    <textarea id="liuyan" name="liuyan" rows="8" cols="60" ><?php echo $liuyan ?></textarea><br />
    <input type="submit" name="Submit" value="Submit" />
  </form>
    
<?php
  }
?>
<?php
  // Insert the page footer
  require_once('footer.php');
?>
</body>
</html>
