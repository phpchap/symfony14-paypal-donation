$(document).ready(function() {
    var div_id_map = [ ];
    div_id_map['policy.html'] = 'policy_panel';
    div_id_map['terms.html'] = 'terms_panel';
    div_id_map['contactpop.html'] = 'contact_panel';

    $('#footer li a').click(function(e) {  
        e.preventDefault();
        e.stopPropagation();

        var the_id = div_id_map[$(this).attr('href')];

        var popup = $('<div />', { id: the_id }).appendTo($('body'));
        
        popup.bPopup({ loadUrl : $(this).attr('href') });
      
    });
});

