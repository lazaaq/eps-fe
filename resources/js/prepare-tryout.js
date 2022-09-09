$(function() {
    const { default: Axios } = require("axios");

    const axiosInstance = Axios.create({
        baseURL: '/try-out/'
    });

    $(".btn-mulai-tryout").on("click",function (e) {
        e.preventDefault();

        let token = $('meta[name="csrf-token"]').attr('content');
        let kuis = $(this).data('kuis-id');

        var formData = new FormData();
        formData.append('_token', token);
        formData.append('kuis', kuis);

        axiosInstance.post('/cek-user', formData, {
            headers: {'Content-Type': 'application/x-www-form-urlencoded' },
        }).then(response =>{
            if (response.data.cek == false || response.data.id == kuis) {
                if (response.data.id == kuis) {
                    let url = $(this).attr('href');
                    window.location = url;
                } else {
                    Swal.fire({
                        html: "1. Pastikan koneksi internet stabil.<br>2. Gunakan browser Google Chrome versi terbaru.<br>3. Pastikan tidak ada aktivitas login ke akun anda (pada perangkat lain) saat sedang mengerjakan tryout.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Mulai',
                        customClass: {
                            content: 'text-left'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = $(this).attr('href');
                            window.location = url;
                        }
                    });
                }
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak dapat mengerjakan tryout',
                    text: 'Saat ini Anda sedang mengerjakan '+response.data.kuis.title
                });
            }
        }).catch(response =>{
            Swal.fire({
                icon: 'error',
                text: response,
            });
        });
    });

});
