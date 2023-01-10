$('.favorito').on('click', function(e) {
    e.preventDefault();
    var $this = $(this),
    url = $this.data('url'),
    idPodcast = $this.data('id');

    this.assClass('disabled');
    $.post(url, {id: idPodcast})
    .done(function(respuesta) {
        if(respuesta.actualizado){
        $this.removeClass('disables')

        }

    })
    .fail(function() {
        $this.removeClass('disables')
    });
});