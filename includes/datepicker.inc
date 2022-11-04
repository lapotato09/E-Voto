<style>
	
	/* Bootstrap css */
	@import "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css";

	/* Google Material icons */
	@import "http://fonts.googleapis.com/icon?family=Material+Icons";

	/* Propeller css */
	@import "dist/css/propeller.min.css";

	/* Bootstrap datetimepicker */
	@import "datetimepicker/css/bootstrap-datetimepicker.css";

	/* Propeller datetimepicker */
	@import "datetimepicker/css/pmd-datetimepicker.css";

</style>
	
<!-- jquery JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Bootstrap js -->
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Propeller textfield js --> 
<script type="text/javascript" src="dist/js/propeller.min.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="datetimepicker/js/bootstrap-datetimepicker.js"></script>

<script>
	// Default date and time picker
	$('#datetimepicker-default').datetimepicker();
</script>



<!--Default date and time picker -->
<div class="form-group pmd-textfield pmd-textfield-floating-label">
	<label class="control-label" for="datetimepicker-default">Select Date and Time</label>
	<input type="text" id="datetimepicker-default" class="form-control" />
</div>

