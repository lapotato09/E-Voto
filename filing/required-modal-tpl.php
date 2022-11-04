<style>

  .mymodal {
    /*position: fixed;
    top: 50%;
    left: 50%;*/
    /*transform: translate(-50%, -50%);*/
    /*width: 900px;*/
    height: 200px;
    /*max-width: 100%;
    max-height: 100%;
    min-height: 600px;*/
  }

  .mymodal .chead {
    background: #f7b731;
    color: white;
  }

  .mymodal .table-cont {
    position: relative;
    overflow: auto;
    height: 350px;
    }

  .req {
    color: red;
  }


</style>


<div class="modal-content mymodal">
	<div class="modal-header">
		<div class="modal-title"><h5>FIELD VALIDATION</h5> </div>
	</div>
	<div class="modal-body">
		Please fill out required fields before you submit!
		<br>
	</div>
	<div class="modal-footer">
		<div class="row">
			<input type="button" class="button btn btn-success" name="" value="Close" ng-click="Close()">
		</div>
	</div>
</div>