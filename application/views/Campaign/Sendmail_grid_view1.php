<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes 
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
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
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<?php //phpinfo(); 
$this->load->view('Header_view'); ?>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <!-- BEGIN PAGE HEAD -->
    <div class="container">
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="<?php echo base_url('Dashboard');?>" class="linkcss">Home</a><i class="fa fa-circle"></i>
        </li>
        <li>
          Mail Status<i class="fa fa-circle"></i>
        </li>
      </ul>
      </div>
      <!-- END PAGE TITLE -->
    </div>  
  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container">
   <div class="modal fade bs-modal-lg" id="modalview" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h4 class="modal-title" id="messagetitle"></h4>
                    </div>
                    <div class="modal-body" id="messagebody" style="max-height:500px;overflow:auto;">
                       
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn default" data-dismiss="modal">Close</button>
                      
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row">
        <div class="col-md-12">
        <div class='panel panel-default'>
        <div class='panel-heading'>
        <h4>Sent Mail Status <p class="pull-right"><strong><?php echo $totalsentmail;?></strong> Mails Sent </p> </h4>
        
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
                <th>Campaign Name</th> 
                <th>Sent On</th>
                <th>Subject</th>
                
                <th>Recipients</th>
                <th>Sent</th>
                 <th>Opened</th>
                 <th>Clickthrough</th>
                 <th>Bounced</th>
                <th>Spam</th>
                </tr>
              </thead>
              <tbody>
                  <?php               
                if(!empty($sendmaildetails))
                 // echo "<pre>";
                  //print_r($sendmaildetails);
                  //echo "</pre>";
    {
      //$j='0';//$page++;
      //$j++;
      foreach($sendmaildetails as $sendmaildetails) // user is a class, because we decided in the model to send the results as a class.
      {
        echo "<tr>"; 
        //echo "<td>".$j."</td>";             
        echo "<td>".ucfirst($sendmaildetails->CampaignName)."</td>";
        $startdate = new DateTime($sendmaildetails->SentOn);
      $s_date = $startdate->format('d-m-Y');
        echo "<td>".$s_date."</td>";
        echo "<td>".ucfirst($sendmaildetails->Subject)."</td>";
        //echo "<td>".$sendmaildetails->SentFrom."</td>";
        echo "<td>".$sendmaildetails->TotalContacts."</td>";
        echo "<td>".$sendmaildetails->sentmails."</td>";
         if($sendmaildetails->openedmails!='0')
            echo "<td><a href='#' onclick='display_opencontactsdetails($sendmaildetails->MailID);'>".$sendmaildetails->openedmails."</a></td>";
         else 
            echo "<td>".$sendmaildetails->openedmails."</td>";
        if($sendmaildetails->clickthrough!='0')
           echo "<td><a href='#' onclick='display_clickcontactsdetails($sendmaildetails->MailID);'>".$sendmaildetails->clickthrough."</a></td>";
        else
        echo "<td>".$sendmaildetails->clickthrough."</td>";
        echo "<td></td>";
        echo "<td></td>";               
        echo "</tr>"; 
        //$j++;
      }
    }
    ?>
     </tbody>
              </table>
              <div class="col-md-12 text-center">
            <?php //echo $pagination; ?>
        </div> 
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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/table-managed.js');?>"></script>



<script>
jQuery(document).ready(function() {  

   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
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
function display_opencontactsdetails(MailID){
  url = '<?php echo base_url()."Sendmail/display_openclicked_contacts/'+MailID+'";?>';
     
    //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {MailID:MailID},
            success: function(response)
            {
              //document.getElementById('classdata').style.display = 'none';
              //$("#tabledisplay").show();
              $("#messagebody").html(response);
              $("#messagetitle").html("<h3>Contact Details</h3>");
              jQuery("#modalview").modal('show');                       
              
               // alert(response);

            
            }
        });
}
function display_clickcontactsdetails(MailID){
  url = '<?php echo base_url()."Sendmail/display_clicked_contacts/'+MailID+'";?>';
     
    //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {MailID:MailID},
            success: function(response)
            {
              //document.getElementById('classdata').style.display = 'none';
              //$("#tabledisplay").show();
              $("#messagebody").html(response);
              $("#messagetitle").html("<h3>Contact Details</h3>");
              jQuery("#modalview").modal('show');                       
              
               // alert(response);

            
            }
        });
}
</script>

</body>
<!-- END BODY -->
</html>
