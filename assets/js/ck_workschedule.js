// Server-side processing with object sourced data
$(document).ready(function () {
  getDataTable();

  function getDataTable() {
    var dataTable = $("#userTable").DataTable({
      lengthChange: false,
      searching: false,
      processing: true,
      ordering: false,
      serverSide: true,
      bInfo: false,
      ajax: {
        url: "controllers/ck_workscheduleController.php", // json datasource
        type: "POST", // method  , by default get

        error: function () {
          // error handling
        },
      },
      createdRow: function (row, data, index) {},
      columnDefs: [],
      fixedColumns: false,
      deferRender: true,
      scrollY: 400,
      scrollX: true,
      scroller: {
        loadingIndicator: true,
      },
      stateSave: false,
    });
  }
});

$("#filter").on("keyup", function () {
  let value = $(this).val();
  $("#userTable").DataTable().clear().destroy();
  $("#userTable").DataTable().destroy();

  let dataTable = $("#userTable").DataTable({
    lengthChange: false,
    searching: false,
    processing: true,
    ordering: false,
    serverSide: true,
    bInfo: false,
    // Get the data from the controller
    ajax: {
      url: "controllers/ck_workscheduleController.php", // json datasource
      type: "POST", // method , by default get
      data: { search: 1, value: value },
      error: function () {
        // error handling
      },
    },
    createdRow: function (row, data, index) {},
    columnDefs: [],
    fixedColumns: false,
    deferRender: true,
    scrollY: 500,
    scrollX: false,
    scroller: {
      loadingIndicator: true,
    },
    stateSave: false,
  });
});
