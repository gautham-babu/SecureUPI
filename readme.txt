FIRST Download

1. Install Xampp

4. Download the bank.rar

5. Extract the file and copy "bank" folder

6. Paste inside local disk C/xampp/htdocs

7. Open PHPMyAdmin (http://localhost/phpmyadmin)

8. Create a database with name mybank

6. Import mybank.sql file(given inside the zip package in SQL file folder)

7.Run the script http://localhost/bank



In case of errors:
1. Blocked Port (Port 80 or 443 in Use)
Solution:
Open XAMPP Control Panel and click on the Config button next to Apache, then open httpd.conf.
Find the line that says Listen 80 and change it to a different port number, such as Listen 8080.
Save the file and restart Apache.
open the httpd-ssl.conf file and changing the line Listen 443 to another port (e.g., Listen 444).


2. Disable World Wide Web Publishing Service (if PID 4 is related)
The World Wide Web Publishing Service is commonly associated with PID 4. Here’s how to disable it:

Press Win + R, type services.msc, and press Enter.
Scroll down and find World Wide Web Publishing Service or IIS.
Right-click on it and select Stop.
Also, right-click again, select Properties, and set Startup type to Disabled to prevent it from starting automatically in the future.

3. Allow Apache in windows firewall

4.If you changed the port to 8080, use the URL http://localhost:8080 in your browser, not just http://localhost.


