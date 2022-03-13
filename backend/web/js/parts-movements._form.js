$(function () {
  console.log('ready');
  $('input[name="PartsMovement[moved_at]"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: false,
    minYear: 2021,
    maxYear: parseInt(moment().format('YYYY'), 10),
    timePicker: true,
    timePicker24Hour: true,
    locale: {
      format: 'MM/DD/YYYY HH:mm'
    }
  }, function (start, end, label) {
    var years = moment().diff(start, 'years');
    // alert("You are " + years + " years old!");
  });
});
