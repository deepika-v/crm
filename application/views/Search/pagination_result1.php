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
    <script src="<?php echo base_url('assets/global/scripts/jquery.sumoselect.js')?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/css/sumoselect.css');?>">
    
    <script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3, captionFormatAllSelected: "Yeah, OK, so everything." });
    });
    </script>
    
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

      $data['university'] = $this->input->post('university');
      $university ='';
      if ($this->input->post('university') != ''){
      $university = implode(',', $data['university']);
      echo "<label style='padding-left:10px'>University :</label>".$university."";
      }
      
      $course = '';
      $data['course'] = $this->input->post('course');
      if ($this->input->post('course') != ''){
      $course = implode(',', $data['course']);
      echo "<label style='padding-left:10px'>Course :</label>".$course."";
      }

      $category = '';
      $data['category'] = $this->input->post('category');
      if ($this->input->post('category') != ''){
      $category = implode(',', $data['category']);
      echo "<label style='padding-left:10px'>Category :</label>".$category."";
      }

      $city = '';
      $data['city'] = $this->input->post('City');
      if ($this->input->post('City') != ''){
      $city = implode(',', $data['city']);
      echo "<label style='padding-left:10px'>City :</label>".$city."";
      }

      $type = '';
      if ($this->input->post('Type') != ''){
      echo "<label style='padding-left:10px'>Type :</label>".$this->input->post('Type')."";
      }

      $from = '';
      if ($this->input->post('from') != ''){
      echo "<label style='padding-left:10px'>From Age :</label>".$this->input->post('from')."";
      }

      $to = '';
      if ($this->input->post('to') != ''){
      echo "<label style='padding-left:10px'>To Age :</label>".$this->input->post('to')."";
      }

      $gender = '';
      if ($this->input->post('gender') != ''){
      echo "<label style='padding-left:10px'>Gender :</label>".$this->input->post('gender')."";
      }


      ?>

      <a style='margin-right:10px;' href='<?= base_url(); ?>Search_contact'>Refine Search</a>

      <h4>Total match found : <?= $count;?> (in   <?php echo $this->benchmark->elapsed_time();?> seconds)</h4>
     


</h5>

    </div>
    <div class="col-md-12" style="height: 500px ; overflow-y: scroll;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                <input type="checkbox" checked="checked" id="select_all">
                </th>
                <th>University</th>
                <th>Course</th>
                <th>Course Category</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age[Years]</th>
                <th>Contact</th>
                <th>Email</th>
                <th>State</th>
                <th>City</th>
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
                        <input type="checkbox" checked="checked" name="add[]">
                    </td>
                    <td>
                        <input  readonly class="result" name="University[]" value="<?= $data->University; ?>">
                    </td>
                    <td>
                        <input class="result" readonly name="Course[]" value="<?= $data->Course; ?>">
                    </td>
                    <td>
                        <input class="result" readonly name="Category[]" value="<?= $data->Category; ?>">
                    </td>
                    <td>
                        <input class="result" readonly name="firstname[]" value="<?= $data->firstname; ?>">
                    </td>
                    <td>
                        <input class="result" readonly name="lastname[]" value="<?= $data->lastname; ?>">
                    </td>
                    <td><input class="result" hidden="hidden" name="DOB[]" value="<?= $data->DOB;?>"><?= $age; ?></td>
                    <td>
                        <input class="result" readonly name="mobile[]" value="<?= $data->mobileno; ?>">
                    </td>
                    <td>
                        <input class="result" readonly name="email[]" value="<?= $data->emailid; ?>">
                    </td>
                    <td>
                        <input class="result" hidden="hidden" readonly name="state[]" value="<?= $data->StateId; ?>"><?= $data->StateName; ?>
                    </td>
                    <td>
                        <input class="result" hidden="hidden" readonly name="city[]" value="<?= $data->CityId; ?>"><?= $data->CityName; ?>
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
    <script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
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
    </script>
</div>
</div>
</body>
</html>
