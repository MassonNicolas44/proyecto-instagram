var url = 'http://proyecto-instagram.com';
window.addEventListener("load", function () {

    //Mano al pasar por el objeto
	$('.btn-like').css('cursor', 'pointer');
    $('.btn-disike').css('cursor', 'pointer');

    // Botón de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url + '/img/corazonRojo.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Like a la publicacion');
                    } else {
                        console.log('Error al dar like a la publicacion');
                    }
                }
            });
            dislike();
        });
    }
    like();

    // Botón de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + '/img/corazonNegro.png');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('disLike a la publicacion');
                    } else {
                        console.log('Error al dar disLike a la publicacion');
                    }
                }
            });
            like();
        });
    }
    dislike();

});