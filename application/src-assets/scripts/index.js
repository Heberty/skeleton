import '../styles/index.scss';
import bigslide from 'bigslide';
import 'jquery-mask-plugin';

$(document).ready(function() {
    $('.menu-link').bigSlide({
    	menuWidth: '100%',
    	side: 'right'
    });
});

var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.sp_celphones').mask(SPMaskBehavior, spOptions);
