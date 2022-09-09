$(function() {

    const { default: Axios } = require("axios");

    const axiosInstance = Axios.create({
        baseURL: '/try-out/'
    });

    const quizId = document.getElementById("quiz-id").value;
    var statusPengerjaan, seconds, section;

    axiosInstance.get(quizId+'/data').then((response)=>{
        seconds = response.data.time;
        section = response.data.section;
    });

    $("#btn-selesai-tryout").on("click",function(){
        Swal.fire({
        html: "Submit jawaban sekarang?<br>Jawaban yang telah disubmit tidak dapat dirubah",
        icon: 'warning',
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Submit',
        customClass: {
            content: 'text-left'
        }
        }).then((result) => {
        if (result.isConfirmed) {
            let token = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData();
            formData.append('_token', token);
            statusPengerjaan = 'submit';

            axiosInstance.post('/submit', formData, {
                headers: {'Content-Type': 'application/x-www-form-urlencoded' },
            }).then(response=>{
                // console.log(response);
                location.href = "/hasil-tryout/"+response.data.hasil;
            }).catch(error=>{
                Swal.fire({
                    icon: 'error',
                    text: error,
                });
            });
        }
        });
    });

    $("#btn-batal-tryout").on("click",function(){
        Swal.fire({
        html: "Batal mengerjakan tryout?<br>Seluruh jawaban tidak akan disimpan",
        icon: 'warning',
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak jadi',
        confirmButtonText: 'Ya, Batal',
        customClass: {
            content: 'text-left'
        }
        }).then((result) => {
        if (result.isConfirmed) {
            statusPengerjaan = 'batal';
            location.href = "/beranda";
        }
        });
    });

    // timer
    function timer() {
        var minutes = Math.round((seconds - 30)/60);
        var remainingSeconds = seconds % 60;
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }
        document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;
        if (seconds == 0 && section == 'mendengarkan') {
            clearInterval(countdownTimer);
            Swal.fire({
                title: 'Waktu pengerjaan habis',
                text: "Jawaban Anda akan otomatis tersubmit",
                icon: 'warning',
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    let token = $('meta[name="csrf-token"]').attr('content');
                    var formData = new FormData();
                    formData.append('_token', token);
                    statusPengerjaan = 'submit';

                    axiosInstance.post('/submit', formData, {
                        headers: {'Content-Type': 'application/x-www-form-urlencoded' },
                    }).then(response=>{
                        location.href = "/hasil-tryout/"+response.data.hasil;
                    }).catch(error=>{
                        Swal.fire({
                            icon: 'error',
                            text: error,
                        });
                    });
                }
            })
        } else if (seconds == 0) {
            axiosInstance.get('/perbarui-data/'+quizId, {
                params: {
                    tipe:'update',
                    sisa_waktu:seconds
                }
            }).then(response=>{
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                location.replace('/try-out?session='+urlParams.get('session'));
            });
        } else {
            seconds--;
        }
    }
    countdownTimer = setInterval(timer, 1000);
    $('.pagination').show();

    // check tab
    window.addEventListener('beforeunload', function (e) {
        if (statusPengerjaan == 'batal' || statusPengerjaan == 'submit') {
            axiosInstance.get('/perbarui-data/'+quizId, {
                params: {
                    tipe:'delete'
                }
            });
        } else {
            axiosInstance.get('/perbarui-data/'+quizId, {
                params: {
                    tipe:'update',
                    sisa_waktu:seconds
                }
            });
        }
    });

    // save answer in session
    $(".answer-option").on("click",function(){
        let token = $('meta[name="csrf-token"]').attr('content');
        let questionId = $(this).data('question-id');
        let id = $(this).data('id');
        let no = this.dataset.no;
        let answer = $(this).val();

        var formData = new FormData();
        formData.append('_token', token);
        formData.append('question_id', questionId);
        formData.append('question_no', no);
        formData.append('option_id', id);
        formData.append('option', answer);

        axiosInstance.post('/simpan-jawaban/'+quizId, formData, {
            headers: {'Content-Type': 'application/x-www-form-urlencoded' },
        });

    });

});
