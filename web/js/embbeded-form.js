/**
 * Created by Elvis on 13/08/2015.
 */


var collectionHolder;

// setup an "add a tag" link
var addTagLink = $('<a href="#" class="btn btn-info">Añadir Tratamiento</a>');
var newLinkLi = $('<div class="col-md-7" ></div>').append(addTagLink);

jQuery(document).ready(function () {

    $('ol.tratamientos').sortable({
        change: function(evt,ui) {
            $(this).sortable('toArray');
        }
    });

    // Get the ul that holds the collection of tags
    collectionHolder = $('ol.tratamientos');

    // add a delete link to all of the existing tag form li elements
    collectionHolder.find('div.form-group').each(function () {
        addTagFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    collectionHolder.append(newLinkLi);
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    collectionHolder.data('index', collectionHolder.find(':input').length);
    addTagLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new tag form (see next code block)
        addTagForm(collectionHolder, newLinkLi);
    });
});
function addTagForm(collectionHolder, newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = collectionHolder.data('prototype');
    // get the new index
    var index = collectionHolder.data('index');
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace('<label for="appbundle_pastoview_tratamientos___name___nombre" class="required">Nombre</label>', '');
    newForm = newForm.replace('<label for="appbundle_pastoview_tratamientos___name___descripcion" class="required">Descripcion</label>', '');
    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/<div /g, '<div class="form-group input-group" ');
    newForm = newForm.replace('<input ', '<input class="form-control" ');


    // increase the index with one for the next item
    collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    var newFormLi = $('<li class="col-md-7"></li>').append(newForm);
    newLinkLi.before(newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink(newFormLi.children());

}

function addTagFormDeleteLink(tagFormLi) {
    var removeFormA = $('<a href="#" class="input-group-addon btn btn-danger"><i class="fa fa-trash-o"/></a>');
    tagFormLi.append(removeFormA);
    removeFormA.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // remove the li for the tag form
        tagFormLi.parent().remove();
    });
}

function addIdTratamiento(tagFormLi, index) {

    var p = '<span class="input-group-addon">' + (index + 1) + '</span>'
    var idTratamientoTag = $(p);
    tagFormLi.before(idTratamientoTag);
}
