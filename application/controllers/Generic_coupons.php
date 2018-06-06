<?php
  
  class Generic_coupons extends CI_Controller{

    public function index(){
		if($this->session->userdata('logged_in')){
		  $user_id = $this->session->userdata['logged_in']['userid'];
		  $this->load->model('Leads_model');
		  $data['result'] = $this->Leads_model->Coupons_list($user_id);
		  $this->load->view('Agent/Coupons_list',$data);
		}else{
			redirect(base_url("login"));
		}
	}	

    public function Generate_coupons(){
		if($this->session->userdata('logged_in')){
		  $this->load->model('Leads_model');
		  $data['category'] = $this->Leads_model->All_category();
		  $data['Category'] = $this->Leads_model->All_category();
		  $data['counsellor'] = $this->Leads_model->select_counsellor();
		  //$data['product'] = $this->Leads_model->All_products();
		  $this->load->view('Agent/Generate_coupon_view',$data);
		}else{
			redirect(base_url("login"));
		}
    }

    public function Get_product_list(){
      $this->load->model('Leads_model');
      $categoryid = $this->input->post('CategoryId');
      $result = $this->Leads_model->product_list($categoryid);
      echo '<option value="">All Products</option>';
      foreach($result as $result) {
			echo '<option value="'.$result->ProductId.'">"'.$result->ProductName.'</option>';
		}
	}
	
	public function Get_product_list_user(){
      $this->load->model('Leads_model');
      $categoryid = $this->input->post('CategoryId');
      $result = $this->Leads_model->product_list($categoryid);
      echo '<option value="">Select Product</option>';
      foreach($result as $result) {
			echo '<option value="'.$result->ProductId.'">"'.$result->ProductName.'</option>';
		}
	}

    public function Add_generic_coupon(){

      $coupen_code= substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0,5);
      $discount_percent = $this->input->post('discount_percent');
      if (empty($discount_percent)) {
        $discount_percent = 00.00;
      }
      $discount_amount = $this->input->post('discount_amount');
      if (empty($discount_amount)) {
        $discount_amount = 00.00;
      }
      $ProductID = $this->input->post('product');
      if (empty($ProductID)) {
        $ProductID = 0;
      }
      
      $CategoryID = $this->input->post('category');
      if (empty($CategoryID)) {
        $CategoryID = 0;
      }
      
      if($ProductID != ''){
        $CategoryID = 0; 
      }
      
      $created_by = $this->session->userdata['logged_in']['userid'];
      $valid_till = strtotime($this->input->post('newdate'));
      $number_of_uses = $this->input->post('numberofuses');
      $counsellor = $this->input->post('counsellor');
      $created_on = time();

      $query = $this->db->query("insert into Coupons (Code,DiscountAmount,DiscountRate,ValidTill,CreatedBy,CreatedOn,MaxNumberOfUses,Status,NumberOfUses,CreatedFor) value ('$coupen_code','$discount_amount','$discount_percent','$valid_till','$created_by','$created_on','$number_of_uses','1','0',$counsellor)");
      $CoupenID = $this->db->insert_id();
      $sql = $this->db->query("insert into ProductCoupons (CouponID,CategoryID,ProductID) values ('$CoupenID','$CategoryID','$ProductID')");

      
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><h5>Code Generated Succesfully</h5><br><h2>'.$coupen_code.'</h2></div>');
      redirect(base_url().'Generic_coupons');
      


    }

    public function search(){

      $name = $this->input->post('name');
      $email = $this->input->post('email');
      $mobile = $this->input->post('mobile');

      $query = "SELECT * FROM crm_contacts LEFT JOIN CityMst on CityMst.CityId = crm_contacts.CityId LEFT JOIN StateMst on StateMst.StateId = CityMst.StateId  WHERE ContactsID LIKE '%' ";

      if (!empty($name)){
          $query .= "AND CONCAT(FirstName ,' ', LastName)  LIKE '%$name%'";
      }
      if (!empty($email)){
          $query .= "AND Email LIKE '$email'";
      }
      if (!empty($mobile)){
          $query .= "AND Phone LIKE '$mobile'";
      }

      $sql = $this->db->query($query)->result();
      
      $count = $this->db->query($query)->num_rows();

      $html = '';

      $html .= '<table class="table table-striped table-bordered" id="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>State</th>
                    </tr>
                  </thead>
                  <tbody>';
      foreach ($sql as $row) {
                $html .= "<tr>";
                $html .= '<td><input type = "radio" id="radio" name="radio" value='.$row->ContactsID.'></td>';
                $html .= '<td>'.$row->FirstName.' '.$row->LastName.'</td>';      
                $html .= '<td>'.$row->Email.'</td>';      
                $html .= '<td>'.$row->Phone.'</td>';      
                $html .= '<td>'.$row->StateName.'</td>';      
                $html .= "</tr>";
              }            
      $html .= '</tbody></table>
                <script>
                  $("#table").DataTable({
                    "pageLength": 10,
                    "lengthMenu": [[ 10 ,50, 100, 150, -1], [ 10 , 50, 100, 150, "All"]]//,
                    //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 
                  });
                </script>
                ';
      if ($count > 0){
        echo '<script>
                 $("#form-content").show();
                </script>';
      }else{
        echo "No Records";
        echo '<script>
                 $("#form-content").hide();
                </script>';

      }                      
      
      echo $html; 
        
    }

    
    public function Add_user_coupons(){
      
       $this->load->helper('mail');
      $this->load->helper('file');

      $id = $this->input->post('radio');
      $result = $this->db->query("select Email from crm_contacts where ContactsID = '$id'")->row();
      $email = $result->Email; 

      $coupen_code= substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0,5);
      $discount_percent = $this->input->post('discount_percent');
      if (empty($discount_percent)) {
        $discount_percent = 00.00;
      }
      $discount_amount = $this->input->post('discount_amount');
      if (empty($discount_amount)) {
        $discount_amount = 00.00;
      }
      $ProductID = $this->input->post('product');
      if (empty($ProductID)) {
        $ProductID = 0;
      }
      
      $CategoryID = $this->input->post('category');
      if (empty($CategoryID)) {
        $CategoryID = 0;
      }
      
      if($ProductID != ''){
        $CategoryID = 0; 
      }
      
      $created_by = $this->session->userdata['logged_in']['userid'];
      $valid_till = strtotime($this->input->post('newdate'));
      $created_on = time();

      if (empty($discount_amount)){
        $discount = $discount_percent ." %";
      }

      if (empty($discount_percent)){
        $discount = $discount_amount ." Rs";
      }

      $name = $this->db->query("select ProductName from Product where ProductID = '$ProductID'")->row();
      $ProductName = $name->ProductName;

      $query = $this->db->query("insert into Coupons (Code,DiscountAmount,DiscountRate,ValidTill,CreatedBy,CreatedOn,MaxNumberOfUses,Status,NumberOfUses) value ('$coupen_code','$discount_amount','$discount_percent','$valid_till','$created_by','$created_on','1','1','0')");
      $CoupenID = $this->db->insert_id();
      $sql = $this->db->query("insert into ProductCoupons (CouponID,CategoryID,ProductID) values ('$CoupenID','$CategoryID','$ProductID')");

      $to = $email;
      $subject = "Coupon Code From Lurningo";
      $message = file_get_contents(base_url().'assets/template/user_coupon_view.html');
      
      $message = str_replace('$ProductName',$ProductName,$message);
      
      $message = str_replace('$coupen_code',$coupen_code,$message);
      
      $message = str_replace('$discount',$discount,$message);
      
      $message = str_replace('$ProductID',$ProductID,$message);

	  $cc = '';
      $bcc = "";
      $altmessage = "";

      $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);

      echo $status;
      
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><h5>Code Generated & Mail  Succesfully</h5><br><h2>'.$coupen_code.'</h2></div>');
      redirect(base_url().'Generic_coupons');
      
    }
    
    public function Delete_coupon($CoupenID){
	  $sql = "UPDATE lurningo.Coupons SET  Status = '0' where CouponID = '$CoupenID '";	
      $query = $this->db->query($sql);
      redirect(base_url().'Generic_coupons');
        
    }
  }


?>
