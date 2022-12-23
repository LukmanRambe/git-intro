$(document).ready(function() {
    //hilangkan tombol search
    $('#tombol-cari').hide();

    //event ketika keyword ditulis
    $('#keyword').on('keyup', function () {

            //munculkan icon loading
            $('.loader').show();

            // versi singkat
            // $('#container').load('ajax/students.php?keyword=' + $('#keyword').val());
            // versi lengkap gunakan function $.get()
            $.get('ajax/students.php?keyword=' + $('#keyword').val(), function (data) {
                    $('#container').html(data);
                    $('.loader').hide(); 
            });
    });

});