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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
    <script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/scripts/jquery.sumoselect.js')?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/css/sumoselect.css');?>">
   
    <style type="text/css">
    .result{
      border: none;
      padding: 0;
      width: 100%;

    }
    .form-control{
        margin-right: 30px; 
      }
      .col-md-4 , .col-md-6 , .col-md-2{
        margin-top: 5px;
      }

     
    </style>
  </head>
<body>  
<?php $this->load->view('Header_view');?>
<div class="col-md-12">

    <div>
      
      <h4 style="display: -webkit-inline-box;">Showing result for:</h4>
      <?php

      $data['university'] = $this->session->userdata('university');
      $university ='';
      if ($data['university'] != ''){
      //$university = implode(',', $data['university']);
      echo "<label style='padding-left:10px'>University :</label>".$data['university']."";
      }
      
      $course = '';
      $data['course'] = $this->session->userdata('course');
      if ($data['course'] != ''){
      //$course = implode(',', $data['course']);
      echo "<label style='padding-left:10px'>Course :</label>".$data['course']."";
      }

      $category = '';
      $data['category'] = $this->session->userdata('category');
      if ($data['category'] != ''){
     // $category = implode(',', $data['category']);
      echo "<label style='padding-left:10px'>Category :</label>".$data['category']."";
      }

      $city = '';
      $data['state'] = $this->session->userdata('state');
      if ($data['state'] != ''){
      //$city = implode(',', $data['city']);
      echo "<label style='padding-left:10px'>State :</label>".$data['state']."";
      }

      $type = '';
      if ($this->session->userdata('type') != ''){
        if($this->session->userdata('type')=="A")
          $type = "Student";
        else
          $type = "Lead";
      echo "<label style='padding-left:10px'>Type :</label>".$type."";
      }

      $from = '';
      if ($this->session->userdata('from') != ''){
      echo "<label style='padding-left:10px'>From Age :</label>".$this->session->userdata('from')."";
      }

      $to = '';
      if ($this->session->userdata('to') != ''){
      echo "<label style='padding-left:10px'>To Age :</label>".$this->session->userdata('to')."";
      }

      $gender = '';
      if ($this->session->userdata('gender') != ''){
        if($this->session->userdata('gender')=="M")
          $gender = "Male";
        else if($this->session->userdata('gender')=="F")
          $gender = "Female";
        else
          $gender = "Other";
      echo "<label style='padding-left:10px'>Gender :</label>".$gender."";
      }



      ?>
      
      <a style='margin-right:10px;' href='<?= base_url(); ?>Lurningo_search'>Refine Search</a>

      <h4>Total match found : <?= $count;?> (in   <?php echo $this->benchmark->elapsed_time();?> seconds)</h4>
     


</h5>

    </div>
    <div class="col-md-12" style="height: 500px ; overflow-y: scroll;">
    <table class="table table-striped table-bordered table-hover" id="sample_1" >
        <thead>
            <tr>
                <th>
                <input type="checkbox" checked="checked" id="select_all">
                </th>
                <th>University</th>
                <th>Course</th>
               
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age[Years]</th>
                <th>Contact</th>
                <th>Email</th>
                <th>City</th>
                <th>State</th>
            </tr>
        </thead> 
        <tbody>
            <form name="contact" method="post" action="<?php echo base_url()?>Search_contact/add_contact">
            <input type="text" name="query" value="<?= $query;?>" hidden>

                <?php 
                foreach($result as $data){ 
                  $name=$data->firstname.' '.$data->lastname;
                  $from = new DateTime($data->DOB);
                  $to = new DateTime('today');
                  $age = $from->diff($to)->y;
                ?>
                
                <tr> 
                    <td>
                        <input type="checkbox"  checked="checked" name="add[]">
                    </td>
                    <td width="80">
                        <input  readonly class="result" name="University[]" value="<?= $data->University; ?>">
                    </td>
                    <td width="250">
                        <input class="result" readonly name="Course[]" value="<?= $data->Course; ?>">
                    </td>
                    
                        <input class="result" hidden readonly name="Category[]" value="<?= $data->Category; ?>">
                    
                    <td width="100">
                        <input class="result" readonly name="firstname[]" value="<?= $data->firstname; ?>">
                    </td>
                    <td width="100">
                        <input class="result" readonly name="lastname[]" value="<?= $data->lastname; ?>">
                    </td>
                    <td width="80"><input class="result" hidden="hidden" name="DOB[]" value="<?= $data->DOB;?>"><?= $age; ?></td>
                    <td width="100">
                        <input class="result" readonly name="mobile[]" value="<?= $data->mobileno; ?>">
                    </td>
                    <td>
                        <input class="result" readonly name="email[]" value="<?= $data->emailid; ?>">
                    </td>
                    <td>
                        <input class="result" hidden="hidden" readonly name="city[]" value="<?= $data->CityId; ?>"><?= $data->CityName; ?>
                    </td>
                    <td>
                        <input class="result" hidden="hidden" readonly name="city[]" value="<?= $data->StateId; ?>"><?= $data->StateName; ?>
                    </td>
                    <input hidden="hidden" name="gender[]" value="<?= $data->Gender;?>">

                </tr>
                <?php } ?>

                <div class="form-inline">
                   <div class="input-group">
                      <span class="input-group-addon">Select Campaign</span>
                        <div class="form-group">
                          <select class="form-control" name="campaign" required>
                              <option value="" disabled="" selected="">Select Campaign</option>
                              <?php foreach ($campaign as $campaign) { echo "<option value=".$campaign->CampaignID.">".$campaign->CampaignName."</option>"; } ?>
                          </select>           
                        </div>
                  <div class="form-group">
                      <button class="btn btn-info" name="submit" value="Submit">Map Selected Contacts</button>
                      <input class="btn btn-info" type="submit" name="Add_all_contact" value="Map All <?= $count;?> Contacts">
                      <a class="btn btn-info" href="<?php echo base_url();?>pagination/generate_csv"><span class="glyphicon glyphicon-save"></span>Download CSV</a>
                  </div>
                </div>
                </div>
            </form><br><br>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $pagination; ?>
        </div>
    </div>
    </div>
    
    <script type="text/javascript">
        $('#select_all').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        
    $.fn.rowCount = function() {
        return $('tr', $(this).find('tbody')).length;
    }; 
    </script>
</div>
</div>
</body>
</html>
