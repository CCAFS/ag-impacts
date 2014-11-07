function validDoi(doi) {
  $("#loading").show();
  clearForm();

  if (doi == '') {
    $("#doi").addClass("ag-state-error");
    $("#loading").fadeOut('slow');
//    $("#alert-div").addClass("pure-alert-error");
  } else {

    $.ajax({
      url: "./wp-content/themes/agimpacts/xmldoicreator.php",
      type: "POST",
      data: {doi: doi},
      success: function(result) {
        xmlDoiReader(result);
      },
      complete: function() {
        $("#loading").fadeOut('slow');
//      $("#result").show();
      }
    });
  }
}

function saveArticle(form) {
  $.ajax({
    url: "./wp-content/themes/agimpacts/saveArticle.php?"+form,
    type: "POST",
    success: function(result) {
      if(result == 1) {
        var n = noty({
          layout: 'top',
          type: 'success',
          timeout: 6000,
          text: 'Saved data'
        });
        $('#myform')[0].reset();
      } else {
//        alert(result);
        var n = noty({
          layout: 'top',
          type: 'error',
          timeout: 6000,
          text: 'Could not save data'
        });
      }
    },
    complete: function() {
      $("#loading").fadeOut('slow');
    }
  });
}

function categoryChosen(id, form, page) {
  page = page || 1;
  document.location.hash = "category=" + id + ((form) ? "/" + form : "");
  if (transport)
    transport.postMessage("category=" + id + ((form) ? "/" + form : ""));
  $.ajax({
    url: "result.php?" + form,
    type: "POST",
    data: {category: id, page: page},
    success: function(result) {
      $("#loading").show();
      $("#result").hide();
      $("#result").html(result);
    },
    complete: function() {
      $("#loading").fadeOut('slow');
      $("#result").show();
    }
  });
}

function xmlDoiReader(data) {
  if (window.DOMParser) {
    parser = new DOMParser();
    xmlDoc = parser.parseFromString(data, "text/xml");
  } else {// Internet Explorer
    xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
    xmlDoc.async = false;
    xmlDoc.loadXML(data);
  }

  if (xmlDoc.doctype == null) {
    if (xmlDoc.getElementsByTagName("title")[0])
      $("#title").val(xmlDoc.getElementsByTagName("title")[0].childNodes[0].nodeValue);
    if (xmlDoc.getElementsByTagName("year")[0])
      $("#year").val(xmlDoc.getElementsByTagName("year")[0].childNodes[0].nodeValue);
    if (xmlDoc.getElementsByTagName("volume")[0])
      $("#volume").val(xmlDoc.getElementsByTagName("volume")[0].childNodes[0].nodeValue);
    if (xmlDoc.getElementsByTagName("full_title")[0])
      $("#journal").val(xmlDoc.getElementsByTagName("full_title")[0].childNodes[0].nodeValue);
    if (xmlDoc.getElementsByTagName("first_page")[0])
      $("#pstart").val(xmlDoc.getElementsByTagName("first_page")[0].childNodes[0].nodeValue);
    if (xmlDoc.getElementsByTagName("last_page")[0])
      $("#pend").val(xmlDoc.getElementsByTagName("last_page")[0].childNodes[0].nodeValue);
    if (xmlDoc.getElementsByTagName("issue")[0])
      $("#issue").val(xmlDoc.getElementsByTagName("issue")[0].childNodes[0].nodeValue);
    var auts = '';
    auothors = xmlDoc.getElementsByTagName("person_name");
    for (var i = 0, len = auothors.length; i < len; i++) {
      auts += auothors[i].getElementsByTagName("given_name")[0].childNodes[0].nodeValue + ' ' + auothors[i].getElementsByTagName("surname")[0].childNodes[0].nodeValue + ', ';
    }
    $("#author").val(auts);
  } else {
    alert('DOI Not Found');
  }
}

function clearForm(){
  $("#title").val('');
  $("#journal").val('');
  $("#year").val('');
  $("#author").val('');
  $("#volume").val('');
  $("#issue").val('');
  $("#pstart").val('');
  $("#pend").val('');
  $("#reference").val('');
}
