$(function () {
  console.log('ready');

  if ($('#hexohm-nicename').val()) {
    console.log('Registered Hexohm');
  } else {
    console.log('New Hexohm');
  }

  $('#hexohm-nicename').change(function () {
    console.log('Change');
    if ($('#hexohm-nicename').val()) {
      toggleNewField('disabled');
    } else {
      toggleNewField('enabled');
    }
  })

  toggleNewField = function (status) {
    if (status == 'disabled') {
      disabled = true;
    } else {
      disabled = false;
    }
    $('#userparts-type').attr('disabled', disabled);
    $('#userparts-version').attr('disabled', disabled);
    $('#userparts-parts_code').attr('disabled', disabled);
  }
});