<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>留言板</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
 </head>
<body>


<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = '首页';
  require_once('header.php');

  require_once('connectvars.php');

  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('Error connecting to MySQL server.');
  mysqli_set_charset($dbc,'utf8');

  $query = "SELECT * FROM list";
  $result = mysqli_query($dbc, $query)
    or die('Error querying database.');

  while($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $qq = $row['qq'];
        $liuyan = $row['liuyan'];
        
        if($name!=NULL) {
            echo '<p class="liuyan">';
            echo "姓名：".$name."<br />"."Email:".$email."<br />"."QQ:".$qq."<br />".'留言内容：'.$liuyan.'<br>';
            echo '</p>';
            echo "<br />"."<br />"."<br />";
        }
  }

  mysqli_close($dbc);
?>
    
<?php
  // Insert the page footer
  require_once('footer.php');
?>
</body>
</html>

