<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Example</h4> -->
                <form class="repeater custom-validation" method="post" action="{{url('/fromto')}}">
                    @csrf
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="row">
                            <!-- <div  class="mb-3 col-lg-4">
                                <label class="form-label" for="input-date1">From</label>
                                <input type="date" id="input-date1" name="date1" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                <span class="text-muted">e.g "dd/mm/yyyy"</span>
                            </div> -->
                            <div class="mb-0 "> <!-- col-lg-8 -->
                                <label class="form-label">Date Range</label>
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                    <input type="text" class="form-control" name="date1" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="date2" placeholder="End Date" />
                                </div>
                            </div>
                            <div class="md-3 mt-3"> <!--col-lg-4 -->
                                <label for="reports" class="form-label">Reports</label>
                                <select class="form-select" id="reports" name="reports" required>
                                    <option selected disabled value="">Choose Report Options</option>
                                    <option value="1">Expense Report</option>
                                    <option value="2">Bill Balances Report</option>
                                    <option value="3">Payments Report</option>
                                    <option value="4">Water consumed report</option>
                                    <option value="5">Customer Consolidated</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>
                            <!-- <div  class="mb-3 col-lg-4">
                                <label class="form-label" for="input-date2">To</label>
                                <input type="date" id="input-date2" name="date2" class="form-control input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" required>
                                <span class="text-muted">e.g "dd/mm/yyyy"</span>
                            </div> -->
                            <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                <div class="d-grid">
                                    <input data-repeater-delete type="submit" class="btn btn-primary" value="View Report"/>
                                </div>    
                            </div> 
                        </div>
                    </div>
                    <!-- <input data-repeater-create type="button" class="btn btn-success mt-2 mt-sm-0" value="Add"/> -->
                </form>
            </div>
        </div>
    </div>
</div>