
// Create a clone of the menu, right next to original.
$('.navbar').addClass('original').clone().insertAfter('.navbar').addClass('cloned').css('position','fixed').css('top','0').css('width','100%').css('margin-top','0').css('z-index','9999').removeClass('original').hide();

scrollIntervalID = setInterval(stickIt, 0);


function stickIt() {

  var orgElementPos = $('.original').offset();
  orgElementTop = orgElementPos.top;               

  if ($(window).scrollTop() >= (orgElementTop)) {
    // scrolled past the original position; now only show the cloned, sticky element.

    // Cloned element should always have same left position and width as original element.     
    orgElement = $('.original');
    coordsOrgElement = orgElement.offset();
    leftOrgElement = coordsOrgElement.left;  
    widthOrgElement = orgElement.css('width');

    $('.cloned').css('left',leftOrgElement+'px').css('position','fixed').css('top',0).css('width',widthOrgElement+'px').show();
    $('.original').css('visibility','visible');
  } else {
    // not scrolled past the menu; only show the original menu.
    $('.cloned').hide();
    $('.original').css('visibility','visible');
  }
}