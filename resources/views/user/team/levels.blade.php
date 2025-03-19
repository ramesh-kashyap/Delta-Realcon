<div class="content-body">
    <div class="container-fluid">
      <div class="row page-titles mx-0">
        <div class="row p-1 py-3 d-flex align-items-center justify-content-between">
          
            <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
                <span class="text-success">Refer Wallet</span>
                <h3 class="mx-2" style="visibility: visible">
                    {{ currency() }} {{calReferBalance(auth::user()->id)}}
                </h3>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
                <span class="text-success">Lifetime Earning</span>
                <h3 class="mx-2" style="visibility: visible">
                    {{ currency() }} {{$earning}}
                </h3>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
                <span class="text-success">Total Sponsors</span>
                <h3 class="mx-2" style="visibility: visible">
                    {{ $sponsors }}
                </h3>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
                <span class="text-success">Total Levels</span>
                <h3 class="mx-2" style="visibility: visible">
                    {{ $max_lenght }}
                </h3>
            </div>
            <div id="transferbtn" class="col-xl-2 col-lg-4 col-sm-6 text-center">
                <a href="{{ route('user.refer') }}"  type="button" class="btn btn-rounded btn-primary">Refer Now</a>
                <!-- Deposit Modal -->
                          
            </div>
                        </div>
                  
      </div>
      
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Levels</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('user.levels') }}" method="GET">
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="level_select">Select Level:</label>
                                        <select class="form-control" id="level_select" name="selected_level">
                                            @for ($i = 1; $i <= $max_lenght; $i++)
                                                <option value="{{ $i }}" @if($i == $selected_level) selected @endif>Level {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="search">Search:</label>
                                        <input type="text" class="form-control" id="search" name="search" value="{{ $search }}" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-responsive-md">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>User ID</th>
                                  <th>Email ID</th>
                                  <th>Level</th>
                                  <!--<th>Mobile No</th>-->
                                  <th>Joining Date</th>
                                  <th>Package</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($direct_team as $key => $value)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $value->name }}</td>
                                      <td>{{ $value->username }}</td>
                                      <td>{{ $value->email }}</td>
                                      <td>{{ $selected_level }}</td>
                                      <!--<td>{{ $value->phone }}</td>-->
                                      <td>{{ $value->created_at }}</td>
                                      <td>{{ currency() }} {{ $value->investment->sum('amount') }}</td>
                                      <td><span style="background:{{ ($value->active_status == 'Active') ? '#1f9a00' : '#e33838' }};padding: 5px;border-radius: 5px;">{{ $value->active_status }}</span></td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                        <br>
                        {{ $direct_team->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>

  <script>
    function resetForm() {
        // Redirect to index without any parameters
        window.location.href = "{{ route('user.levels') }}";
    }
</script>
  