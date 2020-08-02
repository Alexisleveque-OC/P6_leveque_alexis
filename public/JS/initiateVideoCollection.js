var $collectionHolder;

var $addVideoButton = $('<button type="button" class="add_video_link btn-success btn">Ajouter une vidéo</button>');
var $newLinkLi = $('<li></li>').append($addVideoButton);

jQuery(document).ready(function() {
    $collectionHolder = $('ol.videos');

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find('input').length);

    $addVideoButton.on('click', function(e) {
        addVideoForm($collectionHolder, $newLinkLi);
    });
});
function addVideoForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}
