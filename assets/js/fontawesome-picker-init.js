
jQuery(document).ready(function($) {
  'use strict';
  $('.fontawesome-icon-select').iconpicker({
    hideOnSelect: true,
    title: 'Clique no ícone desejado',
    icons: typeof icones != 'undefined' ?  $.merge(icones, $.iconpicker.defaultOptions.icons) : null,
        fullClassFormatter: function(val){
            if(val.match(/^fas-/)) return 'fas '+val;
            if(val.match(/^fab-/)) return 'fab '+val;
            if(val.match(/^fa-/)) return 'fa '+val;
            return val;
            
        },

    templates: {
        search: '<input type="search" class="form-control iconpicker-search" placeholder="Digite para filtrar" />'
    }
  });
}); // End Ready
