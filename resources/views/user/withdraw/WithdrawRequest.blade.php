<!-- main -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="header-text-full">
                <h3 class="ms-2 mb-0 mt-2">Withdraw</h3>
            </div>
        </div>
    </div>
    <div class="main row">
        <div class="col-md-6">
            <!-- table -->
            <div class="table-parent table-responsive mt-4">
                <div class="table-search-bar">
                    <div>
                        <form action="{{ route('user.confirm') }}" method="post">
                          {{ csrf_field() }}
                            <div class="row g-3 align-items-end">

                                <code class=""  style="font-weight: 900;    color: #9ef54f;font-size:15px;text-align: center">Available Balance : <b>{{ currency() }} {{ number_format(Auth::user()->available_balance(), 2) }}  </b></code>
                

                                <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                    <select class="form-control" name="PSys"
                                        id="wallet_type">
                                        <option data-icon="USDT.BEP20" value="USDT.BEP20">
                                          Tether BEP20 - USDT</option>
                                        <option data-icon="USDT.TRC20" value="USDT.TRC20">
                                        Tether TRC20 - USDT</option>
                                  
                                    </select>
                                </div>
                                
/
                                <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                    <input class="form-control" type="text" name="amount" value=""
                                        placeholder="Enter Amount"
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" />
                                        
                                </div>
                                <span class="cashback-info-label"> </span>

                                <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                  <input class="form-control" type="text" id="walletAddress"  name="walletAddress" value="{{Auth::user()->usdtBep20}}"
                                      placeholder="Wallet Address" />
                              </div>


                                <div class="input-box col-lg-12 col-md-12 col-xl-12 col-12">
                                    <button class="btn-custom w-100" type="submit"><i
                                            class="fal fa-dollar-sign submit-btn "></i>Withdraw</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
<script src="https://code.jquery.com//jquery-3.3.1.min.js"></script>

<script>


	$(function(){
		$('input[name="amount"]').on('change keyup',function () {
			let str = $(this).val();
			str = str.replace(',','.');
			$(this).val(str);
           let min =  10;
      
			let amount = parseFloat(str);
		
			
            if (amount>=min) 
            {
                $(".submit-btn").prop("disabled", false);
                $('.cashback-info-label').html('');
            }
            else
            {

            $(".submit-btn").prop("disabled", true);
            $('.cashback-info-label').html("minimum Withdrawal is "+min+" USDT").css('color', 'red');

            }
            
            	
			if (amount%10==0) 
            {
                
                console.log("hii");
                $(".submit-btn").prop("disabled", false);
                $('.cashback-info-label').html('');
            }
             else
            {
                      console.log("hidddi");

            $(".submit-btn").prop("disabled", true);
            $('.cashback-info-label').html("Withdrawal is multiple 10 USDT").css('color', 'red');

            }
            
		
			//console.log(summ_usd);
		});

        $('#wallet_type').change(function () {
          let icon = $(this).val();
          // alert(icon);
            if (icon=="USDT.TRC20") {
                $('#walletAddress').val('{{Auth::user()->usdtTrc20}}');
                
            }else{
                $('#walletAddress').val('{{Auth::user()->usdtBep20}}');
            }
			
		});


    })

</script>
