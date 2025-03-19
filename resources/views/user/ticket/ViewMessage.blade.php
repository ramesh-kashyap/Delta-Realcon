

<div class="content-body">
    <div class="container-fluid">
     
  
  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ticket Status</h4>
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
                                        <?php if(is_array($open_ticket_msg) || is_object($open_ticket_msg)){ ?>
                                            <?php $count= 0; ?>
                                            <?php foreach ($open_ticket_msg as $item): ?>
                                            <?php if($item->reply_by == 'user'){ }  ?>

                                            <h5 class="form-header" style="width: 274px; background:#e92266;padding: 7px;color: #fff;border-radius: 10px;"> <?= $item->category ?> (<?=$item->gen_date?>)</h5>
                                            <br>
                                           <p class="comp_bank_p" style="color:#fff" ><?= $item->msg ?></p>
                                           <p class="text-right" style="margin-right: 30px;color:#fff;margin-left:300px"><?=($item->reply_by == 'admin')? 'Admin' : 'You'?></p>
                                           <?php endforeach; ?>
                                           <?php } ?>
                                       
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
    </div></div></div>