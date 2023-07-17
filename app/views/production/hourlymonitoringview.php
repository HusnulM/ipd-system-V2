<META HTTP-EQUIV="Refresh" Content="20; <?= BASEURL; ?>/production/hourlymonitoringview/data?plandate=<?= $data['plandate']; ?>&prodline=<?= $data['prodline']; ?>&shift=<?= $data['shift']; ?>">

<div class="content" style="margin-top:60px;">
    <div class="container-fluid">   
        <div id="msg-alert">
            <?php
                Flasher::msgInfo();
            ?>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h3><?= $data['menu']; ?></h3>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">PLAN DATE</label>
                                    <input type="text" readonly class="form-control" value="<?= $data['plandate']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">PRODUCTION LINE</label>
                                    <input type="text" readonly class="form-control" value="<?= $data['prodline']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">SHIFT</label>
                                    <?php if($data['shift'] === '1'): ?>
                                        <input type="text" readonly class="form-control" value="Day Shift">
                                    <?php else: ?>
                                        <input type="text" readonly class="form-control" value="Night Shift">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <th>NO.</th>
                                        <th>Time</th>
                                        <th style="width:300px;">Model</th>
                                        <th style="text-align:right;">Target Output</th>
                                        <th style="text-align:right;">Actual Output</th>
                                        <th style="text-align:right;">Variance</th>
                                    </thead>
                                    <tbody class="mainbody" id="tbl-plan-item">
                                        <?php $count = 0; ?>
                                        <?php foreach($data['rdata'] as $row) : ?>
                                            <tr>
                                                <td><?= $count = $count+1; ?></td>
                                                <td><?= $row['hourly_time']; ?></td>
                                                <td><?= $row['model']; ?></td>
                                                <td style="text-align:right;"><?= $row['target_qty']; ?></td>
                                                <td style="text-align:right;"><?= $row['output_qty']; ?></td>
                                                <td style="text-align:right;"><?= $row['variance_qty']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>                                    
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>        
    </div>     
</div>


    <script>
        $(document).ready(function() {
            // $('#report-data').DataTable( {
            //     // "scrollY": 200,
            //     // "scrollX": true,
            //     // "pageResize": true
            // } );

            $('#leftsidebar').hide();
        } );
    </script>