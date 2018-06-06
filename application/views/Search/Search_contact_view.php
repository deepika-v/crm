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
    
    <div class="col-md-12">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Search contacts from UMS</legend>
          <div>
    <?php echo $this->session->flashdata('msg');?>
    </div>
          <form class="form-inline" method="post" action="Search_contact/Search" role="form">
            <div class="row">
            <div class="col-md-4">
                 <div class="col-md-2">
                 <label class="control-label">University&nbsp;&nbsp;&nbsp;&nbsp;</label>
                 </div>
                <div class="col-md-10">
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
                 <label class="control-label">Location</label>
                 </div>
                <div class="col-md-8">
                <select multiple="multiple" placeholder="Select state" class="SlectBox form-control"  name="State[]">
                      <?php 
                        foreach ($state as $state) {
                      ?>
                        <option value="<?= $state->StateName;?>"><?= $state->StateName; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                </div>
            </div>
            </div>
            <br>
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
                 <label class="control-label">Age Group</label>
                 </div>
                <div class="col-md-10">
                    <input type="number" class="col-md-3" placeholder="From" name="from" value="">
                    <input type="number" class="col-md-3" placeholder="To" name="to" value="">
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
<script type="text/javascript">
  //$('select[multiple]').multiselect();
  $('select[multiple]').multiselect({
    columns: 2,
    search:true,
    texts: {
        placeholder: 'Select options'
    }
});

</script>
    
    <?php //$this->load->view('Search/pagination_result');?>
  </body>
</html>
