<div class="content-body" style="min-height: 732px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="ms-2 mb-0 mt-2">Roi Income</h3>
                        <div class="header-right">
                            <div class="input-group search-area ms-auto d-inline-flex">
                                <input type="text" id="search-input" class="form-control" placeholder="Search here">
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
                                        <th scope="col">Sr No</th>
                                        <th scope="col">User Id</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Remarks</th>
                                        <!-- <th scope="col">payment system</th> -->
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @php $cnt = $level_income->perPage() * ($level_income->currentPage() - 1); @endphp
                                    @foreach ($level_income as $value)
                                    <tr>
                                        <td>{{ $cnt + $loop->iteration }}</td>
                                        <td>{{ $value->user_id_fk }}</td>
                                        <td>{{ $value->amt }}</td>
                                        <td class="fontBold text-success">+{{ $value->comm }} {{ generalDetail()->cur_text }}</td>
                                        <td>{{ $value->remarks }}</td>
                                        <td>{{ date('D, d M Y H:i:s', strtotime($value->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $level_income->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>