<?php defined('BASEPATH')OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Campaign extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
     $CI = &get_instance();
        $this->load->helper("url");
        $this->load->library('form_validation');
       $this->load->library('session');
		   $this->load->model('Campaignmodel');
	}
  public function index()
  { 
    try {
      if($this->session->userdata('logged_in')) 
      {      
        $this->load->helper('productcategory');
        $data["owner"]=$this->Campaignmodel->get_UsersList();
        $data["team"]=$this->Campaignmodel->get_UsersList();
        $data["product"]=$this->Campaignmodel->get_productlist();
        $data["categorydetails"]=$this->Campaignmodel->get_categorylist();
          $category_count=count($data["categorydetails"]);
        for($i=0;$i<$category_count;$i++)
        {
          $data["categorylist"][$i]=(array)$data["categorydetails"][$i];

        }
        $data["productdetails"]= productcategory($data["categorydetails"],$data["product"]);
        $this->load->view('Campaign/Createcampaign_view',$data);
      }else{
               redirect('login');
           }
    
  } catch (Exception $e) {
    
  }
     
  }//END OF INDEX FUNCTION 
  public function createcampaign()
  {
     try {
      if($this->session->userdata('logged_in'))
     {
            $CI = &get_instance();
            $this->db = $CI->load->database('default', TRUE);      
            $this->form_validation->set_rules('campaignname', 'Campaign Name','required');      
            $this->form_validation->set_rules('description', 'Description','required');
            $this->form_validation->set_rules('owner', 'Owner','required|greater_than[0]');
            $this->form_validation->set_rules('team[]', 'Team','required|greater_than[0]');
            $this->form_validation->set_rules('select2_sample2[]', 'Product','required|greater_than[0]');
            $this->form_validation->set_rules('datefrom', 'Campaign start date','required');
            $this->form_validation->set_rules('dateto', 'Campaign end date','required');
            $this->form_validation->set_rules('Status','Status','required');
            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
            if ($this->form_validation->run() == FALSE) // validation hasn't been passed
            {
              $this->load->model('Campaignmodel');
              $data["owner"]=$this->Campaignmodel->get_UsersList();
              $data["productdetails"]=$this->Campaignmodel->get_productlist();
              $data["categorydetails"]=$this->Campaignmodel->get_categorylist();
              $category_count=count($data["categorydetails"]);
              for($i=0;$i<$category_count;$i++)
              {
                 $data["categorylist"][$i]=(array)$data["categorydetails"][$i];

              }
              $product_count = count($data["productdetails"]);
                  //echo "<pre>";
                 //print_r($data["productdetails"]);
                //echo "</pre>";
                $k=0;
                for($i=0; $i<$product_count;$i++)
                {//for loop to convert csv fields extracted from database to single row of table
                   $product["data"][$i]=(array)$data["productdetails"][$i];
                   $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
                   $product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);
                   $count_productcategory = count($product_category[$i]);
                   //print_r($product_category);
                   $product["data"][$i]["count"]=$count_productcategory;
                   if($product["data"][$i]["count"]>"1")
                   {
                     //echo "in if";
                     for($l=0;$l<$product["data"][$i]["count"];$l++)
                     {
                        $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
                        $product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);            
                        $productdetails["data"][$k]["productname"] = $product["data"][$i]["ProductName"];
                        $productdetails["data"][$k]["productid"] = $product["data"][$i]["ProductId"];
                        $productdetails["data"][$k]["categoryid1"] = $product_category[$i][$l];
                        $productdetails["data"][$k]["categoryname1"] = $product_categoryname[$i][$l];
                        $k++;                     
                      }  
                   }
                  else if($product["data"][$i]["count"]=="1")
                  {
                    //echo "in if";
                    for($l=0;$l<$product["data"][$i]["count"];$l++)
                    {
                      $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
                      $product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);            
                      $productdetails["data"][$k]["productname"] = $product["data"][$i]["ProductName"];
                      $productdetails["data"][$k]["productid"] = $product["data"][$i]["ProductId"];
                      $productdetails["data"][$k]["categoryid1"] = $product_category[$i][$l];
                      $productdetails["data"][$k]["categoryname1"] = $product_categoryname[$i][$l];
                      $k++;
                    }  
                  }
               }
               //echo "<pre>";
               //print_r($productdetails["data"]);
               //echo "</pre>";
               $data["productdetails"]= $productdetails["data"];
               $this->load->view('Campaign/Createcampaign_view', $data);
           }
           else // passed validation proceed to post success logic
           {   
              //$productlist_unique=array();
                
                $team= $this->input->post('team[]');
                $team_csv = implode(",", $team);
                $k=0;
                $product= $this->input->post('select2_sample2[]'); 
                $product_list = array_unique($product);
                foreach ($product_list as $product_list)
                 {
                  $productlist_unique[$k]=$product_list;
                  $k++;
                 }
                //print_r($product);
                //echo "<br>";
                //print_r($productlist_unique);
                //print_r($team_csv);
                              
                $startdate = new DateTime(set_value('datefrom'));
                $s_date = $startdate->format('Y-m-d');
                $enddate = new DateTime(set_value('dateto'));
                $e_date = $enddate->format('Y-m-d');
                $form_data = array(
                            'CampaignName' => set_value('campaignname'),
                            'Description' => set_value('description'),
                            'CreatedBy' => $this->session->userdata['logged_in']['userid'],
                            'StartDate' => $s_date,
                            'EndDate' => $e_date,
                            'Status' => set_value('Status') );
               //print_r($form_data);
                $result=  $this->Campaignmodel->create_campaign($form_data);
                // run insert model to write data to db
                if ($result== TRUE) // the information has therefore been successfully saved in the db
                {
                  $data["campaignid"] = $this->Campaignmodel->get_campaignID(set_value('campaignname'));
                  //print_r($campaignid);
                      if($data["campaignid"]!=FALSE)
                      {
                        $campaign_array = array(
                          'CampaignID' => $data["campaignid"]['0']->CampaignID,
                          'UserID' => set_value('owner')   );
                        $data["campaignowner"] = $this->Campaignmodel->map_campaign($campaign_array);
                        $count_team = count($team);
                        for($i=0;$i<$count_team;$i++)
                        {
                          $campaign_team_array["data"][$i] = array('CampaignID' => $data["campaignid"]['0']->CampaignID,
                                                                   'SystemUserID' => $team[$i] );
                        }
                         //print_r($campaign_team_array);
                        $data["team"]=$this->Campaignmodel->insert_campaignteam($campaign_team_array["data"]);
                        $count_product_list = count( $productlist_unique);
                        for($i=0;$i<$count_product_list;$i++)
                        {                          
                          $campaign_product_array["data"][$i] = array('CampaignID' => $data["campaignid"]['0']->CampaignID,
                                                                   'ProductID' => $productlist_unique[$i] );
                          
                        }
                         //print_r($campaign_product_array["data"]);
                         //exit;
                         $data["product"]=$this->Campaignmodel->insert_campaignproduct($data["campaignid"]['0']->CampaignID,$campaign_product_array["data"]);
                         $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Campaign created successfully</div>');
                         redirect('Displaycampaign');
                        //$data["owner"]=$this->Campaignmodel->get_UsersList();
                        //$this->load->view('Campaign/Createcampaign_view', $data);
                       }
                       else
                       {
                          $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Cannot Map Campaign and Owner</div>');
                          redirect('Campaign');
                       } 
                      $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Campaign created successfully</div>');
                      redirect('Displaycampaign');
                }
                elseif ($result==FALSE)
                {
                   $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Campaign exists!!!<br> Create New Campaign</div>');
                   redirect('Campaign');
                }
                else
                {
                    $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Failed to create Campaign<a href="Campaign" class="btn-sm btn-primary">Create Campaign</a></div>');
                    redirect('Campaign');
                }
        }           
    }
    else
    {
       redirect('login');
    }
        
      } catch (Exception $e) {
        
      } 

  }//END OF CREATE CAMPAIGN FUNCTION 
}  
?>