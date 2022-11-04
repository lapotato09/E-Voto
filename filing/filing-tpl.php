<link rel="stylesheet" href="../lib/custom/candidacy.css">
<div class="container main-container">
	<ul class="nav nav-tabs nav-header">
	  <li class="nav-item">
	    <a class="nav-link active tab1" data-toggle="tab" ng-click="ChangeTpl('inventory')"><h6>Inventory</h6></a>
	  </li>
	  <li class="nav-item tab2" ng-show="ProcessFiling.length > 0">
	  	<a class="nav-link" data-toggle="tab" ng-click="ChangeTpl('add')"><h6>Filing</h6></a>
	  </li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div ng-include="TmplName"> </div>
	</div>
</div>


