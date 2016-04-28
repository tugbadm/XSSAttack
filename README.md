# XSS Attack Example

OWASP mutillidae II


##Part I: Creating Php WebServer

WebServer creates a socket on PORT:6003
WebServer is implemented with PHP.
It listens socket and gets info from vulnarable blog. Displays other users' cookies 
on a webpage.

User A adds JavaScript/ws-script as blog entry. When user B views A's entries and B's cookie and sessionID info is send to A. A can display this info on table.html page. 

##Part II: Creating Java TCP Server

TCPServer creates a socket on PORT:6000
TCPServer is implemented with JAVA.
It does same thing with WebServer except instead of displaying info on a webpage, it stores them in a text file.


##Part III: Creating a worm.
User A adds JavaScript/worm-script as blog entry. When user B views A's entries that script is added to B's entries and B gets infected. A user C views B's entries and C gets infected either.
