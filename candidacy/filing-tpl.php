<link rel="stylesheet" href="../lib/custom/candidacy.css">
<div class="container main-container">
	<ul class="nav nav-tabs nav-header">
	  <li class="nav-item">
	    <a class="nav-link active mytab" data-toggle="tab" ng-click="ChangeTpl('inventory')"><h6>Inventory</h6></a>
	  </li>
	  <li class="nav-item" ng-show="ProcessFiling.length > 0">
	  	<a class="nav-link mytab" data-toggle="tab" ng-click="ChangeTpl('filing')"><h6>Filing</h6></a>
	  </li>
	  <li class="nav-item">
	  	<a class="nav-link mytab" data-toggle="tab" ng-click="ChangeTpl('evaluation')"><h6>Evaluation</h6></a>
	  </li>
	  <li class="nav-item">
	  	<a class="nav-link mytab" data-toggle="tab" ng-click="ChangeTpl('approval')"><h6>Approval</h6></a>
	  </li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div ng-include="TmplName"> </div>
	</div>
</div>


