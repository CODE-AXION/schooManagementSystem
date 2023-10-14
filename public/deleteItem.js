export function deleteItem(entity, name, url, description = false) {
    swal.fire({
        title: "Delete " + entity,
        icon: 'question',
        text: description ? description : "Are You Sure You Want To Delete " + name + " !",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (confirmation) {
        if (confirmation.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content') ?? '{{csrf_token()}}';

            axios.delete(url, {
                data: {_token: CSRF_TOKEN}
            })
            .then(function (response) {
                var results = response.data;

                if (results.success === true) {
                    swal.fire("Done!", results.message, "success")
                        .then(function () {
                            // Refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        });
                } else {
                    swal.fire("Error!", results.message, "error");
                }
            })
            .catch(function (error) {
     
                if (error.response) {

                    swal.fire("Error!", error.response.data.message, "error");

                } else {
                    swal.fire("Error!","An error occurred.", "error");
                  
                }
            });
        }
    });
}

export function handleDeleteClick(event) {
    const { type, name, url } = event.currentTarget.dataset;
    deleteItem(type, name, url);
}