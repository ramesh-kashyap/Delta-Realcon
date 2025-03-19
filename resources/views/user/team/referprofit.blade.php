<div class="content-body">
    <div class="container-fluid">
     
       
  
  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Referal Profits</h4>
                        <div class="header-right">
                            <div class="input-group search-area ms-auto d-inline-flex">
                                <input type="text" class="form-control" placeholder="Search here">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                                </div>
                            </div>
                  </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Exchange</th>
                                        <th>Reffered</th>
                                        <th>Income</th>
                                        <th>Refer Wallet</th>
               
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($referalprofits as $profit)  
                                    <tr>
                                        <td>{{ $profit->created_at }}</td>
                                        <td>OptinexAI</td>
                                        <td>{{ $profit->rname }}</td>
                                        <td>{{ currency() }}{{ $profit->comm }}</td>
                                        <td>{{number_format(Auth::user()->u_ref,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $referalprofits->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
     </div>
   </div>
</div>