# XSS Attack Example

OWASP mutillidae II

WebServer creates a socket on PORT:6003
WebServer is implemented with PHP.
It listens socket and gets info from vulnarable blog. Displays other users' cookies 
on a webpage.

TCPServer creates a socket on PORT:6000
TCPServer is implemented with JAVA.
It does same thing with WebServer except instead of displaying info on a webpage, it stores them in a text file.


JavaScript Code is a blog entry that sends users info to the servers.
