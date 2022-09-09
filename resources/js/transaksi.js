$(function () {
    const { default: Axios } = require("axios");

    const axiosInstance = Axios.create({
        baseURL: '/transaksi'
    });

    $(".btn-batalkan").on("click", function () {
        var id_trans = $(this).attr("data-id");
        let token = $('meta[name="csrf-token"]').attr('content');

        var formData = new FormData();
        formData.append('_token', token);
        formData.append('id', id_trans);

        Swal.fire({
            // title: 'Anda yakin untuk membatalkan pembayaran?',
            text: "Anda yakin untuk membatalkan pembayaran?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Jangan batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                axiosInstance.post('/batal', formData, {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                }).then(function (response) {
                    // $("#component-index").empty();
                    // $("#component-index").html(response.data.view);
                    Swal.fire({
                        icon: 'success',
                        text: response.data.message,
                    }).then(function () {
                        location.reload();
                    });
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        text: error.response.data,
                    });
                });
            }
        })
    });

    $(".btn-konfirmasi").on("click", function () {
        var id_trans = $(this).attr("data-id");
        let token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            html:
                '<strong>Konfirmasi Pembayaran</strong><br>'+
                '<div class="alert alert-default-primary mt-3">'+
                    '<p class="text-justify mb-0" style="line-height: 23px;"> Dengan mengunggah bukti pembayaran, akan mempercepat konfirmasi admin.</p>'+
                '</div>',
            input: 'file',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:'Konfirmasi',
            cancelButtonText:'Kembali',
            onBeforeOpen: () => {
                $(".swal2-file").change(function () {
                    var reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                });
            }
        })
        .then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                var file = $('.swal2-file')[0].files[0];

                formData.append('_token', token);
                formData.append('id', id_trans);
                formData.append("bukti_pembayaran", file);

                if (file) {
                    axiosInstance.post('/unggah-bukti', formData, {
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    }).then(function (response) {
                        // $("#component-index").empty();
                        // $("#component-index").html(response.data.view);
                        Swal.fire({
                            icon: 'success',
                            text: response.data.message,
                        }).then(function () {
                            location.reload();
                        });
                    }).catch(error => {
                        Swal.fire({
                            icon: 'error',
                            text: error.response.data,
                        });
                    });
                } 
                else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Gagal, bukti pembayaran kosong.',
                    });
                }
            }
        });
    });

    $(".btn-unggah-ulang").on("click", function () {
        var id_trans = $(this).attr("data-id");
        let token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            html:
                '<strong>Unggah Ulang Konfirmasi Pembayaran</strong><br>' +
                '<div class="alert alert-default-primary mt-3">' +
                '<p class="text-justify mb-0" style="line-height: 23px;"> Dengan mengunggah bukti pembayaran, akan mempercepat konfirmasi admin.</p>' +
                '</div>',
            input: 'file',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'Kembali',
            onBeforeOpen: () => {
                $(".swal2-file").change(function () {
                    var reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                });
            }
        })
        .then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                var file = $('.swal2-file')[0].files[0];

                formData.append('_token', token);
                formData.append('id', id_trans);
                formData.append("bukti_pembayaran", file);

                if (file) {
                    axiosInstance.post('/unggah-bukti', formData, {
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    }).then(function (response) {
                        // $("#component-index").empty();
                        // $("#component-index").html(response.data.view);
                        Swal.fire({
                            icon: 'success',
                            text: response.data.message,
                        }).then(function () {
                            location.reload();
                        });
                    }).catch(error => {
                        Swal.fire({
                            icon: 'error',
                            text: error.response.data,
                        });
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Gagal, bukti pembayaran kosong.',
                    });
                }
            }
        });
    });

    $(".btn-lihat-bukti").on("click", function () {
        var buktiBayar = $(this).attr("data-img");
        Swal.fire({
            title: 'Bukti Pembayaran',
            imageUrl: buktiBayar,
            imageAlt: 'Custom image',
        })
    });
});