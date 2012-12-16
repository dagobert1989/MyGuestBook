<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>留言板</title>
 </head>
<body>
    <p>请选择要删除的留言。</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">

<?php
  error_reporting(E_ALL & ~E_NOTICE); 
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('Error connecting to MySQL server.');
  mysqli_set_charset($dbc,'utf8');
  
    // Delete the customer rows (only if the form has been submitted)
  if (isset($_POST['submit'])) {
    foreach ($_POST['todelete'] as $delete_id) {
      $query = "DELETE FROM list WHERE id = $delete_id";
      mysqli_query($dbc, $query)
        or die('Error querying database.');
    } 

    echo '留言已删除.<br />';
  }
  
  // Display the customer rows with checkboxes for deleting
  $query = "SELECT * FROM list";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
    echo $row['name'];
    echo ' ' . $row['email'];
    echo ' ' . $row['qq'];
    echo ' ' . $row['liuyan'];
    echo '<br />';
  }

  mysqli_close($dbc);

?>
  <input type="submit" name="submit" value="Remove" />
  </form>

</body>
</html>
