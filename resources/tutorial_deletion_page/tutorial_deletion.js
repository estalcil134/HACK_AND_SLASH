//getting all the delete buttons on page to delete from page
function deleteTutorial() {
    let deleteButtons = document.querySelectorAll('.delete-button');

    for (let i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function(event) {
            event.preventDefault();

            let choice = confirm("Are you sure to delete this tutorial?");

            if (choice) { //will delete tutorial from server and remove div if confirm is "yes"
                /* Wait for tutorials to be in server
                $.ajax({
                    url: "delete.php",
                    data: {'file': "<?php echo dirname(__FILE__) . '/tutorials/'?>" + "file_name"}, //add input variable or array for filename?
                    success: function () {
                        alert("Tutorial deleted!");
                        deleteButtons[i].closest('.tutorial').remove();
                    },
                    error: function () {
                        alert("Tutorial could not be deleted!");
                    }
                });
                */
                deleteButtons[i].closest('.tutorial').remove();
            }
        });
    }
}
