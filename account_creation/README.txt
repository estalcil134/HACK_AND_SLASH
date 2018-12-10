This page is for people who do not have accounts and want to create one for use with the website. 

A session is started and then checked to see if a user is already logged in. If they are, they are brought to the appropriate homepage. Otherwise, the page will continue to load the form for signup. This page is only used to create normal user accounts. For admin accounts, please contact the site administrator to add your userid to the admin table.
The requirements for creating an account are:
 - A username that is no more than 20 characters long
 - A valid email
 - A password that is at least twelve characters long
 - The confirmation password matches.

We assume that an visitor has access to inspection tools and also check on the backend that the required information and constraints are followed.
If the user submitted the form, we first check if all required fields have a value, then proceed to checking if the two passwords inserted match each other, if the password is at least 12 characters long, if the email is a valid email, if the email is not already regitered with another username, if the username is at most 20 characters long, and if the username is not already in use.
After passing all those checks, the user's credentials are inserted into the "users" table in our database with a randomly generated salt along with their hashed password. The hashing algorithm is sha256

Upon successful registration, the user is brought back to the login page where they can login.

Visit /resources/account_creation/ for the JavaScript that also checks if the passwords match on the front end and for the CSS file.