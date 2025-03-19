<div class="content-body">
    <div class="container-fluid">

        <style>
            .text-info {
                --bs-text-opacity: 1;
                color: rgb(240 240 240) !important;
            }
        </style>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Profile</h4>
                </div>
                <div class="card-body">
                    <div>
                        <p>Referal ID-<span class="text-info"></span></p>
                        <p>Registration Date -<span class="text-info">{{ date('m/d/Y h:i:s a',strtotime($profile_data->created_at)) }}</span></p>
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

                        <form action="{{ route('user.update-profile') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">User Name-</label>
                                <input type="text" class="form-control" placeholder="Enter Name" value="{{ $profile_data->name }}" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address-</label>
                                <input type="text" class="form-control" placeholder="Enter Email Address" value="{{ $profile_data->email }}" name="email">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>