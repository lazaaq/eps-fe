$(function() {
    const { default: Axios } = require("axios");

    $(document).on('click','.btn-delete-paket',function(){
        let token = $('meta[name="csrf-token"]').attr('content');
        let paket = $(this).data('paket');
        var formData = new FormData();
        formData.append('_token', token);
        formData.append('paket', paket);
        Axios.post('/keranjang/hapus-paket', formData, {
            headers: {'Content-Type': 'application/x-www-form-urlencoded' },
        }).then(function(response){
            $("#component-keranjang").empty();
            $("#component-keranjang").html(response.data.view);

            $("#jumlah-item-keranjang").text(response.data.jumlahItem + " item");
            if (response.data.jumlahItem > 0) {
                $("#sb-keranjang").find("span").text(response.data.jumlahItem);
            } else {
                $("#sb-keranjang").find("span").empty();
            }
        });
    });

});
