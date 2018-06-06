<!DOCTYPE html>
<html>
  <head>
    <title>CRM | Search Contact</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/scripts/jquery.multiselect.js')?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/css/jquery.multiselect.css');?>">
    
   
  </head>
  <body>
    <?php $this->load->view('Header_view');?>
    <div class="container">
      <?php echo $this->session->flashdata('msg');?>
      <br>
      <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#ums">UMS</a></li>
        <li><a data-toggle="pill" href="#lurningo">Lurningo </a></li>
      </ul>
      
      <div class="tab-content">
          <div id="ums" class="tab-pane fade in active">
            <div class="col-md-12">
        <fieldset class="scheduler-border">
          <legend class="scheduler-border">Search contacts from UMS</legend>
            <div>
            </div>
            <form class="form-inline" method="post" action="<?= base_url()?>Search_contact/Search" role="form">
              <div class="row">
                <div class="col-md-4">
                  <div class="col-md-3">
                    <label class="control-label">University &nbsp;</label>
                  </div>
                  <div class="col-md-9">
                   <select multiple="multiple" placeholder="Select University" class="SlectBox form-control" name="university[]">
                      <?php 
                        foreach ($university as $university) {
                      ?>
                        <option value="<?= $university->ShortName;?>"><?= $university->ShortName;?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
              <div class="col-md-4">
                <div class="col-md-2">
                  <label class="control-label">Course</label>
                </div>
                <div class="col-md-10">
                  <select multiple placeholder="Select course" class="SlectBox form-control" name="course[]">
                    <?php 
                      foreach ($course as $course) {
                    ?>
                      <option value="<?= $course->CourseName;?>"><?= $course->CourseName; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div> 
              <div class="col-md-4">
                   <div class="col-md-4">
                   <label class="control-label">Search by location</label>
                   </div>
                  <div class="col-md-8">
                  <select multiple="multiple" placeholder="Select state" class="SlectBox form-control"  name="State[]">
                        <?php 
                          foreach ($state as $state) {
                        ?>
                          <option value="<?= trim($state->StateName);?>"><?= $state->StateName; ?></option>
                        <?php
                          }
                        ?>
                      </select>
                  </div>
              </div>
              </div><br>
              <div class="row">
                <div class="col-md-4">
                  <div class="col-md-2">
                   <label class="control-label">Gender</label>
                  </div>
                  <div class="col-md-10">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-sm btn-default">
                        <input type="checkbox" name="gender" value="M" /> Male
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="checkbox" name="gender" value="F" /> Female
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="checkbox" name="gender" value="T" /> Other
                      </label>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="col-md-2">
                    <label class="control-label">Age group</label>
                  </div>
                  <div class="col-md-10">
                      <input type="number" class="col-md-6" placeholder="From" name="from" value="" min="1" >
                      <input type="number" class="col-md-6" placeholder="To" name="to" value="">
                  </div>
                </div> 
              
                <div class="col-md-4">
                  <div class="col-md-4">
                    <label class="control-label">Type</label>
                  </div>
                  <div class="col-md-8">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-sm btn-default">
                        <input type="checkbox" name="Type" value="A" />Student
                      </label>
                      <label class="btn btn-sm btn-default">
                        <input type="checkbox" name="Type" value="L" />Leads
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div ><br>
                <center>
                  <input class="form-group btn btn-success" type="submit" name="submit" value="Search">
                </center>
              </div>
            </form>
        </fieldset>  
      </div>
        </div>
        <div id="lurningo" class="tab-pane fade">
          <fieldset>
            <legend>Search Contacts From Lurningo</legend>
            <form method="post" id="lurningo_search_form" action="<?php echo base_url();?>Lurningo_search/Search">
            <div class="col-md-12">
              <div class="col-md-5">
                <div class="col-md-4">
                  <label class="control-label">Campaign:</label>
                </div>
                <div class="col-md-8">
                  <select multiple="multiple" placeholder="Select University" class="SlectBox form-control" name="campaign[]">
                    <?php 
                      foreach ($campaign_list as $campaign_list) {
                    ?>
                      <option value="<?= $campaign_list->CampaignID;?>"><?= $campaign_list->CampaignName;?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="col-md-3">
                  <label class="control-label">Type:</label>
                </div>
                <div class="col-md-8">
                  <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-sm btn-default">
                          <input type="radio" name="Type" value="Prospect" />Prospect
                      </label>
                      <label class="btn btn-sm btn-default">
                          <input type="radio" name="Type" value="Lead" />Lead
                      </label>
                  </div>
                </div>
                  
              </div>
              <div class="col-md-4">
                <div class="col-md-4">
                  <label class="control-label">Lead status</label>
                </div>
                <div class="col-md-8">
                  <select multiple="multiple" placeholder="Select University" class="SlectBox form-control" name="lead_status[]">
                    <?php 
                      foreach ($Lead_status as $Lead_status) {
                    ?>
                      <option value="<?= $Lead_status->LeadStatusID;?>"><?= $Lead_status->LeadStatus;?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div><br><br><br>
            <div class="col-md-12">
              <div class="col-md-4">
               <div class="col-md-4">
                  <label class="control-label">Gender:</label>
                </div>
                <div class="col-md-8">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-sm btn-default">
                      <input type="checkbox" name="gender" value="M" /> Male
                    </label>
                    <label class="btn btn-sm btn-default">
                      <input type="checkbox" name="gender" value="F" /> Female
                    </label>
                    <label class="btn btn-sm btn-default">
                      <input type="checkbox" name="gender" value="T" /> Other
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                  <div class="col-md-5">
                    <label class="control-label">Search by location</label>
                  </div>
                  <div class="col-md-7">
                    <select multiple="multiple" placeholder="Select state" class="SlectBox form-control"  name="State[]">
                      <?php 
                        foreach ($State as $State) {
                      ?>
                        <option value="<?= $State->StateId;?>"><?= $State->StateName; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
               </div>
               <div class="col-md-4">
                <div class="col-md-4">
                  <label class="control-label">Drop Reason</label>
                </div>
                <div class="col-md-8">
                  <select multiple="multiple" class="SlectBox form-control" name="drop_reason[]">
                    <?php 
                      foreach ($Reason as $drop_reason) {
                    ?>
                      <option value="<?= $drop_reason->DropReasonId;?>"><?= $drop_reason->DropReason;?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div >
              <center>
                <input style="margin-top:50px" class="btn btn-success" type="submit" name="submit" value="Search">
              </center>
            </div>
            </form>
          </fieldset>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      //$('select[multiple]').multiselect();
        $('select[multiple]').multiselect({
          columns: 1,
          search:true,
          texts: {
              placeholder: 'Select options'
          }
        });
      </script>
    <script type="text/javascript">
      $(document).ready(function(){
        var form=$("#lurningo_search_form");
        $("#submit").click(function(){
          $.ajax({
            type: "POST",
            data:form.serialize(),
            url:"'.base_url().'Lurningo_search/Search",
            beforeSend: function() {    
              alert("Processing");
            },
            success: function(data) {
              $("#sample_1").text(data);
            }
        });
      });
      });
    </script>  
  </body>
</html>
