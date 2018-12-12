This is where users will go when they want to see their rank among other users for who is the best hacker on the site. It is accessible to registered users and admin users who want to view their rank, their score, and the top ten ranking users.

The page starts by requring the user's navbar(s), then proceeds to select a maximum of 10 users, ordered by the highest score first using the lexicographic ordering of usernames in cases where users have the same score. A table is then outputted displaying the rank number and the corresponding username based on that query.
Another prepare statement to select all usernames with their corresponding scores is then executed and a loop is used to find the rank of the current user before outputting the current user's score and closing the tags for the table.

NOTE: This page assumes that there will be at least one user, e.g. the user tha tis currently logged in.
Visit /resources/scoreboard/ for the CSS file