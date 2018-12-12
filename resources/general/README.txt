This is the folder for generalized CSS, javascript, and php for most of our pages.
They are here because they are used at least twice in two different pages.

This also contains code and JavaScript files for our footer, navbar, logo, etc. This allows us to copy and paste what will be common in all pages and concentrate more on back end. 

connect.php is used for connecting to the database using a PDO object called $connected

cookies_enabled.js is used to check if cookies are enabled

delete.php is used to delete a chalenge or tutorial that is specified from the challenge_deletion_page.php or tutorial_deletion_page.php

deletion_page.css is a style sheet used by both tutorial_deletion_page.php and challenge_deletion_page.php

general_content.css is the general style sheet for the entire site that includes the css for the .html files in this folder and renders the background and logo for the website.

LOGO.png is our website logo

logo_admin.html is the top most header for admins
logo_user.html is the top most header for users

navbar_admin.html is the navbar for admin required pages, aka tutorial creation, tutorial deletion, challenge creation, and challenge deletion

navbar_user.html is the navbar for all userpages which only contains links to tutorials, challenges, and scoreboard. If the user is an admin, the links also includes a link to the meta tutorial.

logout.php is the php file that destroys and unsets the session and cookie for users to logout and redirects to the login page.

start.php is the php file that checks if a user is already logged in. If they aren't, they are redirected to the login page.

upload.php is used to upload a challenge from the challenge_creation_page.php