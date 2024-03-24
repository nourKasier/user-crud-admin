$(document).on("click", ".edit-button", function (event) {
    event.preventDefault();
    var userId = $(this).data("id");
    window.location.href = "/users/" + userId + "/edit";
});
$(document).on("click", ".delete-button", function (event) {
    event.preventDefault();
    var userId = $(this).data("id");
    var token = $(this).data("token");
    var table = $("#users-table").DataTable();
    if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
            type: "DELETE",
            url: "/users/" + userId,
            headers: {
                "X-CSRF-TOKEN": token,
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.message);
                    table
                        .row("#" + userId)
                        .remove()
                        .draw(false);
                } else {
                    console.error(response.message);
                }
            },
            error: function () {
                console.error("Error deleting user");
            },
        });
    }
});
