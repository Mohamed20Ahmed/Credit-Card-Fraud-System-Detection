# Credit-Card-Fraud-System-Detection
The credit card fraud detection application uses the user’s behavior and location to check for unusual patterns and to 
verify his/her identity. These patterns include the user’s characteristics such as his/her spending patterns as well as the 
usual geographic locations. If any unusual pattern is detected, the system requires re-verification or additional verification.
The application analyses the user’s credit card data for various characteristics. These characteristics include the user’s
country, the usual spending procedures, etc. Based upon previous data of that user the system recognizes unusual 
patterns in the payment procedure. So now the system may require the user to log in again, provide additional verification, 
or even block the user after more than 3 invalid attempts. Thus the core features include storing the previous transactions’
patterns for each user and calculating the user’s characteristics based on his/her spending pattern, country, and other 
features. If a deviation is detected (let’s say more than 20-30%) in a user’s transaction (from the standard pattern of
spending history, operating country, etc.), then the transaction is considered an invalid attempt and the system takes 
appropriate action(s).
