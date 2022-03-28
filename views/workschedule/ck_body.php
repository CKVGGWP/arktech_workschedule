<main>
    <div class="d-flex flex-column justify-content-center">
        <div class="col-md-12 mt-3 px-4">
            <div class="pb-3">
                <a href="../../index.php?title=Dashboard" class="btn btn-outline-light text-dark"><i class="fas fa-angle-left"></i> Back</a>
            </div>
            <!------------------- DataTables Example ----------------->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="text-center">Work Schedule</h4>
                </div>
                <div class="card-body">

                    <!------------------------ Textbox Search ----------------------->
                    <div class="row mb-3 ml-1">
                        <div class="form-group mb-3">
                            <label for="userFirstname">Filter & Search</label>
                            <div class="col-sm">
                                <input type="name" class="form-control" id="filter" name="filter">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center text-nowrap" id="userTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Lot Number</th>
                                    <th>Process Code</th>
                                    <th>Process Order</th>
                                    <th>Process Section</th>
                                    <th>Process Remarks</th>
                                    <th>Target Finish</th>
                                    <th>Actual Finish</th>
                                    <th>Quantity</th>
                                    <th>Employee ID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>