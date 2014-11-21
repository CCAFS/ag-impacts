	$(document).ready(function(){
	   $('#doi').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {doi: term,option: 1};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#scale').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {scale: term,option: 2};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#crop').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {crop: term,option: 3};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#model').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {model: term,option: 4};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#baseline_start').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {baseline: term,option: 5,
			suboption:1};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		$('#baseline_end').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {baseline: term,option: 5,
			suboption:2};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#period_start').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {period: term,option: 6,
			suboption:1};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#period_end').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {period: term,option: 6,
			suboption:2};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#country').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {country: term,option: 7};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#subcontinents').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {subcontinents: term,option: 8,
			country:$('#country').val()
		  };
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#climate').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {climate: term,option: 9 };
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		
		$('#adaptation').select2({
		ajax: {
		  url: "options.php",
		  dataType: 'json',
		  data: function (term, page) {
			return {adaptation: term,option: 10};
		  },
		  results: function (data, page) {
			return { results: data };
		  }
		}
		});
		$("#search").click(function(){
			$('#results').empty();
			$.ajax({
				url: "options.php",
				type:"POST",
				data:"submit=&doi="+$('#doi').val()+"&scale="+$('#scale').val()+"&crop="+$('#crop').val()+"&model="+$('#model').val()+"&baseline_start="+$('#baseline_start').val()+"&baseline_end="+$('#baseline_end').val()+"&period_start="+$('#period_start').val()+"&period_end="+$('#period_end').val()+"&country="+$('#country').val()+"&subcontinents="+$('#subcontinents').val()+"&climate="+$('#climate').val()+"&adaptation="+$('#adaptation').val()+"&option="+11, 
				success: function(datos){
					$('#results').append(datos);
					$("#resulttable").tablesorter({theme : 'green'});
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
	
	function downloadData(){
		window.open("agImpact_download.php?doi="+$('#doi').val()+"&scale="+$('#scale').val()+"&crop="+$('#crop').val()+"&model="+$('#model').val()+"&baseline_start="+$('#baseline_start').val()+"&baseline_end="+$('#baseline_end').val()+"&period_start="+$('#period_start').val()+"&period_end="+$('#period_end').val()+"&country="+$('#country').val()+"&subcontinents="+$('#subcontinents').val()+"&climate="+$('#climate').val()+"&adaptation="+$('#adaptation').val(),"_blank");
		window.close();
	}
	
	function downloadDataCSV(){
		window.open("agImpact_downloadCSV.php?doi="+$('#doi').val()+"&scale="+$('#scale').val()+"&crop="+$('#crop').val()+"&model="+$('#model').val()+"&baseline_start="+$('#baseline_start').val()+"&baseline_end="+$('#baseline_end').val()+"&period_start="+$('#period_start').val()+"&period_end="+$('#period_end').val()+"&country="+$('#country').val()+"&subcontinents="+$('#subcontinents').val()+"&climate="+$('#climate').val()+"&adaptation="+$('#adaptation').val(),"_blank");
		window.close();
	}