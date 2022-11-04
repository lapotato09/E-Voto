<style>

  .mymodal {
    /*position: fixed;
    top: 50%;
    left: 50%;*/
    /*transform: translate(-50%, -50%);*/
    /*width: 900px;*/
    /*height: 200px;*/
    /*max-width: 100%;
    max-height: 100%;
    min-height: 600px;*/
    font-family: 'Century Gothic';    
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

  .mymodal .modal-body {
    font-size: 13px;
  }

  .req {
    color: red;
  }
</style>


<div class="modal-content mymodal">
	<div class="modal-header">
		<div class="modal-title">
      <p><b><div ng-bind="detailsmodal.title"></div> </b></p>  
    </div>
	</div>
	<div class="modal-body">
    <div ng-bind="detailsmodal.message"></div>
		<br>
	</div>
	<div class="modal-footer">
		<div class="row">
			<input type="button" class="button btn btn-primary" name="" value="Ok" ng-click="closeModal()">
      <!-- <a href="" ng-click="close()">Close</a> -->
		</div>
	</div>
</div>