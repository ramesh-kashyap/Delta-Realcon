  <!--**********************************
            Content body start
        ***********************************-->


        <div class="content-body">
      <!-- row -->
      <div class="container-fluid">
          <div class="row">

              <!-- <div class="col-xl-12 col-xxl-12 col-sm-12">
                  <marquee onmouseover="this.stop();" style="    padding: 10px;" onmouseout="this.start();" class="bgl-primary"><b>Panchvati Leaf Private Limited is dedicated to revolutionizing the healthcare
                          solutions and organic farming industry. By promoting the use of vermicompost, the company
                          aims to enhance agricultural productivity while ensuring a sustainable and eco-friendly approach
                          to farming. Additionally, Panchvati Leaf provides lucrative financial assistance programs for
                          farmers and a rewarding partnership program for individuals who wish to associate as channel
                          partners. </b></marquee>


              </div> -->
              <br> <br>
              <br>
              <div class="col-xl-3 col-xxl-3 col-sm-6">

                  <div class="card overflow-hidden">
                      <div class="social-graph-wrapper bg-primary">
                          <span class="fs-18">Today's Profit</span>
                      </div>
                      <div class="row">
                          <div class="pt-3 pb-3 ps-0 pe-0 text-center ">
                              <h4 class="m-1"><span class="counter fs-30">{{ currency() }}
                                      {{ number_format(Auth::user()->todayIncome->sum('comm'), 2) }}

                                  </span></h4>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-xxl-3 col-sm-6">
                  <div class="card overflow-hidden">
                      <div class="social-graph-wrapper bg-primary">
                          <span class="fs-18">Deposit Unit</span>
                      </div>
                      <div class="row">
                          <div class="pt-3 pb-3 ps-0 pe-0 text-center ">
                              <h4 class="m-1"><span class="counter fs-30">
                                      {{ Auth::user()->investments->sum('units') }} Units

                                  </span></h4>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-xxl-3 col-sm-6">
                  <div class="card overflow-hidden">
                      <div class="social-graph-wrapper bg-primary">
                          <span class="fs-18">Total Earning</span>
                      </div>
                      <div class="row">
                          <div class="pt-3 pb-3 ps-0 pe-0 text-center ">
                              <h4 class="m-1">{{ currency() }}
                                  {{ Auth::user()->totalIncome->sum('comm') }}



                                  <span class="counter fs-30">

                                  </span>
                              </h4>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-xxl-3 col-sm-6">
                  <div class="card overflow-hidden">
                      <div class="social-graph-wrapper bg-primary">
                          <span class="fs-18">Refer Income</span>
                      </div>
                      <div class="row">
                          <div class="pt-3 pb-3 ps-0 pe-0 text-center ">
                              <h4 class="m-1"><span class="counter fs-30"> {{ currency() }}
                                      {{ number_format(Auth::user()->refer_bonus->sum('comm'), 2) }}


                                  </span></h4>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xl-8 col-xxl-7">
                      <div class="row">
                          <div class="col-xl-12">
                              <div class="card">
                                  <div class="card-body">
                                      <div
                                          class="media d-md-flex d-block border-bottom pb-sm-4 pb-2 mb-4 text-md-start text-center">
                                          <img src="{{ asset('') }}user/images/signup.webp" alt=""
                                              width="280" class="rounded me-0 me-md-4 mb-2 mb-md-0 event">
                                          <div class="media-body">
                                              <div class="d-md-flex d-block justify-content-between">
                                                  <h4 class="fs-22">Panchvati Biological Leaf Private Limited.</h4>

                                              </div>
                                              <span class="text-primary d-block mb-3 text-start fs-30">
                                                  Total Balance-
                                                  {{ currency() }} {{ number_format(Auth::user()->available_balance(), 2) }}

                                              </span>
                                              <p class="fs-13 font-w200 text-start">
                                                  Private Sale is for very limited time and Earn upto 3% of Panchavati Biological
                                                  through Referals.
                                              </p>

                                              <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                                  <button type="button" class="btn btn-rounded btn-primary"
                                                      data-bs-toggle="modal" data-bs-target="#Deposit">Deposit</button>
                                                  <div class="modal fade" id="Deposit" tabindex="-1" role="dialog"
                                                      aria-labelledby="DepositLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h5 class="modal-title" id="DepositLabel">Deposit</h5>
                                                                  <button type="button" class="btn-close"
                                                                      data-bs-dismiss="modal"
                                                                      aria-label="Close"></button>
                                                              </div>
                                                              
                                                              <form id="depositForm" method="post"
                                                                  action="{{route('user.confirmDeposit')}}">
                                                                  @csrf
                                                                  <div class="modal-body">
                                                                       <!-- Laravel Validation Errors -->
         
                                                                      {{-- <div class="mb-1">Deposit may require 2 to 5
                                                                          Minutes to reflect in your funding wallet.</div> --}}
                                                                      <div class="row">
                                                                          <div class="col-md-12">
                                                                              <div class="mb-3">
                                                                                  <label class="form-label">Enter Unit
                                                                                      :</label>
                                                                                  <input type="number"
                                                                                      class="form-control input-default"
                                                                                      placeholder="Enter Unit"
                                                                                      name="amount" required>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="row">
                                                                          <div class="col-md-12 mb-4">
                                                                              <div class="mb-3">
                                                                                  <label class="form-label">Select
                                                                                      Network:</label>
                                                                                  <select
                                                                                      class="default-select form-control wide"
                                                                                      name="network" id="network">

                                                                                      <option value="usdtBep20">
                                                                                      USDT.BEP20 </option>
                                                                                      <option value="bank-transfer">
                                                                                        BANK TRANSFER</option>
                                                                                  </select>
                                                                              </div>
                                                                              <h6 class="text-danger mx-1">Minimum
                                                                                  Deposit is 1 Unit</h6>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <button type="button"
                                                                          class="btn btn-danger light"
                                                                          data-bs-dismiss="modal">Close</button>
                                                                      <button type="submit"
                                                                          class="btn btn-primary">Deposit</button>
                                                                  </div>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  </div>

      
                                                  <button type="button" class="btn btn-rounded btn-primary"
                                                      data-bs-toggle="modal" data-bs-target="#Withdraw">Withdraw
                                                      Funds</button>

                                                  <div class="modal fade" id="Withdraw" tabindex="-1"
                                                      role="dialog" aria-labelledby="DepositLabel"
                                                      aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h5 class="modal-title" id="DepositLabel">Withdraw
                                                                      Funds</h5>
                                                                  <button type="button" class="btn-close"
                                                                      data-bs-dismiss="modal"
                                                                      aria-label="Close"></button>
                                                              </div>
                                                              <form id="withdrawForm"  method="POST"
                                                                  action="{{route('user.Withdraw-Request')}}">
                                                                  @csrf
                                                                  <div class="modal-body">

   
                                                                      {{-- <div class="mb-1">Withdrawal may take 24 to 48
                                                                          hours to reflect in your funding wallet.</div> --}}
                                                                      <div class="row">
                                                                          <div class="col-md-12">
                                                                              <div class="mb-3">
                                                                                  <label for="withdrawAmount"
                                                                                      class="form-label">Enter Amount
                                                                                      in USDT:</label>
                                                                                  <input type="number"
                                                                                      id="withdrawAmount"
                                                                                      name="amount"
                                                                                      class="form-control input-default"
                                                                                      placeholder="Enter Amount"
                                                                                      required>
                                                                              </div>
                                                                             
                                                                          </div>
                                                                      </div>
                                                                      <div class="row">
                                                                          <div class="col-md-12 mb-2">
                                                                              <div class="mb-3">
                                                                                  <label for="network"
                                                                                      class="form-label">Select
                                                                                      Network:</label>
                                                                                  <select id="network"
                                                                                      name="paymentMode"
                                                                                      class="default-select form-control wide">

                                                                                      <option value="USDT.BEP20">
                                                                                          USDT(TRC-20)</option>
                                                                                      <option value="BANK TRANSFER">
                                                                                      BANK  TRANSFER </option>
                                                                                  </select>
                                                                              </div>

                                                                          </div>
                                                                          <div class="col-md-12 mb-2">
                                                                              <div class="mb-3">
                                                                                  <label for="" class="form-label">Email ID</label>
                                                                                  <input class="mt-12 form-control" type="text" readonly id="inputemail" readonly value="{{ Auth::user()->email }}" placeholder="Enter your email">
                                                                              </div>

                                                                          </div>
                                                                          <div class="col-md-12 mb-2">
                                                                              <div class="mb-3">
                                                                                  <label for="" class="form-label">Verification Code</label>
                                                                                  <input type="text" id="" name="code" class="form-control input-default" placeholder="Verification Code" required>
                                                                                  <div class="first-code-send text-primary" style="position: absolute; top: 79.5%; right: 43px; cursor:pointer;font-size: 15px;">@lang('Get Code')</div>
                                                                                  <span class="resend-btn code-btn text-primary" style="position: absolute; top: 77.5%; right: 43px; cursor: pointer;display:none;">@lang('Resend Code')</span>
                                                                              </div>

                                                                          </div>

                                                                      </div>




                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <button type="button"
                                                                          class="btn btn-danger light"
                                                                          data-bs-dismiss="modal">Close</button>
                                                                      <button type="submit"
                                                                          class="btn btn-primary">Withdraw</button>
                                                                  </div>
                                                              </form>

                                                          </div>
                                                      </div>
                                                  </div>
                                                  <a type="button" class="btn btn-rounded btn-primary"
                                                      href="{{ route('user.refer') }}">Refer Now</a>
                                              </div>


                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                              <div class="media bgl-primary p-3 rounded align-items-center">

                                                  <div class="media-body">
                                                      <span class="fs-15 d-block mb-1 text-primary">ROI Bonus
                                                      </span>
                                                      <span class="fs-15 text-black">
                                                          {{ currency() }}
                                                          {{ number_format(auth::user()->dailyIncentive->sum('comm'), 2) }}
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                              <div class="media bgl-primary p-3 rounded align-items-center">

                                                  <div class="media-body">
                                                      <span class="fs-15 d-block mb-1 text-primary">Level Bonus

                                                      </span>
                                                      <span class="fs-15 text-black">
                                                          {{ currency() }}
                                                          {{ number_format(Auth::user()->level_bonus->sum('comm'), 2) }}
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-12 col-xxl-12">
                                              <div class="media bgl-primary p-3 rounded align-items-center">

                                                  <div class="media-body">
                                                      <span class="fs-15 d-block mb-1 text-primary">
                                                          Direct Bonus</span>
                                                      <span class="fs-15 text-black">{{ currency() }}
                                                          {{ number_format(Auth::user()->sponsorship_bonus->sum('comm'), 2) }}

                                                      </span>
                                                  </div>

                                              </div>
                                          </div>

                                          <div class="col-lg-4 col-md-12 col-xxl-12">
                                              <div class="media bgl-primary p-3 rounded align-items-center">

                                                  <div class="media-body">
                                                      <span class="fs-15 d-block mb-1 text-primary">Total Team</span>
                                                      <span class="fs-15 text-black">
                                                          1
                                                      </span>
                                                  </div>

                                              </div>
                                          </div>

                                          <div class="col-lg-4 col-md-12 col-xxl-12">
                                              <div class="media bgl-primary p-3 rounded align-items-center">

                                                  <div class="media-body">
                                                      <span class="fs-15 d-block mb-1 text-primary">Team Unit</span>
                                                      <span class="fs-15 text-black">
                                                          {{ Auth::user()->investments->sum('units') }} Units
                                                      </span>
                                                  </div>

                                              </div>
                                          </div>

                                          <div class="col-lg-4 col-md-12 col-xxl-12">
                                              <div class="media bgl-primary p-3 rounded align-items-center">

                                                  <div class="media-body">
                                                      <span class="fs-15 d-block mb-1 text-primary">Total Withdraw</span>
                                                      <span class="fs-15 text-black"> {{ currency() }}
                                                          {{ number_format(Auth::user()->withdraw(), 2) }}


                                                      </span>
                                                  </div>

                                              </div>
                                          </div>


                                      </div>
                                  </div>
                              </div>
                          </div>


                      </div>
                  </div>
                  <div class="col-xl-4 col-xxl-5">
                      <div class="row">
                          <div class="col-xl-12 col-md-6">
                              <div class="card p-4" style="height: 565px; overflow-y: auto;">
                                  <p class="mb-4 fs-22 fw-bold">Recent History</p>

                                  <div class="history-list">
                                      @foreach (Auth::user()->recentTransactions as $transaction)
                                      <div class="history-item">
                                          <div class="left">
                                              <span class="date">{{ date('d M Y', strtotime($transaction->created_at)) }}</span>
                                              <span class="name">{{ $transaction->remarks }}</span> <!-- Adjust if there's a username field -->
                                          </div>
                                          <div class="right">
                                              @if ($transaction->type == 'credit')
                                              <span class="amount text-danger">-{{ currency() }} {{ number_format($transaction->comm, 2) }}</span>

                                              @else
                                              <span class="amount text-success">+{{ currency() }} {{ number_format($transaction->comm, 2) }}</span>

                                              @endif
                                          </div>
                                      </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>
  <style>
      .history-list {
          display: flex;
          flex-direction: column;
          gap: 15px;
          /* Spacing between items */
      }

      .history-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 10px 15px;
          background: #f8f9fa;
          border-radius: 8px;
          box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
      }

      .left {
          display: flex;
          flex-direction: column;
      }

      .date {
          font-size: 14px;
          font-weight: bold;
          color: #333;
      }

      .name {
          font-size: 16px;
          color: #666;
      }

      .right {
          font-size: 18px;
          font-weight: bold;
          color: #28a745;
      }
  </style>
  <!--**********************************
            Content body end
        ***********************************-->

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


  <script>
      $(document).ready(function() {
          var countdown;
          var timer;

          $('.first-code-send').click(function(e) {
              var emailId = $('#inputemail').val();

              if (!emailId) {
                  iziToast.error({
                      message: 'Invalid Email!',
                      position: "topRight"
                  });
                  return false;
              }

              startTimer(); // Start the timer after sending the code
              $('.first-code-send').hide();
              $('.resend-btn').show();

              $.ajax({
                  type: "POST",
                  url: "{{ route('user.send_code') }}",
                  data: {
                      "emailId": emailId,
                      "_token": "{{ csrf_token() }}"
                  },
                  success: function(response) {
                      if (response) {
                          iziToast.success({
                              message: 'Email sent Successfully',
                              position: "topRight"
                          });


                      } else {
                          iziToast.error({
                              message: 'Error!',
                              position: "topRight"
                          });
                      }
                  }
              });
          });

          $('.sencond-code-send').click(function(e) {
              var ths = $(this);
              var emailId = $('#emailId').val();

              if (!emailId) {
                  iziToast.error({
                      message: 'Invalid Email!',
                      position: "topRight"
                  });
                  return false;
              }
              startTimer2(); // Start the timer after sending the code
              $('.sencond-code-send').hide();
              $('.resend-btn2').show();
              // alert(sponsor); 
              $.ajax({
                  type: "POST",
                  url: "{{ route('user.send_code') }}",
                  data: {
                      "emailId": emailId,
                      "_token": "{{ csrf_token() }}",
                  },
                  success: function(response) {
                      // alert(response);      
                      if (response) {
                          // alert("hh");
                          iziToast.success({
                              message: 'Email send Successfully',
                              position: "topRight"
                          });




                      } else {
                          // alert("hi");
                          iziToast.error({
                              message: 'Error!',
                              position: "topRight"
                          });
                      }
                  }
              });
          });



          function startTimer() {
              var resendButton = $('.resend-btn');
              countdown = 60; // 60 seconds
              resendButton.prop('disabled', true); // Disable the resend button
              resendButton.text('Wait ' + countdown + 's');

              timer = setInterval(function() {
                  countdown--;
                  resendButton.text('Wait ' + countdown + 's');

                  if (countdown <= 0) {
                      clearInterval(timer);
                      resendButton.prop('disabled', false); // Enable the resend button after the timer ends
                      resendButton.text('Resend Code'); // Reset button text
                  }
              }, 1000);
          }

          function startTimer2() {
              var resendButton = $('.resend-btn2');
              countdown = 60; // 60 seconds
              resendButton.prop('disabled', true); // Disable the resend button
              resendButton.text('Wait ' + countdown + 's');

              timer = setInterval(function() {
                  countdown--;
                  resendButton.text('Wait ' + countdown + 's');

                  if (countdown <= 0) {
                      clearInterval(timer);
                      resendButton.prop('disabled', false); // Enable the resend button after the timer ends
                      resendButton.text('Resend Code'); // Reset button text
                  }
              }, 1000);
          }

          // Optional: Handle Resend Button Click
          $('.resend-btn').click(function(e) {
              $('.first-code-send').trigger('click'); // Simulate a click on the original send button
          });

          $('.resend-btn2').click(function(e) {
              $('.sencond-code-send').trigger('click'); // Simulate a click on the original send button
          });
      });
  </script>