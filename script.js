$(document).ready(function(){
  $('#selectAllBoxes').click(function(){
      var checkBoxes = $('.checkAllBoxes');
      checkBoxes.prop("checked", !checkBoxes.prop("checked"));
      $('.checkAction').toggle();
  });
});