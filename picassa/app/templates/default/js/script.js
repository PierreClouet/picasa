$.fn.clickOff = function (callback, selfDestroy) {
    var clicked = false;
    var parent = this;
    var destroy = selfDestroy || true;

    parent.click(function () {
        clicked = true;
    });

    $(document).click(function (event) {
        if (!clicked) {
            callback(parent, event);
        }
        if (destroy) {
            //parent.clickOff = function() {};
            //parent.off("click");
            //$(document).off("click");
            //parent.off("clickOff");
        };
        clicked = false;
    });
};

$(document).ready(function(){
    var album = false;
    var photo = false;
    var album_clicked = false;
    var photo_clicked = false;
    $('#album_btn').click(function(){
        album = true;
        if(photo = true) {
            $('.ajout-photo').fadeOut(300);
            photo = false;
        }
        if(album_clicked == true){
            $('.ajout-album').fadeOut(300);
            album_clicked = false;
        }else{
            $('.ajout-album').fadeIn(300);
            album_clicked = true;
        }
    });

    $('#photo_btn').click(function(){
        if(album = true) {
            $('.ajout-album').fadeOut(300);
            album = false;
        }
        if(photo_clicked == true){
            $('.ajout-photo').fadeOut(300);
            photo_clicked = false;
        }else{
            $('.ajout-photo').fadeIn(300);
            photo_clicked = true;
        }
    });
    $('#photo_btn, .ajout-photo').clickOff(function() {
        $('.ajout-photo').fadeOut(300);
    });

    $('#album_btn, .ajout-album').clickOff(function() {
        $('.ajout-album').fadeOut(300);
    });

});


//drag'n'drop

$(function () {
    var startPos;
    $(".imgseparate").draggable({
        helper: "clone",
        containment: "fit",
        revert: "invalid",
    });
    $(".drag-zone, .imgs").droppable({
        drop: function (event, ui) {
            ui.draggable.detach().appendTo($(this));

          var idAlbum = $(this).attr("data-id");
          var idPhoto = ui.draggable.attr("data-id");
          console.log('/lier/'+idAlbum+"/"+idPhoto);

          $.ajax({
                type: "GET", // Le type de ma requete
                url: 'lier/ '+idAlbum+"/"+idPhoto, // L url vers laquelle la requete sera envoyee
                success: function (data, textStatus, jqXHR) {console.log('worked')},
                error: function (jqXHR, textStatus, errorThrown) {console.log('no workeded')},
            });
      }
  });
});

$(function(){

})

