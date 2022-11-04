<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">

    <table class="table table-sm table-bordered" ng-show="!ShowAddCourseForm">
      <thead>
        <tr>
          <th class="text-center">Code</th>
          <th>Degree</th>
          <th>Course Name</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-if="courseList.length == 0">
          <td colspan="12">No Record found.</td>
        </tr>

        <tr ng-repeat="course in courseList">
          <td class="text-center" ng-bind="course.code"></td>
          <td ng-bind="course.degree"></td>
          <td ng-bind="course.course"></td>
          <td class="text-center" ng-bind="course.active"></td>
          <td class="text-center">
            <button class="btn btn-sm btn-primary" ng-click="EditCourse(course)">
              <span><i class="fa fa-pen"></i></span>
            </button>
            <button class="btn btn-danger btn-sm" ng-click="RemoveItem($index, position)">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>

      </tbody>
      <tfoot>
        <tr>
          <td colspan="12">Count: {{courseList.length}}</td>
        </tr>
      </tfoot>
    </table>


    <!-- ADD COURSE -->
    <div ng-show="ShowAddCourseForm" style="margin-bottom: 100px;">
      <div class="row">
        <div class="col-md-12">
          <form name="frmCourse" novalidate>
            <table class="table table-sm table-responsive table-scrollable" style="white-space: nowrap;">
              <thead>
                <tr>
                  <th class="text-center col-md-1">Degree Code</th>
                  <th class="text-center col-md-3">Degree Name</th>
                  <th class="text-center col-md-1">Course Code</th>
                  <th class="text-center col-md-3">Course Name</th>
                  <th class="text-center col-md-3">Description</th>
                  <th class="text-center col-md-1">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="entry in CourseEntry">
                  <td>
                    <input type="text" name="degreecode" class="form-control" ng-model="entry.degreecode" required>
                  </td>
                  <td>
                    <input type="text" name="degree" class="form-control" ng-model="entry.degree" required>
                  </td>
                  <td>
                    <input type="text" name="coursecode" class="form-control" ng-model="entry.coursecode" required>
                  </td>
                  <td>
                    <input type="text" name="course" class="form-control" ng-model="entry.course" required>
                  </td>
                  <td class="text-center">
                    <textarea class="form-control" name="description" rows="1" style="resize: scroll;" ng-model="entry.description" required></textarea>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-danger" ng-click="RemoveItem($index)"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="12" class="text-right">
                    <button class="btn btn-sm btn-success" ng-click="AddItem()">  <i class="fa fa-add"></i></button>
                    <button class="btn btn-sm btn-primary" ng-click="SaveItem(CourseEntry)" ng-disabled="!frmCourse.$valid"> <i class="fa fa-save"></i></button>
                    <button class="btn btn-sm btn-warning" ng-click="AddCourse()">Cancel</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </form>
        </div>

      </div>
    </div>
      
    <div class="card" ng-show="!ShowAddCourseForm">
      <div class="card-footer text-right">
        <button class="btn btn-sm btn-success" ng-click="AddCourse()" ng-show="!ShowAddCourseForm"> <i class="fa fa-add"></i> Add</button>
      </div>
    </div>
  </div>
</div>





</div>