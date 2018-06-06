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
      
      <h4 style="display: -webkit-inline-box;">Showing result for:</h4>
      <?php 
		  if ($campaign_name==''&& $lead_status==''&& $state =='' && $drop_reason=='' && $type=='' && $gender =='' ){
				echo "<h6>All records</h6>";
		 }
          if ($campaign_name != ''){
            $sql = $this->db->query('select CampaignName from crm_campaign where CampaignID in('.$campaign_name.')')->result();
            echo "<h6>Campaign Name:";
            foreach ($sql as $row) {
              echo $row->CampaignName.',';
            }
            echo "</h6>";
          }
          if ($lead_status != ''){
            $sql = $this->db->query('select LeadStatus from crm_leadstatus where LeadStatusID in('.$lead_status.')')->result();
            echo "<h6>Lead Status:";
            foreach ($sql as $row) {
              echo $row->LeadStatus.',';
            }
            echo "</h6>";
          }
          if ($state != ''){
            $sql = $this->db->query('select StateName from StateMst where StateId in('.$state.')')->result();
            echo "<h6>State:";
            foreach ($sql as $row) {
              echo $row->StateName.',';
            }
            echo "</h6>";
          }
          if ($drop_reason != ''){
            $sql = $this->db->query('select DropReason from crm_dropreasons where DropReasonId in('.$drop_reason.')')->result();
            echo "<h6>Drop Reason:";
            foreach ($sql as $row) {
              echo $row->DropReason.',';
            }
            echo "</h6>";
          }
          if($type != ''){
            echo "<h6>Type: ".$type."</h6>";
          }
          if($gender != ''){
            echo "<h6>Gender: ".$gender."</h6>";
          }

          
      ?>

      <p><a style='margin-right:10px;' href='<?= base_url(); ?>Lurningo_search'>Refine Search</a></p>

      <h4>Total match found : <?= $count;?> (in   <?php echo $this->benchmark->elapsed_time();?> seconds)</h4>
   
    
    <form method="post" action="<?= base_url()?>Lurningo_search/Add_Campaign_Contacts">
      
		<div class="form-inline" style="margin-bottom:50px;">
          <div class="input-group">
            <span class="input-group-addon">Select Campaign</span>
              <div class="form-group">
                <select class="form-control" name="campaign" required>
                  <option value="" disabled="" selected="">Select Campaign</option>
                    <?php foreach ($campaign as $campaign) { echo "<option value=".$campaign->CampaignID.">".$campaign->CampaignName."</option>"; } ?>
                </select>           
              </div>
              <div class="form-group">
                &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-info" name="submit" value="Submit">Map Selected Contacts</button>
                <input class="btn btn-info" type="submit" name="Add_all_contact" value="Map All Contacts">
              </div>
            </div>
        </div>
        <table  class="table table-bordered">
          <thead>
            <tr>
              <th><input type="checkbox" id="select_all" checked="checked"></th>
              <th>Name</th>
              <th>State</th>
              <th>Campaign Name</th>
              <th>Lead Status</th>
            </tr>
          </thead>
          <tbody>

            <?php
              //print_r($result);
              foreach ($result as $result) {
            ?>     
            <tr>
              <td><input type="checkbox" name="ContactsID[]" checked="checked" value="<?= $result->ContactsID; ?>"></td>
              <td><?= $result->FirstName.' '.$result->LastName; ?></td>
              <td><?= $result->StateName?></td>
              <td><?= $result->CampaignName?></td>
              <td><?= $result->LeadStatus?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <input type="hidden" value="<?= $query; ?>" name="query">
        <div class="row">
          <div class="col-md-12 text-center">
              <?php echo $pagination; ?>
          </div>
        </div>
        
      </div>
    </form>

    <div class="page-footer">
      <div class="container">
         2016 &copy; Lurningo CRM. <a href="#" target="_blank"></a>
      </div>
    </div>
  
		<script type="text/javascript">
      $("#sample_1").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });
       $('#select_all').click(function(event)
                     {
                       if (this.checked) 
                        {
                          // Iterate each checkbox
                          $(':checkbox').each(function()
                           {
                              this.checked = true;
                           });
                        }
                        else
                        {
                          $(':checkbox').each(function()
                           {
                              this.checked = false;
                           });
                        }
                     });               
    </script>
	</body>
</html>	

