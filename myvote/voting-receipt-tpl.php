<style>
  .mymodal {
    font-family: 'Courier New';
    text-align: center;

  }

  .pos-head {
    background: gray;
    /*background: #0b0c10;*/
    margin-top: 10px;
    margin-bottom: 10px;
    color: white;
    padding: 2px;
    border-radius: 3px;

  }

  .bod-footer {
    margin-top: 30px;
  }

</style>

<div class="modal-content mymodal">
  <!-- <div class="modal-header">
    header
  </div> -->
  <div class="modal-body">
    <div>EARIST - General Mariano Alvarez, Cavite</div>
    <div>Commission on Student Election</div>
    <div> <b>May 13, 2022 - EARIST ISG ELECTION</b></div>
    <div> <b>VOTE REVIEW</b></div>

    <div ng-repeat="settings in finalList">
      <div class="pos-head text-center">
        <div ng-bind="settings.position"></div>        
      </div>
      <div ng-repeat="namelist in settings.value">
        <div ng-bind="namelist.label"></div>          
      </div>
    </div>

    <div class="bod-footer">
      <button class="btn btn-primary" ng-click="closeModal()">Confirm</button>
    </div>
  </div>
</div>