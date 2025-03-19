

<div class="content-body">
  <div class="container-fluid">
    <div class="row page-titles mx-0">
        
      <div class="row p-1 py-3 d-flex align-items-center justify-content-between">
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Funding Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              {{ currency() }} {{number_format($user->u_credits,2)}}
            </h3>
        </div>
        {{-- <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">OPX Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              {{number_format($user->u_opt,2)}}
            </h3>
        </div> --}}
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Strategy Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              {{ currency() }} {{number_format($user->u_strategy,2)}}
            </h3>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Refer Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              {{ currency() }} {{number_format($user->u_ref,2)}}
            </h3>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Profit Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              {{ currency() }} {{number_format($user->u_profit,2)}}
            </h3>
        </div>
        <div id="transferbtn" class="col-xl-2 col-lg-4 col-sm-6 text-center">
            <button  data-bs-toggle="modal" data-bs-target="#transfmodal" type="button" class="btn btn-rounded btn-primary">Transfer</button>
            <!-- Deposit Modal -->
            <div class="modal fade" id="transfmodal" tabindex="-1" role="dialog" aria-labelledby="DepositLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <form action="{{ route('user.transferfund') }}" method="POST">
                          @csrf
                          <div class="modal-header">
                              <h5 class="modal-title" id="DepositLabel">Deposit</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <!-- Your deposit form content goes here -->
                              <div class="row">
                                  <div class="col-md-12 mb-4">
                                      <div class="mb-3">
                                          <label class="form-label">Transfer From:</label>
                                          <select name="transfer_from" class="default-select form-control wide">
                                            <option selected value="f-wal">Funding Wallet</option>
                                            <option value="r-wal">Refer Wallet</option>
                                            <option value="p-wal">Profit Wallet</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="mb-3">
                                          <label class="form-label">Enter Amount To Transfer:</label>
                                          <input type="number" name="amount" class="form-control input-default" placeholder="Enter Amount in USDT" required>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb-4">
                                      <div class="mb-3">
                                          <label class="form-label">Transfer To:</label>
                                          <select name="transfer_to" class="default-select form-control wide">
                                            <option value="s-wal">Strategy Wallet</option>
                                            <option value="f-wal">Funding Wallet</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <!-- End of deposit form content -->
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Transfer</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
                     
        </div>
    </div>
    
            </div>




      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Transfer History</h4> 
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
                                      <th>AMOUNT</th>
                                      <th>FROM</th>
                               
                                      <th>TO</th>
                                      <th>FUNDING WALLET</th>
                                      <th>TIME</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($transfers as $transfer)
                                  <tr>
                                      <td>{{ currency() }}{{ $transfer->t_amt }}</td>
                                      <td>
                                        @if ($transfer->t_from == "f-wal")
                                            Funding Wallet
                                        @elseif ($transfer->t_from == "r-wal")
                                            Refer Wallet
                                        @elseif ($transfer->t_from == "opx")
                                          Released OPX
                                        @elseif ($transfer->t_from == "p-wal")
                                          Profit Wallet
                                        @elseif ($transfer->t_from == "s-wal")
                                            Strategy Wallet
                                            @elseif ($transfer->t_from == "o-wal")
                                            OPX Wallet
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transfer->t_to == "f-wal")
                                            Funding Wallet
                                        @elseif ($transfer->t_to == "o-wal")
                                              OPX Wallet
                                        @elseif ($transfer->t_to == "s-wal")
                                            Strategy Wallet
                                        @elseif ($transfer->t_to == "bot")
                                        Bot activation Fees
                                        @else
                                        Deactivation Fees
                                        @endif
                                        
                                    </td>
                                      <td>{{ currency() }}{{$transfer->t_new}}</td>
                                      <td>{{ $transfer->t_time }}</td>
                                  </tr>

                                @endforeach
                              </tbody>
                          </table>

                          {{ $transfers->withQueryString()->links() }}
                      </div>
                  </div>
              </div>
          </div>
  </div></div></div>