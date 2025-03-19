<div class="content-body" style="min-height: 732px;">
  <div class="container-fluid">
    <div class="row page-titles mx-0">
        
      <div class="row p-1 py-3 d-flex align-items-center justify-content-between">
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Funding Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              $ 100.00
            </h3>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Strategy Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              $ 0.00
            </h3>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Refer Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              $ 19.40
            </h3>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-6 text-center mb-3">
            <span class="text-success">Profit Wallet</span>
            <h3 class="mx-2" style="visibility: visible">
              $ 0.00
            </h3>
        </div>
        <div id="transferbtn" class="col-xl-2 col-lg-4 col-sm-6 text-center">
            <button data-bs-toggle="modal" data-bs-target="#transfmodal" type="button" class="btn btn-rounded btn-primary">Transfer</button>
            <!-- Deposit Modal -->
            <div class="modal fade" id="transfmodal" tabindex="-1" role="dialog" aria-labelledby="DepositLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <form action="https://mega-bot.co/user/transfer" method="POST">
                          <input type="hidden" name="_token" value="bl6v8TMN8FENDDzoWNfYjTAqMsSF9N7PtWzp0PqM">                          <div class="modal-header">
                              <h5 class="modal-title" id="DepositLabel">Deposit</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <!-- Your deposit form content goes here -->
                              <div class="row">
                                  <div class="col-md-12 mb-4">
                                      <div class="mb-3">
                                          <label class="form-label">Transfer From:</label>
                                          <div class="dropdown bootstrap-select default-select form-control wide"><select name="transfer_from" class="default-select form-control wide">
                                            <option selected="" value="f-wal">Funding Wallet</option>
                                            <option value="r-wal">Refer Wallet</option>
                                            <option value="p-wal">Profit Wallet</option>
                                          </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Funding Wallet"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Funding Wallet</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="mb-3">
                                          <label class="form-label">Enter Amount To Transfer:</label>
                                          <input type="number" name="amount" class="form-control input-default" placeholder="Enter Amount in USDT" required="">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb-4">
                                      <div class="mb-3">
                                          <label class="form-label">Transfer To:</label>
                                          <div class="dropdown bootstrap-select default-select form-control wide"><select name="transfer_to" class="default-select form-control wide">
                                            <option value="s-wal">Strategy Wallet</option>
                                            <option value="f-wal">Funding Wallet</option>
                                          </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" title="Strategy Wallet"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Strategy Wallet</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
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
                                                              </tbody>
                          </table>

                          
                      </div>
                  </div>
              </div>
          </div>
  </div></div></div>