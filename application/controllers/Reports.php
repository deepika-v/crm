<?php defined('BASEPATH')OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Reports extends CI_Controller
{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
     $CI = &get_instance();
        $this->load->helper("url");
        $this->load->library('form_validation');
       $this->load->library('session');
		   $this->load->model('Reportmodel');
       $this->load->helper('csv');

	} 
  public function index()
  { 
    $this->load->view('Reports/Campaignreport_view');
     
  }//END OF INDEX FUNCTION 
   public function agent_report()
  { 
    $this->load->view('Reports/Agentreport_view');
     
  }//END OF INDEX Function
  public function campaignreport($date1,$date2)
  {
    try {
          if($this->session->userdata('logged_in'))
          {  
                    $HTML='';
                    $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $_SESSION["from_date"] = $from_date;
                    $_SESSION["to_date"] = $to_date;
                    $userrole = $this->session->userdata['logged_in']['user_role'];
                    $userid = $this->session->userdata['logged_in']['userid'];
                                   
                    $data["campigndetails"]=$this->Reportmodel->get_campaign($userrole,$userid);
                   //print_r($data["campigndetails"]);
                    $count = count($data["campigndetails"]);
                    //echo $count;
                    for($i=0;$i<$count;$i++)
                    {
                      $array["data"][$i]=$data["campigndetails"][$i];
                      
                      $gettotal_count = $this->Reportmodel->get_totalcount_leads($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array["data"][$i]->totalcount=$gettotal_count['0']->count;
                      
                      $getopen_count = $this->Reportmodel->get_totalfollowups($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array["data"][$i]->opencount=$getopen_count['0']->count;
                      
                      $getclosed_count = $this->Reportmodel->get_totalclosed_leads($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array["data"][$i]->closedcount=$getclosed_count['0']->count;
                      
                      $getdrop_count = $this->Reportmodel->get_totaldropped_leads($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array["data"][$i]->droppedcount=$getdrop_count['0']->count;
                }
                //print_r($array["data"]);
                $HTML .= '<table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
              <tr>
                <th>Sr.No</th>
                <th>Campaign Name</th>
                <th>Total</th>
                <th>Open</th>
                <th>Closed</th>
                <th>Closed(%)</th>
                <th>Dropped</th>                
                <th>Dropped(%)</th>
                </tr>
              </thead>
              <tbody>';
              if(!empty($array["data"]))
                 //echo "<pre>";
                 //print_r($data);
                 //echo "</pre>";
    {
      $j='0';//$page++;
      $j++;
      foreach($array["data"] as $array["data"]) // user is a class, because we decided in the model to send the results as a class.
      {
        if(($array["data"]->totalcount)!='0')
        {
              $CampaignID = $array['data']->CampaignID;
            if($array["data"]->totalcount!='0')$closedpercentage = (($array["data"]->closedcount/$array["data"]->totalcount)*100); else  $closedpercentage='0';
            if($array["data"]->totalcount!='0')$droppedpercentage = (($array["data"]->droppedcount/$array["data"]->totalcount)*100); else  $droppedpercentage='0';
            $HTML .= "<tr>"; 
            $HTML .="<td>".$j."</td>";             
            $HTML .="<td>".ucfirst($array["data"]->CampaignName)."</td>";
            if($array["data"]->totalcount!='0')
            $HTML .= "<td><a href='#' onclick='display_totalcontactsdetails($CampaignID);'>".($array["data"]->totalcount)."</a></td>";
            else
            $HTML .= "<td>".($array["data"]->totalcount)."</td>";
            if($array["data"]->opencount!='0')
            $HTML .= "<td><a href='#' onclick='display_opencontactsdetails($CampaignID);'>".($array["data"]->opencount)."</td>";
            else
             $HTML .= "<td>".($array["data"]->opencount)."</td>"; 
            if($array["data"]->closedcount!='0')
            $HTML .= "<td><a href='#' onclick='display_closedcontactsdetails($CampaignID);'>".($array["data"]->closedcount)."</td>";
            else
             $HTML .= "<td>".($array["data"]->closedcount)."</td>"; 

            $HTML .= "<td>".round($closedpercentage,2)."</td>";
            if($array["data"]->droppedcount!='0')
            $HTML .= "<td><a href='#' onclick='display_droppedcontactsdetails($CampaignID);'>".($array["data"]->droppedcount)."</td>";
            else  
            $HTML .= "<td>".($array["data"]->droppedcount)."</td>";
            $HTML .= "<td>".round($droppedpercentage,2)."</td>";
            $HTML .= "</tr>"; 
            $j++;
        }
        
      }
      $HTML .="</tbody>
              </table>";
    }
                //echo "array list <br><pre>";
                //print_r($array);
                //echo "</pre>";
                //$this->load->view('Reports/Campaignreport_view',$array);
          echo $HTML;
        }
    }catch (Exception $e)
    {
    
    }
 }
  public function agent_report_display($date1,$date2)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {  

             $HTML='';
                    $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                     $_SESSION["from_date"] = $from_date;
                    $_SESSION["to_date"] = $to_date;
                    //echo "from_date:- ".$from_date;
                    //echo "to_date:- ".$to_date;
                    //echo "<script>alert('this is controller');</script>";
                    $userrole = $this->session->userdata['logged_in']['user_role'];
                  
                    $data["agentdetails"]=$this->Reportmodel->get_agentdetails($userrole);
                   // print_r($data["campigndetails"]);
                    $count = count($data["agentdetails"]);
                    for($i=0;$i<$count;$i++)
                    {
                      $array["data"][$i]=$data["agentdetails"][$i];
                      
                      $gettotal_count = $this->Reportmodel->get_agenttotalcount_leads($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array["data"][$i]->totalcount=$gettotal_count['0']->count;
                      
                      $getopen_count = $this->Reportmodel->get_agenttotalfollowups($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array["data"][$i]->opencount=$getopen_count['0']->count;
                      
                      $getclosed_count = $this->Reportmodel->get_agenttotalclosed_leads($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array["data"][$i]->closedcount=$getclosed_count['0']->count;
                      
                      $getdrop_count = $this->Reportmodel->get_agenttotaldropped_leads($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array["data"][$i]->droppedcount=$getdrop_count['0']->count;
                }
                $HTML .= '<table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
              <tr>
                <th>Sr.No</th>
                <th>Agent Name</th>
                <th>Total</th>
                <th>Open</th>
                <th>Closed</th>
                <th>Closed(%)</th>
                <th>Dropped</th>                
                <th>Dropped(%)</th>
                </tr>
              </thead>
              <tbody>';
              if(!empty($array["data"]))
                 //echo "<pre>";
                 //print_r($data);
                 //echo "</pre>";
    {
      $j='0';//$page++;
      $j++;
      foreach($array["data"] as $array["data"]) // user is a class, because we decided in the model to send the results as a class.
      {
        if($array["data"]->totalcount!="0")
        {
          $agentid = $array["data"]->SystemUserID;
        $todate = $to_date;
        if($array["data"]->totalcount!='0')$closedpercentage = (($array["data"]->closedcount/$array["data"]->totalcount)*100); else  $closedpercentage='0';
        if($array["data"]->totalcount!='0')$droppedpercentage = (($array["data"]->droppedcount/$array["data"]->totalcount)*100); else  $droppedpercentage='0';
        $HTML .= "<tr>"; 
        $HTML .="<td>".$j."</td>";             
        $HTML .="<td>".ucfirst($array["data"]->FirstName." ".$array["data"]->LastName)."</td>";

        if($array["data"]->totalcount!='0')
        $HTML .= "<td><a href='#' onclick='display_totalcontactsdetails($agentid);'>".$array["data"]->totalcount."</a></td>";
        else
        $HTML .= "<td>".$array["data"]->totalcount."</td>";

        if($array["data"]->opencount!='0')
        $HTML .= "<td><a href='#' onclick='display_opencontactsdetails($agentid);'>".($array["data"]->opencount)."</a></td>";
        else
        $HTML .= "<td>".$array["data"]->opencount."</td>";

        if($array["data"]->closedcount!='0')  
        $HTML .= "<td><a href='#' onclick='display_closedcontactsdetails($agentid);'>".($array["data"]->closedcount)."</a></td>";
        else
        $HTML .= "<td>".$array["data"]->closedcount."</td>"; 

        $HTML .= "<td>".round($closedpercentage,2)."</td>";

        if($array["data"]->droppedcount!='0')
        $HTML .= "<td><a href='#' onclick='display_droppedcontactsdetails($agentid);'>".($array["data"]->droppedcount)."</a></td>";
        else
        $HTML .= "<td>".$array["data"]->droppedcount."</td>";

        $HTML .= "<td>".round($droppedpercentage,2)."</td>";
        $HTML .= "</tr>"; 
        $j++;

        }
        
      }
      $HTML .="</tbody>
              </table>";
    }
      
      $this->session->set_userdata("from_date",$from_date);
      $this->session->set_userdata("to_date",$to_date);
                
                //echo "array list <br><pre>";
                //print_r($array);
                //echo "</pre>";
                //$this->load->view('Reports/Campaignreport_view',$array);
          echo $HTML;
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF AGENT_REPORT FUNCTION 
  public function agent_report_display_totalcontacts($date1,$date2,$agentid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_agenttotalcontactdetails($agentid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview($data["agentdetails"]);
                    
                    
          
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 

  public function agent_report_display_closedcontacts($date1,$date2,$agentid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_agenttotalclosed_contactdetails($agentid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview_droppedleads($data["agentdetails"],$data["agentdetails"]['0']->Status);
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 
  public function agent_report_display_opencontacts($date1,$date2,$agentid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_agenttotalfollowup_contactdetails($agentid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview($data["agentdetails"]);            
             }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 

public function agent_report_display_droppedcontacts($date1,$date2,$agentid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_agenttotaldropped_contactdetails($agentid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview_droppedleads($data["agentdetails"],$data["agentdetails"]['0']->Status);
     
                    
                    
          
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 
  public function campaign_report_display_totalcontacts($date1,$date2,$campaignid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_campaigntotalcontactdetails($campaignid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview($data["agentdetails"]);
              }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 

  public function campaign_report_display_closedcontacts($date1,$date2,$campaignid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d'); 
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_campaignclosedcontactdetails($campaignid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview_droppedleads($data["agentdetails"],$data["agentdetails"]['0']->Status);
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 
  public function campaign_report_display_opencontacts($date1,$date2,$campaignid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_campaignfollowup_contactdetails($campaignid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview($data["agentdetails"]);
                    
                    
          
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 

public function campaign_report_display_droppedcontacts($date1,$date2,$campaignid)
  { 
    try {
          if($this->session->userdata('logged_in'))
            {     $HTML ='';
                  $date1 = new DateTime($date1);
                    $date2 =  new DateTime($date2);
                    $from = $date1->format('Y-m-d');
                    $to = $date2->format('Y-m-d');
                    $from_date = $from." 00:00:00";
                    $to_date = $to." 23:59:59";
                    $data["agentdetails"]=$this->Reportmodel->get_campaigndroppedcontactdetails($campaignid,$from_date,$to_date);
                    //print_r($data["agentdetails"]);
                    $this->tableview_droppedleads($data["agentdetails"],$data["agentdetails"]['0']->Status);
                    
                    
          
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }//END OF agent_report_display_totalcontacts FUNCTION 



  public function generate_campaign_csv()
  { 
    try {
          if($this->session->userdata('logged_in'))
            {       
                    //$date1 = new DateTime($date1);
                    //$date2 =  new DateTime($date2);
                    //$from = $date1->format('Y-m-d');
                    //$to = $date2->format('Y-m-d');
                    header('Content-type: application/csv');
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Disposition: attachment; filename=campaign_summaryreport.csv');
                    // create a file pointer connected to the output stream
                    $output = fopen('php://output', 'w');

                   // output the column headings
                   fputcsv($output, array('Campaign Name','Total','Open','Closed', 'Closed(%)','Dropped','Dropped(%)'));
 
                    $fileName = 'Campaign report-' . gmdate('Y-m-d') . '.csv';  
                    $from_date = $_SESSION["from_date"];
                    $to_date = $_SESSION["to_date"];
                    $userrole = $this->session->userdata['logged_in']['user_role'];
                    $userid = $this->session->userdata['logged_in']['userid'];
                    //echo $from_date."<br>";
                    //echo $to_date."<br>";
                     
                   $data["campigndetails"]=$this->Reportmodel->get_campaign($userrole,$userid);
                   // print_r($data["campigndetails"]);
                    $count = count($data["campigndetails"]);
                    for($i=0;$i<$count;$i++)
                    {
                          
                      $array["data"][$i]=$data["campigndetails"][$i];
                      $array1[$i]["CampaignName"] = $array["data"][$i]->CampaignName;
                      
                      $gettotal_count = $this->Reportmodel->get_totalcount_leads($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array1[$i]["totalcount"]=$gettotal_count['0']->count;
                      
                      $getopen_count = $this->Reportmodel->get_totalfollowups($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array1[$i]["opencount"]=$getopen_count['0']->count;
                      
                      $getclosed_count = $this->Reportmodel->get_totalclosed_leads($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array1[$i]["closedcount"]=$getclosed_count['0']->count;
                      if($array1[$i]["totalcount"]!='0')$array1[$i]["closedpercentage"] = (($array1[$i]["closedcount"]/$array1[$i]["totalcount"])*100); else  $array1[$i]["closedpercentage"]='0';
                      $closedpercentage = round($array1[$i]["closedpercentage"],2);
                      $getdrop_count = $this->Reportmodel->get_totaldropped_leads($array["data"][$i]->CampaignID,$from_date,$to_date);
                      $array1[$i]["droppedcount"]=$getdrop_count['0']->count;
                      if($array1[$i]["totalcount"]!='0')$array1[$i]["droppedpercentage"] = (($array1[$i]["droppedcount"]/$array1[$i]["totalcount"])*100); else  $array1[$i]["droppedpercentage"]='0';
                      $droppedpercentage = round($array1[$i]["droppedpercentage"],2);
                      fputcsv($output, (array($array1[$i]["CampaignName"],$array1[$i]["totalcount"],$array1[$i]["opencount"],$array1[$i]["closedcount"],$closedpercentage,$array1[$i]["droppedcount"], $droppedpercentage)));
                      }

                      
                      
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }
   public function generate_agent_csv()
  { 
    try {
          if($this->session->userdata('logged_in'))
            {       
                    //$date1 = new DateTime($date1);
                    //$date2 =  new DateTime($date2);
                    //$from = $date1->format('Y-m-d');
                    //$to = $date2->format('Y-m-d');
                    header('Content-type: application/csv');
                    header('Content-Type: text/csv; charset=utf-8');
                    header('Content-Disposition: attachment; filename=agent_summaryreport.csv');
                    // create a file pointer connected to the output stream
                    $output = fopen('php://output', 'w');

                   // output the column headings
                   fputcsv($output, array('Agent Name','Total','Open','Closed', 'Closed(%)','Dropped','Dropped(%)'));
 
                    $fileName = 'Campaign report-' . gmdate('Y-m-d') . '.csv';  
                    $from_date = $_SESSION["from_date"];
                    $to_date = $_SESSION["to_date"];
                    //echo $from_date."<br>";
                    //echo $to_date."<br>";
                     
                  $userrole = $this->session->userdata['logged_in']['user_role'];
                  
                    $data["agentdetails"]=$this->Reportmodel->get_agentdetails($userrole);
                   // print_r($data["campigndetails"]);
                    $count = count($data["agentdetails"]);
                    for($i=0;$i<$count;$i++)
                    {
                      $array["data"][$i]=$data["agentdetails"][$i];
                      $array1[$i]["AgentName"] = $array["data"][$i]->FirstName." ".$array["data"][$i]->LastName;
                      
                      $gettotal_count = $this->Reportmodel->get_agenttotalcount_leads($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array1[$i]["totalcount"]=$gettotal_count['0']->count;
                      
                      $getopen_count = $this->Reportmodel->get_agenttotalfollowups($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array1[$i]["opencount"]=$getopen_count['0']->count;
                      
                      $getclosed_count = $this->Reportmodel->get_agenttotalclosed_leads($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array1[$i]["closedcount"]=$getclosed_count['0']->count;
                       if($array1[$i]["totalcount"]!='0')$array1[$i]["closedpercentage"] = (($array1[$i]["closedcount"]/$array1[$i]["totalcount"])*100); else  $array1[$i]["closedpercentage"]='0';
                      $closedpercentage = round($array1[$i]["closedpercentage"],2);
                      $getdrop_count = $this->Reportmodel->get_agenttotaldropped_leads($array["data"][$i]->SystemUserID,$from_date,$to_date);
                      $array1[$i]["droppedcount"]=$getdrop_count['0']->count;
                      if($array1[$i]["totalcount"]!='0')$array1[$i]["droppedpercentage"] = (($array1[$i]["droppedcount"]/$array1[$i]["totalcount"])*100); else  $array1[$i]["droppedpercentage"]='0';
                       $droppedpercentage = round($array1[$i]["droppedpercentage"],2);
                      fputcsv($output, (array($array1[$i]["AgentName"],$array1[$i]["totalcount"],$array1[$i]["opencount"],$array1[$i]["closedcount"],$closedpercentage,$array1[$i]["droppedcount"], $droppedpercentage)));
                      
                      }

                      
                      
            }
    
      } catch (Exception $e)
      {
    
      }
     
  }
 function tableview( $data)
 {
  try {
      if($this->session->userdata('logged_in'))
      {   $HTML='';   
         $HTML .= '<table class="table table-striped table-bordered table-hover" id="sample_2">
              <thead>
              <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>State </th>
                <th>Status</th>';
         $HTML .='<th>Assigned To</th>';
         $HTML .='
                </tr>
              </thead>
              <tbody>';
              if(!empty($data))
                 //echo "<pre>";
                 //print_r($data);
                 //echo "</pre>";
    {
      $j='0';//$page++;
      $j++;
      foreach($data as $data) // user is a class, because we decided in the model to send the results as a class.
      {  
        if(strtolower($data->Status)=="4") $status = "Closed-Successfully";
        else if(strtolower($data->Status)=="5") $status = "Closed-Unsuccessfully";
        else $status = ucfirst($data->LeadStatus);
        if(strtolower($data->LastName)=="null")
          $data->LastName="";
        //$agentid = $array["data"]->SystemUserID;
        //$todate = $to_date;
        $HTML .= "<tr>"; 
        $HTML .="<td>".$j."</td>";             
        $HTML .="<td>".ucfirst($data->FirstName." ".$data->LastName)."</td>";
        $HTML .= "<td>".$data->Email."</td>";
        $HTML .= "<td>".($data->Phone)."</td>";
        $HTML .= "<td>".ucfirst(($data->StateName))."</td>";
        $HTML .= "<td>".$status."</td>";
        $HTML .="<td>".ucfirst($data->agentfname." ".$data->agentlname)."</td>";
        $HTML .= "</tr>"; 
        $j++;
      }
      $HTML .="</tbody>
              </table>";
    }
                //echo "array list <br><pre>";
                //print_r($array);
                //echo "</pre>";
                //$this->load->view('Reports/Campaignreport_view',$array);
          echo $HTML;
       
      }
      else
      {
               redirect('login');
      }
      
    } catch (Exception $e) { 
      
    }
  }
    function tableview_droppedleads($data,$status)
 {
  try {
      if($this->session->userdata('logged_in'))
      {   $HTML='';   
         $HTML .= '<table class="table table-striped table-bordered table-hover" id="sample_2">
              <thead>
              <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>State </th>
                <th>Status</th>';
         $HTML .='<th>Assigned To</th>';
         if($status=="5")
         $HTML .='<th>Dropped On</th>';
        elseif($status=="4")
          $HTML .='<th>Closed On</th>';
          $HTML .='
                </tr>
              </thead>
              <tbody>';
              if(!empty($data))
                 //echo "<pre>";
                 //print_r($data);
                 //echo "</pre>";
    {
      $j='0';//$page++;
      $j++;
      foreach($data as $data) // user is a class, because we decided in the model to send the results as a class.
      {  
         $status = ucfirst($data->LeadStatus);
        if(strtolower($data->LastName)=="null")
          $data->LastName="";
        //$agentid = $array["data"]->SystemUserID;
        //$todate = $to_date;
        $date1 = new DateTime($data->FollowupDate);
        $followupdate = $date1->format("d-m-Y"); 
        $HTML .= "<tr>"; 
        $HTML .="<td>".$j."</td>";  
        $data_content = "this is name of user";
        $data_title = "this is title";

        $HTML .="<td>".ucfirst($data->FirstName." ".$data->LastName)."</td>";
        $HTML .= "<td>".$data->Email."</td>";
        $HTML .= "<td>".($data->Phone)."</td>";
        $HTML .= "<td>".ucfirst(($data->StateName))."</td>";
        if($data->Status=="5" && $data->Remarks!="")
        {
          
          $HTML .= "<td>".$status."<br><strong>Reason:-&nbsp;</strong> ".$data->DropReason."<br><strong>Remarks:-&nbsp;</strong>".$data->Remarks."<br>"."</td>";
        }
        elseif($data->Status=="5" && $data->Remarks=="")
        {

          $HTML .= "<td>".$status."<br><strong>Reason:-&nbsp;</strong> ".$data->DropReason."</td>";

        }
        else  
        $HTML .= "<td >".$status."</td>";
        $HTML .="<td>".ucfirst($data->agentfname." ".$data->agentlname)."</td>";
        $HTML .= "<td>".$followupdate."</td>";
        $HTML .= "</tr>"; 
        $j++;
      }
      $HTML .="</tbody>
              </table>";
    }
    
                //echo "array list <br><pre>";
                //print_r($array);
                //echo "</pre>";
                //$this->load->view('Reports/Campaignreport_view',$array);
          echo $HTML;
       
      }  
      else
      {
               redirect('login');
      }
      
    } catch (Exception $e) { 
      
    }
     
 } 
}  
?>