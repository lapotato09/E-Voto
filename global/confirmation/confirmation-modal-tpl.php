<div class="modal-content mymodal">
  <div class="modal-header">
    <div class="modal-title"><h5>{{param.title}} </h5></div>
  </div>
  <div class="modal-body body">
    {{ param.body }}
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" ng-click="closeModal('submit')">Yes</button>
    <button class="btn btn-link" ng-click="closeModal('cancel')">Cancel</button>
  </div>
</div>