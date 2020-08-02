var $collectionHolder;

var $addImageButton = $('<button type="button" class="add_image_link btn-success btn">Ajouter une Image</button>');
var $newLinkLi = $('<li class="col-8"></li>').append($addImageButton);

jQuery(document).ready(function () {
    $collectionHolder = $('ul.images');

    $collectionHolder.find('li').each(function () {
        addImageFormDeleteLink($(this));
    })

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find('input').length);

    $addImageButton.on('click', function (e) {
        addImageForm($collectionHolder, $newLinkLi);
    });
});

function addImageForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    addImageFormDeleteLink($newFormLi);
}
function addImageFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button" class="col-4 btn btn-danger">X</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        $tagFormLi.remove();
    });
}
