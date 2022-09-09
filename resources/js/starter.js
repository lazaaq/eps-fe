$(function() {
    const { default: Axios } = require("axios");

    Axios.get('/notif').then((response)=>{
        let label = "<span class='badge badge-warning right'>"+response.data.keranjang+"</span>";
        $("#jumlah-item-keranjang").text(response.data.keranjang + " item");
        if (response.data.keranjang > 0) {
            $("#sb-keranjang").append(label);
        }
    });

});
