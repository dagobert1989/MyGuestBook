<?php
  // Generate the navigation menu
  echo '<hr />';
  if (isset($_SESSION['username'])) {
    echo '<a href="index.php">首页</a> &#10084; ';
    echo '<a href="post.php">留言</a> &#10084; ';
    echo '<a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
  }
  else {
    echo '<a href="login.php">登录</a> &#10084; ';
    echo '<a href="signup.php">注册</a>';
  }
  echo '<hr />';
?>
