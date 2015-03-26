$(document).ready(function() {
  $('#doi').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {doi: term, option: 1};
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#crop').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          crop: params.term,
          option: 3
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#model').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          model: params.term,
          option: 4,
          crop: $('#crop').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      },
      cache: true
    }
  });

  $('#climate').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          climate: params.term,
          option: 9,
          crop: $('#crop').val(),
          model: $('#model').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#baseline').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          baseline: params.term,
          option: 5,
          suboption: 1,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#period').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          period: params.term,
          option: 6,
          suboption: 1,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#scale').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          scale: params.term,
          option: 2,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#continents').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          continents: params.term,
          option: 8,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val(),
          scale: $('#scale').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#regions').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          region: params.term,
          option: 12,
          continent: $('#continents').val(),
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val(),
          scale: $('#scale').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#country').select2({
    placeholder: "Choose an option...",
    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          country: params.term,
          option: 7,
          region: $('#regions').val(),
          continent: $('#continents').val(),
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val(),
          scale: $('#scale').val(),
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#adaptation').select2({
    placeholder: "Choose an option...",
//    allowClear: true,
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(params) {
        return {
          adaptation: params.term,
          option: 10,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val(),
          scale: $('#scale').val(),
          subcontinents: $('#subcontinents').val(),
          country: $('#country').val()
        };
      },
      processResults: function(data, page) {
        return {results: data};
      }
    }
  });
  $("#search").click(function() {
    $("#loading").show();
    $('#results').empty();
    $.ajax({
      url: templatePath + "/options.php",
      type: "POST",
      data: "submit=&scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#continents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val() + "&option=" + 11,
      success: function(datos) {
        $('#results').append(datos);
//        $("#resulttable").tablesorter({theme: 'green'});
      },
      complete: function() {
        $("#loading").fadeOut('slow');
      }
    });
    $('#results').show();
  });
  $("#reset").on("click", function() {
    $('.js-data-ajax').val(null).trigger("change");
  });
});

function downloadData() {
  window.open(templatePath + "/agImpact_download.php?scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#continents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val(), "_blank");
  window.close();
}

function downloadDataCSV() {
  window.open(templatePath + "/agImpact_downloadCSV.php?scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#continents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val(), "_blank");
  window.close();
}

function viewAllFields() {
  window.open(templatePath + "/allFieldsTable.php?scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#continents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val()+"&custom=1", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=10, left=10, width=400, height=400");
//  window.close();
}

function viewAllFieldsh() {
  window.open(templateUrl + "/fullview/?scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#continents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val(), "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=10, left=10, width=400, height=400");
//  window.close();
}