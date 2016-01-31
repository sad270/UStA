$(document).ready(function(){

  // var members = new Bloodhound({
  //   datumTokenizer: Bloodhound.tokenizers.whitespace,
  //   queryTokenizer: Bloodhound.tokenizers.whitespace,
  //   remote: {
  //     url: Routing.generate('usta_search_searchAJAX', {firstname_lastname: ''}) + '/%QUERY',
  //     wildcard: '%QUERY',
  //   }
  // });
  // members.initialize();
  // $('.typeahead-member-search').typeahead({
  //   hint: true,
  //   highlight: true,
  //   minLength: 1
  // },
  // {
  //   source: members.ttAdapter()
  // });

  var members = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: Routing.generate('usta_search_searchAJAX', {firstname_lastname: ''}) + '/%QUERY',
      wildcard: '%QUERY',
    }
  });

  $('.typeahead-member-search').typeahead({
    hint: false,
    highlight: true,
    minLength: 1
}, {
    name: 'members',
    displayKey: "lastname",
    source: members,
    templates: {
      empty: '<div class="empty-message">Aucun résultat </div>',
      suggestion: function(data){
        console.log(data);
      return '<a href="' + Routing.generate('usta_family_view', {id:data.family}) + '"><strong>' + data.lastname + ' ' + data.firstname + '</strong> - ' + data.birthDate + ' - ' + data.family + '</a>';
      }
    }

  });
});
