<!DOCTYPE html>
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8"/>
  <title>Lurningo CRM</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>"/>
  
  <!-- END PAGE LEVEL STYLES -->
  <!-- BEGIN THEME STYLES -->
  <link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
  <link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">

  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
  <!-- BEGIN HEADER -->
<?php //phpinfo(); 
$this->load->view('Header_view'); ?>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container" style="width:100%;">
  <!-- BEGIN PAGE HEAD -->
  <div class="container">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="<?php echo base_url('Dashboard');?>" class="linkcss">Home</a><i class="fa fa-circle"></i>
        </li>
        <li>Modify User<i class="fa fa-circle"></i></li>
      </ul>
    </div>
    <!-- END PAGE TITLE -->
  </div>  
   <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container">
      <div class="modal fade bs-modal-lg" id="formview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Details of Candidate</h4>
            </div>
            <div class="modal-body" id="messagebody">   
              <hr>
            </div>
          <div class="modal-footer">
           <button type="button" class="btn default" data-dismiss="modal">Close</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <script type="text/javascript">
  function displaymodal(campaignID)
  {
     document.getElementById('campaignid').value=campaignID;
     jQuery("#formview").modal('show');                       
  }
</script>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
  <div class="col-md-12">
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <h4>User Details</h4>
      </div>
      <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
        <div class="tab-content">

          <div id="assignleads" class="tab-pane fade in active">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row">
             <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <table class="table table-striped table-bordered table-hover" id="sample_1">

                <thead>
                  <tr>
                    <th>Agent Name </th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>User Role</th>
                    <th>Reporting To</th>
                    <th>Status</th>
                    <th>Edit</th>                    
                  </tr>
                </thead>
                <tbody>
                <?php               
                  if(!empty($agentdetails))
                    {
                      
                      foreach($agentdetails as $agentdetails) // user is a class, because we decided in the model to send the results as a class.
                      {
                        echo "<tr>"; 
                        echo "<td>".ucfirst($agentdetails->FirstName." ".$agentdetails->LastName)."</td>";
                        echo "<td>".$agentdetails->UserName."</td>";
                        echo "<td>".$agentdetails->Email."</td>";
                        echo "<td>".ucfirst($agentdetails->MobileNo)."</td>";
                        echo "<td>".ucfirst($agentdetails->UserRole)."</td>";
                        if($agentdetails->ReportingTo==NULL)
                        echo "<td>".ucfirst("None")."</td>";
                        else
                        echo "<td>".ucfirst($agentdetails->ReportingFName." ".$agentdetails->ReportingLName)."</td>";
                         if($agentdetails->IsActive=="1")
                          echo "<td>".ucfirst("Active")."</td>";
                        else
                          echo "<td>".ucfirst("Inactive")."</td>";
                        echo "<td><u><a href=".base_url('User/edituser/'.$agentdetails->SystemUserID)." class='linkcss'><span class='fa fa-edit'></span></a></u></td>";
                        echo "</tr>"; 
                        
                      }
                    }
                ?>
          </tbody>
        </table>
            
          </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
  </div>
 </div>
</div>
<!-- END PAGE CONTENT INNER -->
</form>                         

</div>
</div>
</div>
</div>

</div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<?php

?>
<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="container">
   2016 &copy; Lurningo CRM. <a href="#" target="_blank"></a>
 </div>
</div>
<div class="scroll-to-top">
  <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js');?>"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/table-managed.js');?>"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/components-form-tools.js');?>"></script>
<script>
  jQuery(document).ready(function() {  

   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
ComponentsFormTools.init();
TableManaged.init();
$("#draggable").draggable({
  handle: ".modal-header"
});

});
</script>

<script type="text/javascript">

$.fn.dataTable.ext.errMode = 'none';
                    $("#sample_1").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });
</script>

</body>
<!-- END BODY -->
</html>