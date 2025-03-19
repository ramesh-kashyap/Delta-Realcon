<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <div>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('user.edit-password') }}">
                            @csrf

                            <!-- New Password Field -->
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" name="password" required>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm New Password" name="password_confirmation" required>
                            </div>

                            <!-- Hidden Email Field -->
                            <input type="hidden" id="inputemail" value="{{ Auth::user()->email }}" name="email">

                            <!-- Verification Code Field -->
                            <div class="mb-3">
                                <label class="form-label">Verification Code</label>
                                <input type="text" class="form-control" name="code" placeholder="Enter Verification Code" required>

                                <!-- Get Code / Resend Code buttons -->
                                <div class="first-code-send text-primary" style="cursor: pointer; font-size: 15px; margin-top: 10px;">Get Code</div>
                                <span class="resend-btn code-btn text-primary" style="cursor: pointer; display: none; margin-top: 10px;">Resend Code</span>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



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



        // Optional: Handle Resend Button Click
        $('.resend-btn').click(function(e) {
            $('.first-code-send').trigger('click'); // Simulate a click on the original send button
        });


    });
</script>