<?php
$nick = "xianheroolz"; //user ID
$pass = "oauth:hk46xza9ye3hmjbjerod8bq86zybqa"; //password
$host = "irc.twitch.tv"; //host
$port = 6667; //port
$sock =@ fsockopen($host, $port); //open connection
$channel = ""; //channel
$message = ""; //channel

// when "send" was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!$sock) { //not connected
     printf("errno: %s, errstr: %s", $errno, $errstr);
  }
  else { //connected
     echo "Connected.";
     echo "<br><br>";
  }
  $channel = "#".test_input($_POST["Channel"]); // getting the text in that input field
  $message = test_input($_POST["Message"]); // getting the text in that input field

  fputs($sock,"PASS $pass\r\n"); // input password (has to be done first)
  fputs($sock,"NICK $nick\r\n"); // input user ID
  //while ($data = fgets($sock, 1024)) {
  //  echo nl2br($data);
  //  flush();
  // Separate all data
  //$exData = explode(' ', $data);
  //}
  fputs($sock,"JOIN $channel\r\n"); // join the channel
  while ($data = fgets($sock, 1024)) {
    echo nl2br($data);
    flush();
  // Separate all data
  $exData = explode(' ', $data);
  }
  fputs($sock, "PRIVMSG ". $channel . " :" . $message . " \n"); // send message

  //while ($data = fgets($sock, 1024)) {
  //  echo nl2br($data);
  //  flush();
  // Separate all data
  //$exData = explode(' ', $data);
  //}


  // Outputs here so that you are sure of what you did
  echo "Nick:" . $nick;
  echo "<br>";
  echo "Channel:" . $channel;
  echo "<br>";
  echo "Message:" . $message;
  echo "<br>";
  echo "message sent.";
}

//make sure the input is good
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<!--
This is the form that you are typing stuff in.
-->
<br><br>
<img src="cash.jpg" alt="Money" style="width:300px;height:300px;">
<h2><font face="impact"> Wassup young blood? </font></h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Channel: <input type="text" name="Channel" value="<?php echo $channel;?>">
   <br><br>
   Meesage: <input type="text" name="Message" value="<?php echo $message;?>">
   <br><br>
   <input type="submit" name="send" value="Send">
</form>
