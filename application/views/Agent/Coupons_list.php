<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <title>Lurningo CRM</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
    <link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="favicon.ico"/>

    <script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
    <script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/pages/scripts/table-managed.js');?>"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
  </head>
  <body>
    <?php $this->load->view('Header_view'); ?><br>
    <div class="container">
      <div class="panel panel-default">
        <div id="successMessage">
         <?php echo $this->session->flashdata('msg');?> 
        </div>
         
        <div class="panel-heading">Manage Discount Coupons</div>
        <div class="panel-body">
          <a href="<?= base_url()?>Generic_coupons/Generate_coupons" class="btn btn-info pull-right">Generate New Coupon Code</a><br>
          <br><br>
          <table id="sample_1" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Sr.no</th>
                <th>Coupon Code</th>
                <th>Discount(Rs.)</th>
                <th>Discount (%)</th>
                <th>Category / Product</th>
                <th>Generated On</th>
                <th>Valid Till</th>
                <th>Total Usage</th>
                <th>Created For</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                foreach ($result as $result) {
				  $firstname = $result->FirstName;
				  $lastname = $result->LastName;
				  if($firstname == '' & $lastname == ''){
					  $name = 'Student';
					 }else{
					  $name = $firstname.' '.$lastname;
				  }
				  $Couponid = $result->CouponID;	
                  $ProductName = $result->ProductName;
                    if ($ProductName == ''){
                      $ProductName = $result->CategoryName;
                      
                      if ($ProductName == ''){
                        $ProductName = 'Applicable for all products';
                      }
                    }

              ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $result->Code; ?></td>
                  <td><?= $result->DiscountAmount; ?></td>
                  <td><?= $result->DiscountRate; ?></td>
                  <td><?= $ProductName; ?></td>
                  <td><?= date('d-m-Y ', $result->CreatedOn); ?></td>
                  <td width="100"><?= date('d-m-Y ', $result->ValidTill); ?></td>
                  <td><?= $result->NumberOfUses. '/' .$result->MaxNumberOfUses; ?></td>
                  <td><?= $name; ?></td>
                  <td><a href='<?= base_url()?>Generic_coupons/Delete_coupon/<?= $Couponid; ?>' onclick=\"return confirm('Delete this record?')\" class="btn btn-sm btn-danger delete">Delete</td>
                </tr>
              <?php
                $i++;
                }
              
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $("#sample_1").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });

      setTimeout(function() {
        $('#successMessage').fadeOut('fast');
      }, 10000); 
      
      $('a.delete').on('click', function() {
        var choice = confirm('Do you really want to delete this record?');
          if(choice === true) {
            return true;
          }
        return false;
      });                         
    </script>
  </body>
</html>


 
