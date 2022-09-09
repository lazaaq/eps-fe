$(function() {
    const { default: Axios } = require("axios");

    $("#filter-paket").on("change", function(){
        let token = $('meta[name="csrf-token"]').attr('content');
        let topik = $(this).val();

        var formData = new FormData();
        formData.append('_token', token);
        formData.append('topik', topik);

        Axios.post('/beranda/filter', formData, {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function (response) {
            $("#component-list-paket").empty();
            $("#component-list-paket").html(response.data.view);
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                text: 'Galat',
            });
        });

    });

    $('#filter-paket').select2({
        allowClear: true,
        maximumSelectionLength: 2
    });
});
