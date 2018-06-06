 <form action="<?php echo base_url('Dashboard');?>" method="post" id="campaignform" name="campaignform" onsubmit="return(validate());">
                                <label>Candidate Name:-</label><input type="text" placeholder="Enter first name" id="userfname" name="userfname"><input type = "text" placeholder="Enter Last name" id="userlname" name="userlname"><br>
                                <input type="text" id="campaignid" name="campaignid"  value="" hidden>
                                <label>Gender:-</label><select id="usergender" name="usergender">
                                                       <option value="0">--Select--</option>
                                                       <option value="M">Male</option>
                                                       <option value="F">Female</option>
                                                       <option value="O">Other</option>
                                                       </select><br>
                                <label>Date of Birth:-</label><input type="text" id="userdob" name="userdob" placeholder="dd/mm/yyyy"></br>
                                <label>Email:-</label><input type="email" placeholder="Enter Email" id="useremail" name="useremail"></br>
                                <label>Phone:-</label><input type="text" placeholder="Enter Phone number" id="userphone" name="userphone"><br>
                                <input type="checkbox" id="userterms" name="userterms">I accept terms and conditions.<br>
                                <input type="submit" id="submitform" name="submitform"  value="Submit"><br>
                                </form>
                              <a href="#"  onclick="displayeditor();">View Source</a> 
                              <textarea id="viewsource" rows="10" cols="100" style="display:none;"><form action="<?php echo base_url('Dashboard');?>" method="post" id="campaignform" name="campaignform" onsubmit="return(validate());">
                                <label>Candidate Name:-</label><input type="text" placeholder="Enter first name" id="userfname" name="userfname"><input type = "text" placeholder="Enter Last name" id="userlname" name="userlname"><br>
                                <input type="text" id="campaignid" name="campaignid"  value="" hidden>
                                <label>Gender:-</label><select id="usergender" name="usergender">
                                                       <option value="0">--Select--</option>
                                                       <option value="M">Male</option>
                                                       <option value="F">Female</option>
                                                       <option value="O">Other</option>
                                                       </select><br>
                                <label>Date of Birth:-</label><input type="text" id="userdob" name="userdob" placeholder="dd/mm/yyyy"></br>
                                <label>Email:-</label><input type="email" placeholder="Enter Email" id="useremail" name="useremail"></br>
                                <label>Phone:-</label><input type="phone" placeholder="Enter Phone number" id="userphone" name="userphone"><br>
                                <input type="checkbox" id="userterms" name="userterms">I accept terms and conditions.<br>
                                <input type="submit" id="submitform" name="submitform"  value="Submit"><br>
                                </form>
                              </textarea> 

<script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<script type="text/javascript">

function validate(){
//alert("in form");  
//var form = document.forms.("campaignform");
var userfname =  document.getElementsByName('userfname')['0'].value;
//alert(userfname);
var userlname = document.getElementsByName('userlname')['0'].value;
var usergender = document.getElementsByName('usergender')['0'].value;
var useremail = document.getElementsByName('useremail')['0'].value;
var userdob = document.getElementsByName('userdob')['0'].value;
var userphone = document.getElementsByName('userphone')['0'].value;
var userterms = document.getElementsByName('userterms')['0'].value;
alert(userterms);
var error = "";
if(userfname == ""){
  error += "Enter User Name \n";
}
 if(userlname==""){
  error += "Enter Last Name \n";
}
if(useremail == ""){
  error += "Enter Email \n";
}
if(userphone == ""){
  error += "Enter Phone number \n"
}
if(userdob == ""){
  error += "Enter Date of Birth \n";
}
if(userfname == ""&& userlname == "" && useremail=="" && userdob == "" && userphone == ""){
  error = "Please fill all details";
}
alert(error);
if(error==""){
  return true;
}
else{
return false;  
}
}
function displayeditor(){
document.getElementById('viewsource').style.display="block";
}
  </script>  
