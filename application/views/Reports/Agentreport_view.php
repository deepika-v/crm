<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>CRM | Agent report</title>
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
<link  href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-select/bootstrap-select.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/jquery-multi-select/css/multi-select.css');?>"/>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/clockface/css/clockface.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
<!-- END THEME STYLES -->
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>   
 <style type="text/css">
  input[readonly].default-cursor {
    cursor: default;
    background-color: #fff;

}


 </style>   

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<?php $this->load->view('Header_view');

//echo "<pre>";
  //print_r($categorylist);
//echo "</pre>";
 ?>
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
          Agent wise report<i class="fa fa-circle"></i>
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
        <div class='panel-heading'><h4>Agent wise Summary Report</h4>
         </div>
        <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
         <div class="tab-content">
              <div id="createcampaign" class="tab-pane fade in active">
                 <div class="portlet-body form">
                   <hr>
                   <div class="row">
                     <div class="col-md-12">
                     <?php $date = new DateTime("-1 months");
                              $from_date =$date->format("d-m-Y");
                              $date1 = new DateTime();
                              $to_date = $date1->format("d-m-Y")?>
                      <div class="form-group">
                           <label class="col-md-2 control-label">Lead Date<span class="required">*</span></label>
                          <div class="col-md-4">
                         <div class="input-group input-large date-picker input-daterange " data-date-format="dd-mm-yyyy" data-date-end-date="+0d">
                        <span class="input-group-addon">From</span>
                        <input type="text" class="form-control default-cursor " name="datefrom" id="datefrom" value="<?php echo $from_date;?>" readonly>
                        <span class="input-group-addon">  to </span>
                        <input type="text" class="form-control default-cursor " name="dateto" id="dateto" value="<?php echo $to_date;?>"  readonly>
                      </div>
                      <span class="help-block" id="fromdate_error"> </span><span class="help-block" id="todate_error"></span>
                       </div>
                         <button type="submit" class="btn btn-circle blue" onclick="displaytable()">Search</button>
                         <a href="#" type="submit" class="btn btn-circle blue"  id="download_csv">Download CSV</a>
                         </div> 
                        </div>
                   </div> 
                  <div id="classdata"></div>    
                  <div id="tabledisplay"> 
        
              <?php               
                
    ?>
            
              
        </div>
                      
                     
                    
                    <!-- END FORM-->
                  </div>
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
<script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>


<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
ComponentsPickers.init();
ComponentsDropdowns.init();
//UIGeneral.init();
$('#download_csv').attr("disabled", true);
$("#tabledisplay").hide();
$("#classdata").hide();
 


});

function displaytable()
{
  document.getElementById('tabledisplay').style.display = 'none';
  from_date = document.getElementById('datefrom').value;
  to_date = document.getElementById('dateto').value;
  //alert(from_date);
  //alert(to_date);
  if(from_date == '' && to_date == '' )
  {
    $("#fromdate_error").html("Select Date");

  }
  else if(from_date == '') 
    {
      //alert("in if");
      $("#fromdate_error").html("From date required");
    }
   else if(to_date == '')
  { //alert("in else if");
   $("#todate_error").html("To date required");
  }
  if(from_date != '' && to_date != '')
  {
    //alert("in else ");
    document.getElementById('classdata').style.display = 'block';
    document.getElementById('classdata').innerHTML="<div id='classdata-image'> <img src='<?php echo base_url('assets/images/loader1.gif');?>'><h4><strong>Loading....</strong></h4></div> ";
     url = '<?php echo base_url()."Reports/agent_report_display/'+from_date+'/'+to_date+'";?>';
    //alert(url);
     $.ajax({
            type: 'POST', 
            url: url,
            data: {fromdate: from_date, todate: to_date},
            success: function(response)
            {
              document.getElementById('classdata').style.display = 'none';
              $("#tabledisplay").show();
              $("#tabledisplay").html(response);
                csvurl = "<?php echo base_url().'Reports/generate_agent_csv/';?>";
                    document.getElementById("download_csv").href = csvurl;
                    $('#download_csv').attr("disabled", false);
               // alert(response);

            
            }
        });

  }

 // $("#tabledisplay").show();
}
function display_totalcontactsdetails(agentid)
{
  //alert("in function");
  from_date = document.getElementById('datefrom').value;
  to_date = document.getElementById('dateto').value;
   document.getElementById('classdata').style.display = 'block';
    document.getElementById('classdata').innerHTML="<img src='<?php echo base_url('assets/images/loader1.gif');?>'><h4><strong>Loading....</strong></h4> ";
    url = '<?php echo base_url()."Reports/agent_report_display_totalcontacts/'+from_date+'/'+to_date+'/'+agentid+'";?>';
     
    //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {fromdate: from_date, todate: to_date},
            success: function(response)
            {
              document.getElementById('classdata').style.display = 'none';
               $.fn.dataTable.ext.errMode = 'none';
                    $("#sample_2").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });
              //$("#tabledisplay").show();
              $("#messagebody").html(response);
              $("#messagetitle").html("<h3>Details of all contacts</h3>");
              jQuery("#modalview").modal('show');                       
              
               // alert(response);

            
            }
        });

}
function display_opencontactsdetails(agentid)
{
  //alert("in function");
  from_date = document.getElementById('datefrom').value;
  to_date = document.getElementById('dateto').value;
   document.getElementById('classdata').style.display = 'block';
    document.getElementById('classdata').innerHTML="<img src='<?php echo base_url('assets/images/loader1.gif');?>'><h4><strong>Loading....</strong></h4> ";
    url = '<?php echo base_url()."Reports/agent_report_display_opencontacts/'+from_date+'/'+to_date+'/'+agentid+'";?>';
     
    //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {fromdate: from_date, todate: to_date},
            success: function(response)
            {
              document.getElementById('classdata').style.display = 'none';
              //$("#tabledisplay").show();
               $.fn.dataTable.ext.errMode = 'none';
                    $("#sample_2").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });
              $("#messagebody").html(response);
              $("#messagetitle").html("<h4>Details of open contacts</h4>");
              jQuery("#modalview").modal('show');                       
              
               // alert(response);

            
            }
        });

}
function display_closedcontactsdetails(agentid)
{
  //alert("in function");
  from_date = document.getElementById('datefrom').value;
  to_date = document.getElementById('dateto').value;
   document.getElementById('classdata').style.display = 'block';
    document.getElementById('classdata').innerHTML="<img src='<?php echo base_url('assets/images/loader1.gif');?>'><h4><strong>Loading....</strong></h4> ";
    url = '<?php echo base_url()."Reports/agent_report_display_closedcontacts/'+from_date+'/'+to_date+'/'+agentid+'";?>';
     
    //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {fromdate: from_date, todate: to_date},
            success: function(response)
            {
              document.getElementById('classdata').style.display = 'none';
                $('[data-toggle="popover"]').popover({
        placement : 'top'
    });  
               $.fn.dataTable.ext.errMode = 'none';
                    $("#sample_2").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 
                      

                    });
              //$("#tabledisplay").show();
              $("#messagebody").html(response);
              $("#messagetitle").html("<h4>Details of closed contacts</h4>");
              jQuery("#modalview").modal('show');                       
              
               // alert(response);

            
            }
        });

}
function display_droppedcontactsdetails(agentid)
{
  //alert("in function");
  from_date = document.getElementById('datefrom').value;
  to_date = document.getElementById('dateto').value;
   document.getElementById('classdata').style.display = 'block';
    document.getElementById('classdata').innerHTML="<img src='<?php echo base_url('assets/images/loader1.gif');?>'><h4><strong>Loading....</strong></h4> ";
    url = '<?php echo base_url()."Reports/agent_report_display_droppedcontacts/'+from_date+'/'+to_date+'/'+agentid+'";?>';
     
    //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {fromdate: from_date, todate: to_date},
            success: function(response)
            {
              document.getElementById('classdata').style.display = 'none';
              $('[data-toggle="popover"]').popover({
                  placement : 'top'
                });
               $.fn.dataTable.ext.errMode = 'none';
                    $("#sample_2").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });
              //$("#tabledisplay").show();
              $("#messagebody").html(response);
              $("#messagetitle").html("<h4>Details of dropped contacts</h4>");
              jQuery("#modalview").modal('show');                       
              
               // alert(response);

            
            }
        });

}



   </script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/clockface/js/clockface.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/moment.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/admin/pages/scripts/components-pickers.js');?>"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/components-dropdowns.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-select/bootstrap-select.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>