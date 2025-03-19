   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Add Lot Size as per Package</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
     
     
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Lot Size as per Package</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="{{ route('admin.change-price') }}" method="POST">
                                     {{ csrf_field() }}
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Package</label>
                                                
                                                <select name="package" id="" class="form-control" required>
                                                    <option value="BEGINNER">BEGINNER</option>
                                                    <option value="BRONZE">BRONZE</option>
                                                    <option value="SILVER">SILVER</option>
                                                    <option value="GOLD">GOLD</option>
                                                    <option value="PLATINUM">PLATINUM</option>
                                                    
                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Currency</label>                                             
                                                <input type="text" placeholder="Currency" name="currency" value="{{old('currency')}}" class="form-control" required id="">
                                            </div>
                                            
                                             <div class="mb-3 col-md-12">
                                                <label class="form-label">Trade Type</label>                                             
                                                <select name="tradetype" id="" class="form-control" required>
                                                    <option value="Buy">Buy</option>
                                                    <option value="Sell">Sell</option>        
                                                </select>
                                            </div>

                                            <!--<div class="mb-3 col-md-6">-->
                                            <!--    <label class="form-label">Lot Size</label>                                             -->
                                            <!--    <input type="text" placeholder="Lot Size" name="lotSize" value="{{old('lotSize')}}" class="form-control" required id="">-->
                                            <!--</div>-->

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Entry Price</label>                                             
                                                <input type="text" placeholder="Entry Price" value="{{old('entryPrice')}}" name="entryPrice" class="form-control" required id="">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">End Price</label>                                             
                                                <input type="text" placeholder="End Price" value="{{old('endPrice')}}" name="endPrice" class="form-control" required id="">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Entry Time</label>                                             
                                                <input type="datetime" placeholder="Y-m-d h:m:s" value="{{old('entrytime')}}" name="entrytime" class="form-control" required id="">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">End Time</label>                                             
                                                <input type="datetime" placeholder="Y-m-d h:m:s" value="{{old('endtime')}}" name="endtime" class="form-control" required id="">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Percentage %</label>                                             
                                                <input type="text" placeholder="Percentage %" value="{{old('percentage')}}" name="percentage" class="form-control" required id="">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Profit Type</label>                                             
                                                <select name="profitType" id="" class="form-control" required>
                                                    <option value="1">Profit</option>
                                                    <option value="2">Lose</option>        
                                                </select>
                                            </div>
              
                                           
                                        </div>
     
                                      
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reports</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                             
                                                <th>Package</th>
                                                <th>Currency</th>
                                                <th>Trade Type</th>
                                                <th>Lot Size</th>
                                                <th>Entry Price.</th>
                                                <th>End Price</th>
                                                <th>Entry Time</th>
                                                <th>End Time</th>
        
                                                <th>Percentage %</th>
                                                <th>Profit Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($trade as $value)
                                          <tr>
                                            <td>{{$value->package}}</td>
                                            <td>{{$value->currency}}</td>
                                            <td>{{$value->tradetype}}</td>
                                            <td>{{$value->lotSize}}</td>
                                            <td>{{$value->entryPrice}}</td>
                                            <td>{{$value->endPrice}}</td>
                                            <td>{{$value->entrytime}}</td>
                                            <td>{{$value->endtime}}</td>
                                            <td>{{$value->percentage}}</td>
                                            <td>  <span class="badge bg-{{($value->profitType==1)?"success":"danger"}}">{{($value->profitType==1)?"Profit":"Lose"}} </span> </td>
                                          </tr>
                                              
                                          @endforeach

                                        </tbody>
        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

     
     
     
     
                </div>
            </div>
        </div>
        <!--**********************************
                 Content body end
             ***********************************-->
     