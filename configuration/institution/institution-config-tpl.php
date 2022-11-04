<style>
  #config {
    border-radius: 5px;
    background: white;
    min-height: 670px;
    padding: 10px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  }

  .selectui {
    /*display: block;*/
    width: 100%;
    /*height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;*/
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }

  .selectui:active {
    background: red;
    color: red;
  }

  .selectui:visited {
    background: green;
    color: green;
  }

  .selectui:focus {
    background: blue;
    color: blue;
  }

  .selectui:after {
    background: blue;
    color: blue;
  }

  .select2 > .select2-choice.ui-select-match {
    /* Because of the inclusion of Bootstrap */
    height: 29px;
  }

  .selectize-control > .selectize-dropdown {
    top: 36px;
  }

  .ui-select-dropdown {
    opacity: 1 !important;
  }

  .ui-select-choices {
    min-height: 100px;
    opacity: 1 !important;
    display: block;
  }

  /*.ui-select-choices.ui-select-choices-content.ui-select-dropdown.dropdown-menu {
    display: block;
  }*/

</style>
<div id="config">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" style="background: #920003;">
          <select class="form-control none-boxshadow" ng-model="localData.template"  ng-change="ChangeTpl(localData.template)">
            <option ng-repeat="tpl in TemplateList" ng-value="tpl.code" ng-bind="tpl.label"></option>
          </select>
        </div>

        <div class="card-body" ng-show="localData.template">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div ng-include="TplUrl"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-md-6">
      <h3>Tagging without multiple, with simple strings</h3>
      <ui-select class="selectui" ng-model="singleDemo.color" theme="bootstrap" title="Choose a color" sortable="true">
        <ui-select-match placeholder="Select color...">{{$select.selected}}</ui-select-match>
        <ui-select-choices repeat="color in availableColors | filter: $select.search">
          <div ng-bind-html="color | highlight: $select.search"></div>
        </ui-select-choices>
      </ui-select>
      <br>
      <p>Selected: {{singleDemo.color}}</p>

    </div>

  </div> -->

  
</div>
