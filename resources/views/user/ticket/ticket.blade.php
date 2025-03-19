@include('layouts.upnl.header')

<div class="content-body">
    <div class="container-fluid">
      @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="d-flex row mt-5 px-5">

    <div class="col-xl-6 col-12 text-center">
        <img id="support" class="img-fluid" src="{{ asset('') }}user/images/help.webp">
      </div>
      <div class="card col-xl-6 col-12">
        <h3 class="fw-bold mb-3 text-success mt-3">
          Raise A Ticket
        </h3>
        <form method="POST" action="{{ route('user.SubmitTicket') }}">
          @csrf
          <label for="category" class="form-label">Select Subject</label>
          <select class="default-select form-control wide" name="category">
            <option selected="DEPOSIT NOT CREDITED">DEPOSIT NOT CREDITED</option>
            <option value="WITHDRAWAL NOT CREDITED">WITHDRAWAL NOT CREDITED</option>
            <option value="WITHDRAWAL REJECTED">WITHDRAWAL REJECTED</option>
            <option value="DEPOSIT REJECTED">DEPOSIT REJECTED</option>
            <option value="LESS AMOUNT CREDITED AFTER WITHDRAWAL.">LESS AMOUNT CREDITED AFTER WITHDRAWAL.</option>
            <option value="OTHERS">OTHERS</option>
          </select>
          <div class="mt-2">
            <textarea class="form-control" placeholder="Describe The Issue" name="message" required style="width: 100%;" maxlength="150" minlength="10" rows="6"></textarea>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-primary mt-3 mb-3">Raise A Ticket</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
  <script>
    let clearmsg = () => {
      const myTimeout = setTimeout(function() {
        document.getElementById("msg").innerHTML = "";
      }, 3000);
    }
  </script>
@include('layouts.upnl.footer')
