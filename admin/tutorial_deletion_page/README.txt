This is the tutorial deletion page.
In it, we always check if the user is an admin first before proceeding.
After requiring the navbar elements for the admin, a list of all the tutorials the current admin user created will be displayed with a corresponding DELETE button that will submit the desired tutorial to delete to a delete.php page containing code to update all the tutorial bitstrings for all the users, remove the tutorial files, and remove the tutorial entry from the "tutorials" table. Note that all the buttons are contained in a single form tag.
If the admin has no tutorials left to delete, there is a no tutorial's left message displayed.

NOTE: When one of the input submit tags are clicked, the form executes a confirm to ask if the user truly wants to delete the challenge they selected. The users can cancel the deletion or go through with it.
Once again, the admin user can only delete tutorials that he/she has made and cannot delete another admin's tutorials.

Visit /resources/general/ for the CSS file called deletion_page.css, an external CSS that is also used by the challenge_deletion_page.php page.
Note that the delete.php this page uses is located in /resources/general/ folder.