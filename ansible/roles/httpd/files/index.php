<?php
$submit = $_GET['submit'];
$host   = $_GET['host'];
$ip     = $_SERVER['REMOTE_ADDR'];
$self   = $_SERVER['PHP_SELF'];
// form submitted ?
If ($submit == "traceroute wix.com")
{
      $host="wix.com";
      echo '<body bgcolor="#FFFFFF" text="#000000"></body>';
      echo("Trace Output:<br>");
      echo '<pre>';
      system ("traceroute -m 60 -n $host");
      echo '</pre>';
      echo 'done ...';
}
elseif ($submit == "show process list")
{
   // Create connection
   $conn = new mysqli("192.168.1.185", "example_user", "similarly-secure-password");
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   $sql = "SHOW PROCESSLIST";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      echo '<body bgcolor="#FFFFFF" text="#000000"></body>';
      echo ("Mysql ProcessList:");
      echo '<pre>';
      // output data of each row
      while($row = $result->fetch_assoc()) {
         printf("%s %s %s %s %s\n", $row["Id"], $row["Host"], $row["db"],
         $row["Command"], $row["Time"]);
         print "<br>";
       }
   }
   $conn->close();
}
else
{
    echo '<body bgcolor="#FFFFFF" text="#000000"></body>';
    echo '<p><font size="2">Your IP is: '.$ip.'</font></p>';
    echo '<form methode="post" action="'.$self.'">';
    echo '   <input type="submit" name="submit" value="traceroute wix.com"></input>';
    echo '   <input type="submit" name="submit" value="show process list""></input>';
    echo '</form>';
    echo '<br><b>'.$system.'</b>';
    echo '</body></html>';
}
?>
