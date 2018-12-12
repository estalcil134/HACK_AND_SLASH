This is the folder for most of the user resources. These include browsing available tutorials, available challenges, and the site scoreboard which compares users to other users. 

---------- HOW user_homepage.php WORKS ----------
There is overhead at the top to check if the user is logged in and if the user is in the right homepage. If they are not in the right page or logged in, they are redirected to the correct page that deals with teir situation.

The logo for the user, the user's nav bar, and the footer for the page are loaded in from using PHP require statements and the main content for the non-admin user homepage are the three options: Tutorials, Challenges, and Scoreboard. The middle three images are linked to the correct locations and clickable.
View /resources/user_home/ for the CSS for this page.