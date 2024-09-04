<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Example</h4> -->
                <form class="custom-validation" method="post" action="{{url('/get_res')}}">
                    @csrf
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="row">
                            <div class="md-3"> <!--col-lg-4 -->
                                <label for="reports" class="form-label">Games</label>
                                <select class="form-select" id="reports" name="gameid" required>
                                    <option selected disabled value="">Choose Game</option>
                                    @foreach($games as $g)
                                        <option value="{{$g->id}}">{{$g->game_name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>
                            <div class="col-lg-2 col-sm-4 align-self-center d-flex mt-5" style="width: 100%;justify-content: center;">
                                <div class="d-grid">
                                    <input type="submit" class="btn btn-primary" value="View Result"/>
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