$(document).ready(function(){
  var checkBoxes = $('.checkAllBoxes');
  
  $('#selectAllBoxes').click(function(){
      checkBoxes.prop("checked", !checkBoxes.prop("checked"));
  });

  $('.form-check-input').change(function() {
    if ($('.form-check-input').is(':checked')) {
      $('.checkAction').show();
    }else{
      $('.checkAction').hide();
    }
  });


});