<?php defined('BASEPATH')OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
class Displaycampaign extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
      $this->load->helper("url");
      $this->load->library('form_validation');
      $this->load->library('session');
		  $this->load->model('Campaignmodel');
      $this->load->library('pagination'); 
	} 
    public function index()
  {
     if($this->session->userdata('logged_in'))
      {   //$campaignstatus="1";
          if($this->input->post('campaignstatus')=="1")
             $campaignstatus = "0";
          else
            $campaignstatus = "1";
          
         //$campaignstatus = $this->input->post('campaignstatus');
          $data["campaigndetails"]=$this->Campaignmodel->get_CampaignData($campaignstatus);
          //print_r($data["campaigndetails"]);
        $count_campaign = count($data["campaigndetails"]);
        $data["totalcampaignrun"]=$count_campaign;
        //echo $count_campaign;
        //echo  "campaignstatus:- ".$this->input->post('campaignstatus');
        for($i=0;$i<$count_campaign;$i++)
         {
            $totalcontacts["data"][$i] =$this->Campaignmodel->get_campaigncontact_count($data["campaigndetails"][$i]->CampaignID);
            $data["campaigndetails"][$i]->totalcontacts = $totalcontacts["data"][$i]['0']->Contacts;
            $leadcontacts["data"][$i] = $this->Campaignmodel->get_campaigncontact_lead($data["campaigndetails"][$i]->CampaignID, "lead");
            $data["campaigndetails"][$i]->leadcount = $leadcontacts["data"][$i]['0']->Contacts;
            $prospectcontacts["data"][$i] = $this->Campaignmodel->get_campaigncontact_lead($data["campaigndetails"][$i]->CampaignID, "prospect");
            $data["campaigndetails"][$i]->prospectcount = $prospectcontacts["data"][$i]['0']->Contacts;      
         }
            $this->load->view('Campaign/Displaycampaign_view',$data);
      }
      else
      {
               redirect('login');
      }
  }//END OF INDEX FUNCTION 
   function edit($campaignID)
   {
     if($this->session->userdata('logged_in'))
      {      
        $data["campaigndetails"]=$this->Campaignmodel->get_CampaignDetails($campaignID); 
        $data["owner"]=$this->Campaignmodel->get_UsersList(); 
        $data["team"]=$this->Campaignmodel->get_UsersList(); 
        $data["team_users"] = $this->Campaignmodel->get_Campaignteam($campaignID);
        $count_team = count($data["team_users"]);
        for($i=0;$i<$count_team;$i++)
        {
          $team_array[$i] = (array)$data["team_users"][$i];
          $team_users[$i] = $team_array[$i]["SystemUserID"];
        }        
        $data["Selected_team"]=$team_users;

        $data["selected_products"]=$this->Campaignmodel->get_selectedProducts($campaignID);
        $count_products=count($data["selected_products"]);
        //print_r($data["selected_products"]);
        for($i=0;$i<$count_products;$i++)
        {
          $product_array[$i] = (array)$data["selected_products"][$i];
          $selected_product[$i] = $product_array[$i]["ProductID"];
        }
        //print_r($product_array);
        //print_r($selected_product);
        $data["campaign_products"]= $selected_product;
        //print_r($data["campaign_products"]);

        $data["productdetails"]=$this->Campaignmodel->get_productlist();
        $data["categorydetails"]=$this->Campaignmodel->get_categorylist();
        $category_count=count($data["categorydetails"]);
        for($i=0;$i<$category_count;$i++)
        {
          $data["categorylist"][$i]=(array)$data["categorydetails"][$i];
        }
        //print_r($data["categorydetails"]);
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
            $productdetails["data"][$k]["ispublished"] = $product["data"][$i]["IsPublished"];
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
              $productdetails["data"][$k]["ispublished"] = $product["data"][$i]["IsPublished"];
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
  $this->load->view('Campaign/Editcampaign_view',$data);
  }
  else
  {
    redirect('login');
  }
  
  }     
  public function update($campaignID)
  {
   if($this->session->userdata('logged_in'))
   {
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
            $data["campaigndetails"]=$this->Campaignmodel->get_CampaignDetails($campaignID); 
            $data["owner"]=$this->Campaignmodel->get_UsersList(); 
            $data["team"]=$this->Campaignmodel->get_UsersList(); 

            $data["team_users"] = $this->Campaignmodel->get_Campaignteam($campaignID);
            $count_team = count($data["team_users"]);
            for($i=0;$i<$count_team;$i++)
            {
              $team_array[$i] = (array)$data["team_users"][$i];
              $team_users[$i] = $team_array[$i]["SystemUserID"];
            }        
            $data["Selected_team"]=$team_users;

            $data["selected_products"]=$this->Campaignmodel->get_selectedProducts($campaignID);
            $count_products=count($data["selected_products"]);
            //print_r($data["selected_products"]);
            for($i=0;$i<$count_products;$i++)
            {
              $product_array[$i] = (array)$data["selected_products"][$i];
              $selected_product[$i] = $product_array[$i]["ProductID"];
            }
            //print_r($product_array);
            //print_r($selected_product);
            $data["campaign_products"]= $selected_product;
            //print_r($data["campaign_products"]);

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
              if($product["data"][$i]["count"]>"1"){
                //echo "in if";
                for($l=0;$l<$product["data"][$i]["count"];$l++)
              {
                $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
                $product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);            
                $productdetails["data"][$k]["ispublished"] = $product["data"][$i]["IsPublished"];
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
                    $productdetails["data"][$k]["ispublished"] = $product["data"][$i]["IsPublished"];
                    $productdetails["data"][$k]["productname"] = $product["data"][$i]["ProductName"];
                    $productdetails["data"][$k]["productid"] = $product["data"][$i]["ProductId"];
                    $productdetails["data"][$k]["categoryid1"] = $product_category[$i][$l];
                    $productdetails["data"][$k]["categoryname1"] = $product_categoryname[$i][$l];
                    $k++;
                                  
                  }  
              }
            }
          $data["productdetails"]= $productdetails["data"];
          $this->load->view('Campaign/Editcampaign_view', $data);
        }
        else // passed validation proceed to post success logic
        {
                    $k=0;
                    $product= $this->input->post('select2_sample2[]'); 
                    $product_list = array_unique($product);
                    foreach ($product_list as $product_list)
                    {
                      # code...
                      $productlist_unique[$k]=$product_list;
                      $k++;
                    }
                    //print_r($productlist_unique);
          $team= $this->input->post('team[]');
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
                      'Status' => set_value('Status')                  
                );
         // print_r($form_data);
         //echo "value".set_value('owner');
         //echo "<br>post".$this->input->post('owner');
          $result=  $this->Campaignmodel->update_campaign($campaignID,$form_data);
          //echo "result".$result;
          if ($result=='1') // the information has therefore been successfully saved in the db
          {
            $campaign_array = array(
                'CampaignID' => $campaignID,
                'UserID' => $this->input->post('owner')
                );
            //print_r($campaign_array);
              $data["campaignowner"]=  $this->Campaignmodel->update_campaignowner($campaignID,$campaign_array);
               $count_team = count($team);
                            for($i=0;$i<$count_team;$i++)
                            {
                              $campaign_team_array["data"][$i] = array('CampaignID' => $campaignID,
                                                                       'SystemUserID' => $team[$i] );
                             }
                             //print_r($campaign_team_array);
              $data["team"]=$this->Campaignmodel->update_campaignteam($campaignID,$campaign_team_array["data"]);
              $count_product_list = count( $productlist_unique);
              for($i=0;$i<$count_product_list;$i++)
              {                          
                  $campaign_product_array["data"][$i] = array('CampaignID' => $campaignID,
                                                              'ProductID' => $productlist_unique[$i] );
                              
              }
                             //print_r($campaign_product_array["data"]);
                             
                $data["product"]=$this->Campaignmodel->update_campaignproduct($campaignID,$campaign_product_array["data"]);              

              //echo "data[campaignowner]".$data["campaignowner"];
              if($data["campaignowner"]=='1')
              {
              $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Campaign updated successfully</div>');
              redirect('Displaycampaign');
              }
              else
              {
                $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Cannot Map Campaign and Owner</div>');
                redirect('Displaycampaign/edit/'.$campaignID.'');
               }
             }elseif ($result!='1') 
             {
               $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Cannot Update Campaign</div>');
                redirect('Displaycampaign/edit/'.$campaignID.'');
          }
          else
          {
          $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Failed to update Campaign<a href="Campaign" class="btn-sm btn-primary">Create Campaign</a></div>');
                redirect('Displaycampaign/edit/'.$campaignID.'');
          }
        }
       
    }else{
               redirect('login');
    }

  }//END OF CREATE CAMPAIGN FUNCTION 

  function generatecsv($campaignID)
{
   $result = $this->Campaignmodel->generate_csv($campaignID);
}
   
 }  

?>