$(document).ready(function() {
  $('#doi').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {doi: term, option: 1};
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#crop').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          crop: term,
          option: 3
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#model').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          model: term,
          option: 4,
          crop: $('#crop').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#climate').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          climate: term,
          option: 9,
          crop: $('#crop').val(),
          model: $('#model').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#baseline').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          baseline: term,
          option: 5,
          suboption: 1,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#period').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          period: term,
          option: 6,
          suboption: 1,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#scale').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          scale: term,
          option: 2,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#subcontinents').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          subcontinents: term,
          option: 8,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val(),
          scale: $('#scale').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#country').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          country: term,
          option: 7,
          crop: $('#crop').val(),
          model: $('#model').val(),
          climate: $('#climate').val(),
          baseline: $('#baseline').val(),
          period: $('#period').val(),
          scale: $('#scale').val(),
          country:$('#country').val()
        };
      },
      results: function(data, page) {
        return {results: data};
      }
    }
  });

  $('#adaptation').select2({
    ajax: {
      url: templatePath + "/options.php",
      dataType: 'json',
      data: function(term, page) {
        return {
          adaptation: term,
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
      results: function(data, page) {
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
      data: "submit=&scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#subcontinents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val() + "&option=" + 11,
      success: function(datos) {
        $('#results').append(datos);
        $("#resulttable").tablesorter({theme: 'green'});
      },
      complete: function() {
        $("#loading").fadeOut('slow');
//      $("#result").show();
      }
    });
    $('#results').show();
  });
  /*$("#downloaddata").click(function(){
   alert("funciona");
   //downloadwindow=window.open("agImpact_download.php","_blank");
   alert("funciona");
   $.ajax({
   url: "agImpact_download.php",
   type:"POST",
   data:"submit=&doi="+$('#doi').val()+"&scale="+$('#scale').val()+"&crop="+$('#crop').val()+"&model="+$('#model').val()+"&baseline="+$('#baseline').val()+"&period="+$('#period').val()+"&country="+$('#country').val()+"&subcontinents="+$('#subcontinents').val()+"&climate="+$('#climate').val()+"&adaptation="+$('#adaptation').val()+"&option="+11, 
   success: function(datos){
   $('#success').append(datos);
   
   }
   });
   });*/
});

function downloadData() {
  window.open(templatePath + "/agImpact_download.php?scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#subcontinents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val(), "_blank");
  window.close();
}

function downloadDataCSV() {
  window.open(templatePath + "/agImpact_downloadCSV.php?scale=" + $('#scale').val() + "&crop=" + $('#crop').val() + "&model=" + $('#model').val() + "&baseline=" + $('#baseline').val() + "&period=" + $('#period').val() + "&country=" + $('#country').val() + "&subcontinents=" + $('#subcontinents').val() + "&climate=" + $('#climate').val() + "&adaptation=" + $('#adaptation').val(), "_blank");
  window.close();
}