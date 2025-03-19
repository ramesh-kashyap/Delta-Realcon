<div class="container-fluid main-content settings px-2 px-lg-4">
    <!-- Tables -->
    <div class="row my-2 g-3 g-lg-4 pb-3 settings-inner">

   

        <div class="col-sm-6 col-lg-6 col-xl-6 col-xxl-7">
            <div class="settings-tab">
                <h5 class="mb-0">Socail Media Activites </h5>
    

                <div class="tab-content pt-2" id="pills-tabContent">
                   

                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" tabindex="0">
                        <form action="{{ route('user.submitActivity') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                           

                                <div class="col-md-12">
                                    <label class="fw-semibold mb-2 mt-3" for="fname">Media URL</label>
                                    <input type="text" name="url" id="pkg_amount"   class="form-control"  required=""  placeholder="Media URL"/>
                                </div>

                                <div class="col-12">

                                    <div class="mt-4 d-flex gap-3">
                                        <button type="submit" class="primary-btn-lg submit-btn">Submit</button>
                                     
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="mainchart col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="activity">
                <div class="row g-3">
                    <div class="col-md-6">
                        <br>
                        <h5 class="mb-0">Reports</h5>
                    </div>

                    <div class="tab-content" id="pills-tabContent2">

                        <div class="tab-pane fade show active" id="price" role="tabpanel" tabindex="0">
                            <div class="recent-contact pb-2 pt-3">
                                <table id="example" class="display">
                                    <thead>
                                        <tr>
                                            <th>SR</th>
                                            <th>Media URL</th>
                                            <th>Date & Time</th>
                                       
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($activities) || is_object($activities)){ ?>

                                        <?php $cnt = 0; ?>
                                        @foreach ($activities as $value)
                                            <tr>
                                                <td><?= $cnt += 1 ?></td>
                                                <td>{{ $value->url }}</td>
                                         
                                                <td>{{ date('D, d M Y', strtotime($value->created_at)) }} </td>

                                                <td><span
                                                        class="{{ $value->status == 'Approved' ? 'green' : 'red' }}-tag">{{ $value->status }}</span>
                                                </td>


                                            </tr>
                                        @endforeach

                                        <?php }?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
