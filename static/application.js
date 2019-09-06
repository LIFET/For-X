$(function() {
  var lastXPosition, lastYPosition;

  $(document).mousemove(function(e){
    if(lastXPosition == e.clientX && lastYPosition == e.clientY) {
      return
    }

    lastXPosition = e.clientX
    lastYPosition = e.clientY

    console.log(e)
    var $width = ($(document).width())/255;
    var $height = ($(document).height())/255;
    var $pageX = parseInt(e.clientX / $width,10);
    var $pageY = parseInt(e.clientY / $height,10);
    var gradient = "linear-gradient(135deg, rgb(112, "+$pageX+", "+$pageY+"), rgb(255, "+$pageY+", "+$pageX+")"

    $(".mobile-device").css("background-image", gradient);

    console.log($pageX);
  });
});
(function() {


}).call(this);
