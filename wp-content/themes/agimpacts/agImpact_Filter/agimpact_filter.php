<html>
<head>
	<link rel="stylesheet" href="js/select2/select2.css">
	<link rel="stylesheet" href="js/tablesorter/css/theme.green.css">
	<script src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/tablesorter/js/jquery.tablesorter.js"></script>
	<script src="js/select2/select2.min.js"></script>
	<script type="text/javascript" src="js/agimpact_filter.js"></script>
	<link rel="stylesheet" href="agimpact_filter.css">

	
	
</head>
<body>
	
	
	<form action="action" method="POST">
		<p>
		<div id="filter"><h3>Filter</h3>
			<p><label for="doi">DOI</label>
			<input type="hidden" name="doi" id="doi" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
			
			<p><label for="scale">Spatial Scale</label>
			<input type="hidden" name="scale" id="scale" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
			
			<p><label for="crop">Crop</label>
			<input type="hidden" name="crop" id="crop" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
			
			<p><label for="model">Multi-Model Ensemble</label>
			<input type="hidden" name="model" id="model" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
			
			<p><label for="baseline_start">Baseline Period Start</label>
			<input type="hidden" name="baseline_start" id="baseline_start" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." /></p>
			<p><label for="baseline_end">Baseline Period End</label>
			<input type="hidden" name="baseline_end" id="baseline_end" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." /></p>
			
			<p><label for="period_start">Projection Period Start</label>
			<input type="hidden" name="period_start" id="period_start" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." /></p>
			<p><label for="period_end">Projection Period End</label>
			<input type="hidden" name="period_end" id="period_end" class="input-xlarge" style="width:80px;" data-placeholder="Choose An Option.." /></p>
			
			<div id="location">
				<h4>Geographical Scope</h4>
				<p><label for="country">Country</label>
				<input type="hidden" name="country" id="country" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
				
				<p><label for="subcontinents">Sub-Continents</label>
				<input type="hidden" name="subcontinents" id="subcontinents" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
				
			</div>
			
			<p><label for="doi">Climate Scenario</label>
			<input type="hidden" name="climate" id="climate" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
			
			<p><label for="doi">Adaptation Column</label>
			<input type="hidden" name="adaptation" id="adaptation" class="input-xlarge" style="width:350px;" data-placeholder="Choose An Option.." /></p>
			

			<input  type="button" name="search" id="search" value="Search">
		</div>
		</p>
		
		<p>
		<div id="results"><h3>Results</h3></div>
		</p>
		<div id="success"></div>
</body>
</html>