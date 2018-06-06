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
    <script src="<?php echo base_url('assets/global/scripts/jquery.multiselect.js')?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/css/jquery.multiselect.css');?>">
  </head>
  <body>
    <?php $this->load->view('Header_view'); $datetime = new DateTime('tomorrow'); ?><br>
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">Generate Coupon Code</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Type of Coupon:</label>
                <div class="col-sm-10">
                  <label class="radio-inline"><input type="radio" id="generic" name="option" checked="checked" value="1">Counsellor Specific Coupon</label>
                  <label class="radio-inline"><input type="radio" id="user" name="option" value="2">Student Specific Coupon</label>
                </div>
            </div>
          </form>
          

          <form class="form-horizontal" id="Generic_coupons" method="post" action="<?= base_url();?>Generic_coupons/Add_generic_coupon">
            <div class="form-group">
              <label class="control-label col-md-2">Counsellor</label>
              <div class="col-md-3 col-sm-3">
                <select name="counsellor" class="form-control" required>
                    <option value="" selected hidden disabled>Select Counsellor</option>
                   <?php
                      foreach ($counsellor as $counsellor) {
                    ?>
                      <option value="<?= $counsellor->SystemUserID?>"><?= $counsellor->FirstName.' '.$counsellor->LastName; ?></option>
                    <?php
                      }
                   ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Category:</label>
                <div class="col-sm-3">
                  <select name="category" onChange="getProduct(this.value);" class="form-control">
                    <option value="" selected >All Categories</option>
                    <?php
                      foreach ($category as $category) {
                    ?>
                      <option value="<?= $category->CategoryId;?>"><?= $category->CategoryName;?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Products:</label>
                <div class="col-sm-5">
                  <select id="Product" name="product" class="SlectBox form-control">
                   
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Number of Usage:</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" name="numberofuses" min="1" value="1">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Valid Till:</label>
              <div class="col-sm-2">
                <input type="text" style="width:250px" name="newdate" onkeypress="return false" onkeydown="return false" class="form-control" value="<?= $datetime->format('d-m-Y')?>" id="datepicker">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" >Discount Type:</label>
                <div class="col-sm-10">
                  <label class="radio-inline"><input type="radio" name="discount_type" id="percent" checked="checked" value="1">%</label>
                  <label class="radio-inline"><input type="radio" name="discount_type" id="amount" value="2">Amount</label>
                  <label class="radio-inline"><input type="number" class="form-control" min="1" max="99" required="required" name="discount_percent" id="percent_text" placeholder="%"></label>
                  <label class="radio-inline"><input type="number" class="form-control" min="1" name="discount_amount" id="amount_text" style="display:none;" placeholder="Discount Amount"></label>
                </div>
            </div>
            <div class="form-group"> 
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" id="submit" class="btn btn-success">Generate Coupoun Code</button>
              </div>
            </div>
          
                <div id="coupon"></div>
          </form>



         
         
             <fieldset>
                <form role="form" class="form-inline" id="search_form" style="display:none" action="<?= base_url()?>Generic_coupons/Search" method="post">
                <div class="form-group" style="padding-left:50px">
                  <label>Search by :  </label>
                </div>
              <div class="form-group">
                <select name="filter" id="filter" class="form-control"> 
                    <option value="">Select Search Filter</option>  
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="mobile">Mobile</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" style="display:none" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="email" style="display:none" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="number" style="display:none" class="form-control" name="mobile" id="mobile" placeholder="Mobile No">
                </div>
                <div class="form-group">
                  <button type="submit" style="display:none" class="btn btn-success" name="search" id="search">Search</button>  
                </div>
                </form>
                
            </fieldset>

          <hr>
           
           <form class="form-inline" id="user_specific_coupon" method="post" action="<?= base_url()?>Generic_coupons/Add_user_coupons" style="display:none" >
              <div id="displayonsearch">       
              </div> 
            <div id="form-content" style="display:none;"> 
            <div class="form-group col-md-6">
              <label for="category">Category</label>
              <select name="category" onChange="getProduct1(this.value);" class="form-control" required="required">
                    <option value="" selected >Select Categories</option>
                    <?php
                      foreach ($Category as $category) {
                    ?>
                      <option value="<?= $category->CategoryId;?>"><?= $category->CategoryName;?></option>
                    <?php
                      }
                    ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Product:</label>
               <select id="Product1" name="product" required="required" class="SlectBox form-control">
               </select>
            </div>
            <br><br><br><br>

            <div class="form-group col-md-6">
              <label >Discount Type:</label>
                <div>
                  <label class="radio-inline"><input type="radio" name="discount_type" id="percent1" checked="checked" value="1">%</label>
                  <label class="radio-inline"><input type="radio" name="discount_type" id="amount1" value="2">Amount</label>
                  <label class="radio-inline"><input class="form-control" type="number" min="1" max="99" required="required" name="discount_percent" id="percent_text1" placeholder="%"></label>
                  <label class="radio-inline"><input class="form-control" type="number" min="1" name="discount_amount" id="amount_text1" style="display:none;" placeholder="Discount Amount"></label>
                </div>
            </div>

            
            <div class="form-group col-md-6">
              <label >Valid Till:</label>
                <div>
                  <input type="text" style="width:250px" name="newdate" onkeypress="return false" onkeydown="return false" class="form-control" value="<?= $datetime->format('d-m-Y')?>" id="datepicker1">
                </div>
            </div>
            <center>
              <input style="margin-top:10px" type="submit" onclick="myFunction()"  name="submit" value="Submit" class="btn btn-success">
            </center>
            </div>
              
          </form>
          
          

          
          
        
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
                          $("#datepicker").datepicker({
                            minDate: 1,
                            onSelect: function(theDate) {
                              $("#dataEnd").datepicker("option", "minDate", new Date(theDate));
                            },
                            
                            beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                            },
                            dateFormat: "dd-mm-yy"
                          });
                          $("#dataEnd").datepicker({
                              beforeShow: function() {
                                $("#ui-datepicker-div").css("z-index", 9999);
                                },
                                dateFormat: "dd-mm-yy"
                            });
                        });
       $(document).ready(function() {
                          $("#datepicker1").datepicker({
                            minDate: 1,
                            onSelect: function(theDate) {
                              $("#dataEnd").datepicker("option", "minDate", new Date(theDate));
                            },
                            
                            beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                            },
                            dateFormat: "dd-mm-yy"
                          });
                          $("#dataEnd").datepicker({
                              beforeShow: function() {
                                $("#ui-datepicker-div").css("z-index", 9999);
                                },
                                dateFormat: "dd-mm-yy"
                            });
                        });
      $(document).ready(function() {
        $('input[type="radio"]').click(function() {
          if($(this).attr('id') == 'percent') {
            $('#percent_text').show();
            $('#amount_text').hide();           
          }
          if($(this).attr('id') == 'amount'){
             $('#percent_text').hide();
            $('#amount_text').show();   
          }
        });
      });

      $(document).ready(function() {
        $('input[type="radio"]').click(function() {
          if($(this).attr('id') == 'percent1') {
            $('#percent_text1').show();
            $('#amount_text1').hide();           
          }
          if($(this).attr('id') == 'amount1'){
             $('#percent_text1').hide();
            $('#amount_text1').show();   
          }
        });
      });



      $('input[name="option"]').change(function () {
          if($("#generic").is(':checked')) {
            $('#Generic_coupons').show();
            $('#user_specific_coupon').hide();
            $('#search_form').hide();
            } else {
            $('#Generic_coupons').hide();
            $('#user_specific_coupon').show(); 
            $('#search_form').show(); 
           }
          if($("#user").is(':checked')) {
            $('#Generic_coupons').hide();
            $('#user_specific_coupon').show();
            $('#search_form').show();
            } else {
            $('#Generic_coupons').show();
            $('#user_specific_coupon').hide();
            $('#search_form').hide();
           }
        });


        function getProduct(val) {
          $.ajax({
            type: "POST",
            url: "<?= base_url();?>Generic_coupons/Get_product_list",
            data:'CategoryId='+val,
            success: function(data){
            $("#Product").html(data);
            }
          });
        }

        function getProduct1(val) {
          $.ajax({
            type: "POST",
            url: "<?= base_url();?>Generic_coupons/Get_product_list_user",
            data:'CategoryId='+val,
            success: function(data){
            $("#Product1").html(data);
            }
          });
        }

        $('input[name="discount_type"]').change(function () {
          if($("#percent").is(':checked')) {
            $('#percent_text').attr('required', true);
            } else {
            $('#percent_text').removeAttr('required');
            $("#percent_text").val("");
           }
          if($("#amount").is(':checked')) {
            $('#amount_text').attr('required', true);
            } else {
            $('#amount_text').removeAttr('required');
            $('#amount_text').val("");
           }
        });

        $('input[name="discount_type"]').change(function () {
          if($("#percent1").is(':checked')) {
            $('#percent_text1').attr('required', true);
            } else {
            $('#percent_text1').removeAttr('required');
            $('#percent_text1').val('');
           }
          if($("#amount1").is(':checked')) {
            $('#amount_text1').attr('required', true);
            } else {
            $('#amount_text1').removeAttr('required');
            $('#amount_text1').val('');
           }
        });

        $(document).ready(function(){
          var form=$("#search_form");
            $("#search_form").submit(function(e){
              e.preventDefault();
              $.ajax({
                  type: "POST",
                  data:form.serialize(),
                  url:"<?= base_url() ?>Generic_coupons/search",
                  success: function(data) {
                    $("#displayonsearch").html(data);
                  }
                });
              });
            });
            
      $(document).ready(function(){
        $("#filter").change(function(){
          var value = $(this).val();
          if(value == "name"){
            $("#name").show();
            $('#name').attr('required', true);
            $("#email").hide();
            $("#email").val('');
            $("#mobile").hide();
            $("#mobile").val('');
            $("#search").show();
            $('#email').removeAttr('required');
            $('#mobile').removeAttr('required');
          }
          else if(value == "email"){
            $("#email").show();
            $('#email').attr('required', true);
            $("#name").hide();
            $("#name").val('');
            $("#mobile").hide();
            $("#mobile").val('');
            $("#search").show();
            $('#name').removeAttr('required');
            $('#mobile').removeAttr('required');
          }
          else if(value == "mobile"){
            $("#mobile").show();
            $('#mobile').attr('required', true);
            $("#name").hide();
            $("#name").val('');
            $("#email").hide();
            $("#email").val('');
            $("#search").show();
            $('#name').removeAttr('required');
            $('#email').removeAttr('required');
          }
          else{
          $("#name").hide();
          $("#email").hide();
          $("#mobile").hide();
          $("#search").hide();
         }
      })
    })
    
    function myFunction() {
      document.getElementById("radio").required = true;
    }

        
         
    </script>
  </body>
</html>
