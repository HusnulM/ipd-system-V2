<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" id="div-po-item">
                    <div class="header">
                        <h2>
                            <?= $data['menu']; ?>
                        </h2>
                        <ul class="header-dropdown m-r--5">                                
                            <!-- <a href="<?= BASEURL; ?>/exportdata/exportmovement/<?= $data['strdate']; ?>/<?= $data['enddate']; ?>/<?= $data['movement']; ?>" target="_blank" class="btn bg-teal">
                               <i class="material-icons">cloud_download</i> EXPORT DATA
                            </a> -->

                            <a href="<?= BASEURL; ?>/reports/movement" type="button" class="btn bg-teal">
                                <i class="material-icons">backspace</i> <span>BACK</span>
                            </a>
                        </ul>
                    </div>
                    <div class="body">                                
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:100%;font-size:13px;">
                                    <thead>
                                        <tr>
                                            <th>Issuance Number</th>
                                            <th>POKANON QR CODE</th>
                                            <th>Part Number</th>
                                            <th>Lot Number</th>
				 	    <!--<th>Location</th>-->
                                            <!--<th>Quantity</th> -->
 					    <th>Part Location</th>
                                            <th>Issuance Date</th>
                                            <th>Ageing Status</th>
                                            <th>FT Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; ?>
                                        <?php foreach ($data['rdata'] as $prdata) : ?>
                                            <?php $no++; ?>
                                            <tr>
                                                <td><?= $prdata['issuance_number']; ?></td>
                                                <td><?= $prdata['barcode_serial']; ?></td>
                                                <td><?= $prdata['part_number']; ?></td>
                                                <td><?= $prdata['part_lot']; ?></td>
						<td><?= $prdata['assy_location']; ?></td>
                                                <!-- <td style="text-align:right;">
                                                    <?php if (strpos($prdata['quantity'], '.000') !== false) {
                                                        echo number_format($prdata['quantity'], 0, ',', '.');;
                                                    }else{
                                                        echo number_format($prdata['quantity'], 3, ',', '.');;
                                                    } ?>   
                                                </td> 
						<td><?= $prdata['assy_location']; ?></td>-->
                                                <td><?= $prdata['issueance_date']; ?></td>
                                                <td><?= $prdata['ageing_status']; ?></td>
                                                <td><?= $prdata['ft_status']; ?></td>
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
</section>
    