<style>

  .mymodal .table-cont {
    position: relative;
    overflow: auto;
    height: 350px;
    }

  .mymodal .modal-body {
    font-size: 13px;
  }

  .req {
    color: red;
  }
</style>


<div class="modal-content mymodal">
	<div class="modal-header">
    <div ng-bind="detailsmodal.title"></div>
	</div>
	<div class="modal-body">
    <div ng-bind="detailsmodal.message"></div>
		<br>
	</div>
	<div class="modal-footer">
		<div class="row">
			<input type="button" class="button btn btn-primary" name="" value="Close" ng-click="closeModal()">
      <!-- <a href="" ng-click="close()">Close</a> -->
		</div>
	</div>
</div>