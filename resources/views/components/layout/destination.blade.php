@php
    use Carbon\Carbon;
@endphp
<div class="info-box bg-secondary">
    <div class="info-box-content">
        <span class="info-box-text">
            <div class="row container">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="destinations">Destination <span style="color:red;">*</span></label>
                        <select name="destinations[]" id="destinations" class="form-control select-destination" data-key="{{$key}}" data-date="{{$checkInDate}}">
                            <option value="">Select a destination</option>
                            @foreach ($destinations as $destination)
                                <option value="{{$destination->id}}">{{$destination->destination}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="hotels">Hotel <span style="color:red;">*</span></label>
                        <select name="hotels[]" id="hotels" class="form-control select-hotel" data-key="{{$key}}" data-date="{{$checkInDate}}">
                            <option value="">Select a hotel</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="packages">Packages <span style="color:red;">*</span></label>
                        <select name="packages[]" id="packages" class="form-control select-package" data-key="{{$key}}" data-date="{{$checkInDate}}">
                            <option value="">Select a package</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="rooms">Room categories <span style="color:red;">*</span></label>
                        <select name="rooms[]" id="rooms" class="form-control select-room" data-key="{{$key}}" data-date="{{$checkInDate}}">
                            <option value="">Select a room</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="itinerary">Itinerary <span style="color:red;">*</span></label>
                        <select name="itinerary[]" id="itinerary" class="form-control select-itinerary" data-key="{{$key}}" data-date="{{$checkInDate}}">
                            <option value="">Select an itinerary</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="meal_plan">Meal plan</label>
                        <select name="meal_plan[]" id="meal_plan" data-key="{{$key}}" data-date="{{$checkInDate}}" class="form-control meal_plan">
                            <option value="CP">CP</option>
                            <option value="EP">EP</option>
                            <option value="MAP">MAP</option>
                            <option value="AP">AP</option>
                        </select>
                    </div>
                </div>
            </div><br>
        </span>
        <span class="info-box-number">
            <div class="row" style="width: 100%">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    {{Carbon::parse($checkInDate)->format('d-M-Y')}}
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <span id="directRates{{$key}}"></span>
                </div>
            </div>
        </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <div class="progress-description">
          <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="sgl_rooms">Sgl room</label>
                    <input type="number" class="form-control" name="sgl_room[]" id="sgl_room" data-key="{{$key}}" value="0">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="dbl_rooms">Dbl room</label>
                    <input type="number" class="form-control" name="dbl_room[]" id="dbl_room" value="0" data-key="{{$key}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="ex_bed_adult">Ex bed(Adult)</label>
                    <input type="number" class="form-control" name="ex_bed_adult[]" id="ex_bed_adult" value="0" data-key="{{$key}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="ex_bed_child">Ex bed(Child)</label>
                    <input type="number" class="form-control" name="ex_bed_child[]" id="ex_bed_child" value="0" data-key="{{$key}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="ex_child_wout">Ex Child(W/out Bed)</label>
                    <input type="number" class="form-control" name="ex_child_wout[]" id="ex_child_wout" value="0" data-key="{{$key}}">
                </div>
            </div>
          </div>
        </div>
      </div>
    {{-- <span>{{Carbon::parse($checkInDate)->format('d-M-Y')}}</span><p> </p> --}}
    
    
    <!-- /.info-box-content -->
</div>