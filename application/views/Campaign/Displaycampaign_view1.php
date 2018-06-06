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
<div class="page-container">
  <!-- BEGIN PAGE HEAD -->
  <div class="container">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="<?php echo base_url('Dashboard');?>" class="linkcss">Home</a><i class="fa fa-circle"></i>
        </li>
        <li>Display Campaigns<i class="fa fa-circle"></i></li>
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
              
              <label class="col-md-3 control-label">Redirect Url<span class="required">*</span></label>
              <div class="col-md-9">
                <input type="text" class="form-control input-circle" placeholder="Enter url " id="redirecturl" name="redirecturl"><br>
              </div>
              <div class="col-md-12">
                
                <fieldset>
                  <legend>Sample Form </legend>
                  <form action="#" method="post" id="campaignform" name="campaignform" onsubmit="">
                    <label>Candidate Name:-</label><input type="text" placeholder="Enter first name" id="userfname" name="userfname"><input type = "text" placeholder="Enter Last name" id="userlname" name="userlname"><br>
                    <input type="text" id="campaignid" name="campaignid" value="" hidden >
                    <label>Gender:-</label><select id="usergender" name="usergender">
                    <option value="0">--Select--</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                  </select><br>
                  <label>Date of Birth:-</label><input type="text" id="userdob" name="userdob" placeholder="dd/mm/yyyy"></br>
                  <label>Email:-</label><input type="email" placeholder="Enter Email" id="useremail" name="useremail"></br>
                  <label>Phone:-</label><input type="text" placeholder="Enter Phone number" id="userphone" name="userphone"><br>
                  <input type="checkbox" id="userterms" name="userterms"> I accept Lurningo <a href="https://www.lurningo.com/Account/TermsAndConditions">Terms and Conditions</a><br>
                  <input type="submit" id="submitform" name="submitform"  value="Submit"><br>
                </form>
              </fieldset>
            </div>
            <hr>
            <a href="#"  class="btn btn-warning" onclick="displayeditor();">View Source</a> 
            <textarea id="viewsource" rows="10" cols="100" style="display:none;">
             
            </textarea> 
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
function displayeditor()
{
  var redirecturl = document.getElementById('redirecturl').value.trim();
  var campaignid = document.getElementById('campaignid').value;
  if (redirecturl=="") alert("Enter redirect url");
  else
  {
    var myRegExp = /^(((ht|f){1}(tp|tps:[/][/]){1})|((www.){1}))[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+$/;
    if (!myRegExp.test(redirecturl))
    {
      alert("Not a valid URL.");
    }
    else
    {
         document.getElementById('viewsource').style.display="block";
         txtDATA = '<html>\n<head>\n'+
         '<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"></link>\n'+
         '<script src="https://code.jquery.com/jquery-1.10.2.js">'+
         '</'+'script>\n'+
         '<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"> </'+'script>\n'+
         '<script>\n'+
         '$(function()\n'+
          ' {\n'+
          '$( "#userdob" ).datepicker({\n'+
            'maxDate: "+0D",\n'+
            'dateFormat:"dd-mm-yyyy"\n'+
            '});\n'+
        '$("#userdob").datepicker("option","dateFormat", "dd/mm/yy");});\n'+
        'function validate(){\n'+
        'var phoneno = /^[1-9]{1}[0-9]{9}$/;'+
        'var dob = /^(0[1-9]|[12][0-9]|3[01])[\- \/.](?:(0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/;\n'+
        'var error = "";\n'+
        'if(document.getElementById("userfname").value.trim() == "") error += "Enter First Name\\n";\n'+
        'if(document.getElementById("userlname").value.trim() == "") error += "Enter Last Name\\n";\n'+
        'if(document.getElementById("usergender").value == "0") error += "Select Gender\\n";\n'+
        'if(document.getElementById("useremail").value.trim() == "") error += "Enter Email\\n";\n'+
        'if(document.getElementById("userphone").value.trim() == "") error += "Enter Phone Number\\n";\n'+
        'if(!document.getElementById("userphone").value.trim().match(phoneno)) error += "Enter valid Phone Number\\n"\n'+
        'if(document.getElementById("userdob").value.trim() == "")error += "Enter Date of Birth\\n";\n'+
        'if(!document.getElementById("userdob").value.trim().match(dob)) error += "Enter valid Date of Birth\\n";\n'+
        'if(document.getElementById("userterms").checked==false) error += "Please accept Lurningo Terms and Conditions";\n'+
        'if(error != ""){'+
        'alert(error);\n'+
        'return false;\n'+
        '}\n'+
        'else\n'+
        'return true;\n'+
        '}\n'+
        '</'+'script>\n'+
        '</'+'head>\n'+
        '<form action="<?php echo base_url("Leadapi");?>" method="post" id="campaignform" name="campaignform" onsubmit="return(validate());">\n'+
        '<input type="hidden" id="campaignid" name="campaignid" value="'+campaignid+'">\n'+
        '<input type="hidden" id="redirecturl" name="redirecturl" value="'+redirecturl+'">\n'+
        '<input type="hidden" id="apikey" name="apikey" value="Lurningo_API_KEY" hidden>\n'+
        'Name:\n'+
        '<input type="text" placeholder="First name" id="userfname" name="userfname"> <input type = "text" placeholder="Last name" id="userlname" name="userlname">'+
        '<br /><br />\n'+
        '<label>Gender</label>'+ 
        '<select id="usergender" name="usergender">\n'+
        '<option value="0">Select</option>\n'+
        '<option value="M">Male</option>\n'+
        '<option value="F">Female</option>\n'+
        '<option value="O">Other</option>\n'+
        '</select>\n'+
        '<br /><br>\n'+
        '<label>Date of Birth</label> <input type="text" id="userdob" name="userdob" placeholder="dd-mm-yyyy">\n'+
        '<br /><br />\n'+
        '<label>Email</label> <input type="email" placeholder="Enter Email" id="useremail" name="useremail">\n'+
        '<br /><br />\n'+
        '<label>Phone</label> <input type="text" placeholder="Enter Phone number" id="userphone" name="userphone">\n'+
        '<br /><br />\n'+
        '<input type="checkbox" id="userterms" name="userterms"> I accept Lurningo <a href="https://www.lurningo.com/Account/TermsAndConditions">Terms and Conditions</a>\n'+
        '<br /><br />\n'+
        '<input type="submit" id="submitform" name="submitform"  value="Submit"><br>\n'+
        '</form></html>';
       document.getElementById('viewsource').value=txtDATA;
   }
  }
}
</script>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
  <div class="col-md-12">
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <h4>Campaign Details<p class="pull-right"><strong><?php echo $totalcampaignrun;?></strong> Campaigns </p></h4>
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
                    <th>Campaign Name </th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Campaign Owner</th>
                    <th>Contacts</th>
                    <th>Prospects</th>
                    <th>Leads</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Download </th>
                    <th>Form</th>                
                  </tr>
                </thead>
                <tbody>
                <?php               
                  if(!empty($campaigndetails))
                    {
                      
                      foreach($campaigndetails as $campaigndetails) // user is a class, because we decided in the model to send the results as a class.
                      {
                        echo "<tr>"; 
                        echo "<td>".ucfirst($campaigndetails->CampaignName)."</td>";
                        $startdate = new DateTime($campaigndetails->StartDate);
                        $s_date = $startdate->format('d-m-Y');
                        echo "<td>".$s_date."</td>";
                        $enddate = new DateTime($campaigndetails->EndDate);
                        $e_date = $enddate->format('d-m-Y');

                        echo "<td>".$e_date."</td>";
                        echo "<td>".ucfirst($campaigndetails->UserName)."</td>";
                        echo "<td>".ucfirst($campaigndetails->totalcontacts)."</td>";
                        echo "<td>".ucfirst($campaigndetails->prospectcount)."</td>";
                        echo "<td>".ucfirst($campaigndetails->leadcount)."</td>";
                        echo "<td>".ucfirst($campaigndetails->Status)."</td>";
                        echo "<td><u><a href=".base_url('Displaycampaign/edit/'.$campaigndetails->CampaignID)." class='linkcss'><span class='fa fa-edit'></span></a></u></td>";
                        if($campaigndetails->totalcontacts=="0")
                            echo "<td align='center'><p><i class='fa fa-download' aria-hidden='true'></i></p></td>";
                        else
                          echo "<td align='center'><a href=".base_url('Displaycampaign/generatecsv/'.$campaigndetails->CampaignID)." class='linkcss'><i class='fa fa-download' aria-hidden='true'></i></a></td>";
                        echo "<td align='center'><a href='#' onclick='displaymodal(".$campaigndetails->CampaignID.")' class='linkcss'><span class='fa fa-file-code-o'></span></a></td>";               
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
</script>

</body>
<!-- END BODY -->
</html>