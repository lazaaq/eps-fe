$(function() {
    const { default: Axios } = require("axios");

    const axiosInstance = Axios.create({
        baseURL: '/topik'
    });

    $(".btn-keranjang").on("click", function(){
        let token = $('meta[name="csrf-token"]').attr('content');
        let paket = $(this).data('paket-id');

        var formData = new FormData();
        formData.append('_token', token);
        formData.append('paket', paket);

        axiosInstance.post('/paket/simpan', formData, {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function (response) {
            $("#jumlah-item-keranjang").text(response.data.jumlahItem + " item");
            if (response.data.jumlahItem > 1) {
                $("#sb-keranjang").find("span").text(response.data.jumlahItem);
            } else {
                let label = "<span class='badge badge-warning right'>"+response.data.jumlahItem+"</span>";
                $("#sb-keranjang").append(label);
            }
            Swal.fire({
                icon: 'success',
                text: 'Paket berhasil ditambahkan pada keranjang',
            });
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                text: error.response.data,
            });
        });

    });
});
