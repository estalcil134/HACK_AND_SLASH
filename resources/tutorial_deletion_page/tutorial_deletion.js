//getting all the delete buttons on page to delete from page
let deleteButtons = document.querySelectorAll('.delete-button');

for (let i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', function(event) {
        event.preventDefault();

        let choice = confirm("Are you sure to delete this tutorial?");

        if (choice) { //will delete tutorial div if confirm is "yes"
            //Probably need a cookie function/tool to permanently delete a tutorial from page
            deleteButtons[i].closest('.tutorial').remove();
        }
    });
}