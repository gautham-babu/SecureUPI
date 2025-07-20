# SecureUPI : A Secure Banking Solution with AI-Powered Fraud Detection

## Overview
SecureUPI is a comprehensive banking system that leverages machine learning to detect and prevent fraudulent transactions. Built with security as a priority, this platform provides a user-friendly interface for everyday banking operations while offering robust protection through advanced fraud detection algorithms.

## Features
- User authentication and session management
- UPI fund transfers with PIN verification
- Transaction history and account statements
- Admin panel for user and staff management
- Feedback and notification system
- Machine learning-based fraud detection

## Technology Stack
- Frontend: HTML, CSS, Bootstrap, JavaScript
- Backend: PHP, MySQL
- Machine Learning: Python (scikit-learn)
- Data Analysis: NumPy, Pandas
- Model Deployment: Joblib

## Requirements
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Python 3.7 or higher
- Web server (Apache)
- Python libraries: scikit-learn, pandas, numpy, joblib

## Features
### For Users
- Secure login with session management
- Fund transfers using UPI system
- Account balance monitoring
- Transaction history and statements
- Profile management
- Feedback submission system
- Notification center for important updates
### For Administrators
- Comprehensive user management
- Account creation and modification
- Staff account management
- Transaction monitoring
- Feedback review system
- Notice broadcasting to users

## Machine Learning Fraud Detection
Transactions are evaluated using Python ML models for risk assessment. Suspicious transactions are flagged and blocked automatically.

---

## Installation Instructions & Troubleshooting

1. Install Xampp

4. Download the bank.rar

5. Extract the file and copy "bank" folder

6. Paste inside local disk C/xampp/htdocs

7. Open PHPMyAdmin (http://localhost/phpmyadmin)

8. Create a database with name mybank

6. Import mybank.sql file(given inside the zip package in SQL file folder)

7. Run the script http://localhost/bank



### In case of errors:
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

4. If you changed the port to 8080, use the URL http://localhost:8080 in your browser, not just http://localhost.
