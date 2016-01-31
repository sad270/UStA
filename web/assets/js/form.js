$(document).ready(function() {

  function formGen($container, $label_name, $add, $faIcon, $del){

  var $addLink = $('<div id="add_' + $container + '" class="col-md-6 add-link-container"><a href="#" class="add-link btn btn-block btn-default"><span><span class="'
   +  $faIcon + '"></span> '+ $add +'</span></a></div>');

  $container = $('div#' + $container);
  $container.show();
  $container.after($addLink);
  var index = 0;

  // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
  $addLink.click(function(e) {
    index = addCat($container, $del, $label_name, index);
    e.preventDefault(); // évite qu'un # apparaisse dans l'URL
    return false;
  });

  // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
  if ($container.find(':input').length == 0) {
    index = addCat($container, $del, $label_name, index);
  } else {
    // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
    $container.children('div').each(function() {
    index = Math.max(index, $(this).children("label").text());
    $($(this).children("label").remove());
    addDeleteLink($(this), $del);
    $(this).wrap('<div class="col-md-6"></div>');
    $container.before($(this).parent());
    });
  }
  addButtonsHeight($container.next());
}

  // La fonction qui ajoute un formulaire Categorie
  function addCat($container, $del, $label_name,index) {
    index++ ;
    var $prototype = $($container.attr('data-prototype')
    .replace('<label class="control-label required">__name__label__</label>', "")
    .replace(/__name__/g, index)
    );

    // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
    addDeleteLink($prototype, $del);

    // On ajoute le prototype modifié à la fin de la balise <div>
    $container.before($prototype);
    $prototype.wrap('<div class="col-md-6"></div>');
  //  console.log($container.after());
    addButtonsHeight($container.next());
    return index;
  }

  // La fonction qui ajoute un lien de suppression d'une catégorie
  function addDeleteLink($container, $del) {
    // Création du lien
    $deleteLink = $('<a href="#" class="btn btn-danger btn-delete pull-right"><span class="fa fa-trash"></span> '+ $del +'</a>');

    // Ajout du lien
    $container.addClass("clearfix").append($deleteLink);

    // Ajout du listener sur le clic du lien
    $deleteLink.click(function(e) {
      if($container.parent().parent().children().length > 3){
        $container.parent().remove();
        addButtonsHeight($($container.parent().parent().children().last()));
      }
      else {
        alert("Attention ! Vous ne pouvez pas "  + $del +  ".")
      }
      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      return false;
    });
  }

  formGen('family_members', 'Membre N°', 'Ajouter un nouveau Membre','fa fa-user', 'Supprimer ce Membre');
  formGen('family_addresses', 'Adresse N°', 'Ajouter une nouvelle Adresse','fa fa-map-marker', 'Supprimer cette Adresse');
  formGen('family_phones', 'Téléphone N°', 'Ajouter un nouveau Téléphone','fa fa-phone', 'Supprimer ce Téléphone');
  formGen('family_emails', 'Email N°', 'Ajouter un nouvel Email','fa fa-envelope', 'Supprimer cet Email');
});
