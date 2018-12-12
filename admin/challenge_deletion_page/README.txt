A page for admins to delete challenges that they have made that still exist.
After the overhead to ensure that the user is truly an admin and requiring the admin navbars, a form tag containing all the challenges that the admin has created that still exist along with a corresponding input submit button for each challenge are outputted. When the admin clicks the DELETE they are prompted about their decision before the deletion occurs from submitting the submit input tag to another PHP file that handles deletion by updating the challenge bitstring and scores of all users, removing the challenge entry from the "challenges" table, and finally deleting the files related to the challenges in some order.
If there are no more challenges the admin created, then a message will be displayed notifying the admin that there are no more challenges.

NOTE: When one of the input submit tags are clicked, the form executes a confirm to ask if the user truly wants to delete the challenge they selected. The users can cancel the deletion or go through with it.
Once again, the admin user can only delete challenges that he/she created and cannot delete challenges that other admin users have created.

Visit /resources/general/deletion_page.css for the CSS file. This CSS file is also used by the tutorial_deletion_page.php page.
Note that the delete file is in /resources/general/delete.php