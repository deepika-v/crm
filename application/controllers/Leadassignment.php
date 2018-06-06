<?php defined('BASEPATH')OR exit('No direct script access allowed');
class Leadassignment extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
       ini_set('memory_limit', '-1');
       $this->load->library('form_validation'); 
       $this->load->library('session');
		   $this->load->model('Campaignmodel');
       $this->load->library('pagination'); 
  }
  
  public function index() 
  {
    try {
      if($this->session->userdata('logged_in'))
      {      
       $data["flag"]="0"; 
       $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign();
       $data["agentdetails"]=$this->Campaignmodel->get_agentdetails();
       $data["assigndetails"]=$this->Campaignmodel->get_agentdetails();
       $data["userroleid"]=$this->Campaignmodel->get_userrole();           
       $this->load->view('Campaign/Leadassignment_view1',$data);
      }
      else
      {
               redirect('login');
      }
      
    } catch (Exception $e) { 
      
    }

     
        }//END OF INDEX FUNCTION 
public function Search()
{ 
  try 
  {
    $HTML = "";
    $flag = "0";
    //echo memory_get_usage();
             $campaignID = $_POST['campaignid'];
            $contact_type = $_POST['contacttype'];
            $lead_status = $_POST['leadstatus'];
            $agent_id = $_POST['agentid'];
             $data["flag"]="0"; 
             $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign();
             $data["agentdetails"]=$this->Campaignmodel->get_agentdetails();
             $data["assigndetails"]=$this->Campaignmodel->get_agentdetails(); 
             $data["userroleid"]=$this->Campaignmodel->get_userrole();          
            $data["agent_tabledetails"]=$this->Campaignmodel->get_agent_table_details($agent_id,$campaignID,$contact_type,$lead_status,'0');
           // echo "<br>";
            //print_r($data["agent_tabledetails"]);
            $count_agenttable = count($data["agent_tabledetails"]);
            for($i=0;$i<$count_agenttable;$i++)
             $array_agenttable[$i]=(array)$data["agent_tabledetails"][$i];    
            if(empty($data["agent_tabledetails"]))
            {
              $flag = "1";
               for($i=0;$i<$count_agenttable;$i++)
                     $array_agenttable[$i]=(array)$data["agent_tabledetails"][$i];    
               $array_agenttable['0']['tablevalue']="No record found";
               for($i=0;$i<count($array_agenttable);$i++)
                       $agentjson_array[$i]= (object)$array_agenttable[$i];
               $datajson = json_encode($agentjson_array); 
               $data["agentjson_array"]=$agentjson_array;
               
            }
            else
            { 
                $data["agent_inother_cmp"]=$this->Campaignmodel->getcandidates_othercampaign($agent_id,$campaignID,$contact_type,$lead_status);
                $count_othercampaign = count($data["agent_inother_cmp"]);
                for($i=0;$i<$count_agenttable;$i++)
                {
                  $array_agenttable[$i]["flag"] = "0";
                  $array_agenttable[$i]["tablevalue"] = "0";
                  $array_agenttable[$i]["exists"] = "0";
                  $array_agenttable[$i]["AgentName"] = "";
                }
               // print_r($array_agenttable);
                if($count_othercampaign>1)
                {
                  for($i=0;$i<$count_othercampaign;$i++)
                     $array_othercampaign[$i]=(array)$data["agent_inother_cmp"][$i];    
                $k=0;
                $userlist=array();
                for($i=0;$i<$count_agenttable;$i++)
                {
                     if($array_agenttable[$i]["AssignedTo"] != "0"){
                      $agent_name = $this->Campaignmodel->get_agentname($array_agenttable[$i]["AssignedTo"]);
                      $assignedto = (array)$agent_name['0'];
                      //print_r($assignedto);
                      $array_agenttable[$i]["AgentName"] = $assignedto['FirstName']." ".$assignedto['LastName'];
                              


                     }
                    for($j=0;$j<$count_othercampaign;$j++)
                    {
                      if($array_agenttable[$i]["ContactsID"]==$array_othercampaign[$j]["ContactsID"])
                      {
                          $userlist[$k]["ContactsID"]=$array_othercampaign[$j]["ContactsID"];
                          $userlist[$k]["CampaignID"]=$campaignID;
                          $userlist[$k]["AgentID"]=$agent_id;
                          $k++;
                      }
                    }
                }
                if(!empty($userlist))
                   $count_userlist = count($userlist); 
                 //echo "<pre>";
                 //print_r($userlist);
                 //echo "</pre>";
                }
              //echo "<br> count_userlist is:- ".$count_userlist;
                if(!empty($array_agenttable))
                {
                if(!empty($userlist))
                {
                    for($i=0;$i<$count_agenttable;$i++)
                     {
                        for($j=0;$j<$count_userlist;$j++)
                        {
                            if($array_agenttable[$i]["ContactsID"]==$userlist[$j]["ContactsID"])
                            {
                                $array_agenttable[$i]["CampaignID"] = $userlist[$j]["CampaignID"];
                                $array_agenttable[$i]["AgentID"] = $userlist[$j]["AgentID"];
                                $array_agenttable[$i]["tablevalue"] = "0";
                                $array_agenttable[$i]["exists"] = "1";
                            }
                           // else
                            //{
                              //  $array_agenttable[$i]["CampaignID"] = $userlist[$j]["CampaignID"];
                                //$array_agenttable[$i]["AgentID"] = $userlist[$j]["AgentID"];
                                ///$array_agenttable[$i]["tablevalue"] = "0";
                                //$array_agenttable[$i]["exists"] = "0";
                            //}
                        }
                      }
                }
              }
                //echo "<pre>";
                //print_r($array_agenttable);
                //echo "</pre>";
              if(!empty($array_agenttable)){
                for($i=0;$i<$count_agenttable;$i++)
             {
              $tmp[$i] = $array_agenttable[$i]["exists"];
             }
           // print_r($tmp);
            array_multisort($tmp, SORT_DESC, $array_agenttable);
              }
              
              for($i=0;$i<count($array_agenttable);$i++)
                $agentjson_array[$i]= (object)$array_agenttable[$i];
             // echo "in controller";
              //print_r($agentjson_array);
              //$data["flag"]="0";
               
              $data["agentjson_array"] = $agentjson_array; 
          
        }
      //print_r($agentjson_array['0']->tablevalue);
         if($flag!="1")
              {
              $HTML .=  '<p style=" width:250px; height:30px; margin-left:200px; margin-top:10px; margin-bottom:-30px; background-color:#eeeeee;">&nbsp;&nbsp;<font size:20px;><label style="background-color:#99ffcc; margin-top:05px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;</label>&nbsp;Leads&nbsp;&nbsp;&nbsp;&nbsp;<label style="background-color:#ffffff;margin-top:05px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;</label>&nbsp;Prospects</p> 
              <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
              <tr>
               <th class="table-checkbox"><input type="checkbox" class="group-checkable" value="0" id ="select_all" name="chk[]" data-set="#sample_1 .checkboxes" checked/>                
                </th>
                <th> Candidate Name </th>
                <th>Email</th>
                <th>Phone No.</th>
                <th>State </th>
                <th>Assigned To</th>
                 </tr>
              </thead>
              <tbody>';

              
                //print_r($agentjson_array);
                if($agentjson_array['0']->tablevalue!="No record found"){
                  foreach($agentjson_array as $agentjson_array) // user is a class, because we decided in the model to send the results as a class.
                      {
                        if(strtolower($agentjson_array->LastName)=="null")
                          $agentjson_array->LastName = "";
                        if(strtolower($agentjson_array->FirstName)=="null")
                          $agentjson_array->FirstName = "";
                        if(strtolower($agentjson_array->Email)=="null")
                          $agentjson_array->Email = "";


                        if($agentjson_array->ContactType == "Lead")
                        $HTML .= "<tr style='background-color:#99ffcc;'>"; 
                        else $HTML .= "<tr style='background-color:#ffffff;' >"; 
                        $HTML .= "<td><input type='checkbox' class='checkboxes' name='chk[]' checked value='".$agentjson_array->ContactsID."'/></td>";
                        if($agentjson_array->exists == "1")
                        $HTML .='<td>'.ucfirst($agentjson_array->FirstName." ".$agentjson_array->LastName).'&nbsp;&nbsp;<a href="" onclick="displaymodal('.$agentjson_array->CampaignID.','.$agentjson_array->AgentID.','.$agentjson_array->ContactsID.'); return false;"><i class="fa fa-info-circle fa-5x" aria-hidden="true"></i></a></td>';
                        else
                        $HTML .='<td>'.ucfirst($agentjson_array->FirstName." ".$agentjson_array->LastName).'</td>';
                        $HTML .= "<td>".$agentjson_array->Email."</td>";
                        $HTML .= "<td>".ucfirst($agentjson_array->Phone)."</td>";
                        $HTML .= "<td>".ucfirst($agentjson_array->StateName)."</td>";
                        $HTML .= "<td>".ucfirst($agentjson_array->AgentName)."</td>";
                        $HTML .= "</tr>"; 
                        //$j++;
                      }
                }
 

                
             $HTML .= '</tbody> </table>';
            }
            else{
              $HTML = "0";

              }
                   
             echo $HTML;
    
  } catch (Exception $e) {
    
  }
             
}
function get_assignment_table_details($agent_id,$campaignID,$contact_type,$lead_status)
{
  $data["agent_tabledetails"]=$this->Campaignmodel->get_agent_table_details($agent_id,$campaignID,$contact_type,$lead_status);
  $count_agenttable = count($data["agent_tabledetails"]);
  for($i=0;$i<$count_agenttable;$i++)
          $array_agenttable[$i]=(array)$data["agent_tabledetails"][$i];    
        if(empty($data["agent_tabledetails"]))
        {
           for($i=0;$i<$count_agenttable;$i++)
                   $array_agenttable[$i]=(array)$data["agent_tabledetails"][$i];    
           $array_agenttable['0']['tablevalue']="No record found";
           for($i=0;$i<count($array_agenttable);$i++)
                   $agentjson_array[$i]= (object)$array_agenttable[$i];
           $datajson = json_encode($agentjson_array); 
           //echo $datajson;
        }
        else
        {
        $data["agent_inother_cmp"]=$this->Campaignmodel->getcandidates_othercampaign($agent_id,$campaignID,$contact_type,$lead_status);
        $count_othercampaign = count($data["agent_inother_cmp"]);
        for($i=0;$i<$count_agenttable;$i++)
        {
          $array_agenttable[$i]["flag"] = "0";
          $array_agenttable[$i]["tablevalue"] = "0";
        }
       // print_r($array_agenttable);
        if($count_othercampaign>1)
        {
          for($i=0;$i<$count_othercampaign;$i++)
             $array_othercampaign[$i]=(array)$data["agent_inother_cmp"][$i];    
        $k=0;
        $userlist=array();
        for($i=0;$i<$count_agenttable;$i++)
        {
            for($j=0;$j<$count_othercampaign;$j++)
            {
              if($array_agenttable[$i]["ContactsID"]==$array_othercampaign[$j]["ContactsID"])
              {
                  $userlist[$k]["ContactsID"]=$array_othercampaign[$j]["ContactsID"];
                  $userlist[$k]["CampaignID"]=$campaignID;
                  $userlist[$k]["AgentID"]=$agent_id;
                  $k++;
              }
            }
        }
        if(!empty($userlist))
           $count_userlist = count($userlist); 
         //print_r($userlist);
      }
      //echo "<br> count_userlist is:- ".$count_userlist;
      if(!empty($array_agenttable))
      {
        if(!empty($userlist))
        {
            for($i=0;$i<$count_agenttable;$i++)
             {
                for($j=0;$j<$count_userlist;$j++)
                {
                    if($array_agenttable[$i]["ContactsID"]==$userlist[$j]["ContactsID"])
                    {
                        $array_agenttable[$i]["CampaignID"] = $userlist[$j]["CampaignID"];
                        $array_agenttable[$i]["AgentID"] = $userlist[$j]["AgentID"];
                        $array_agenttable[$i]["tablevalue"] = "0";
                        $array_agenttable[$i]["exists"] = "1";
                    }
                    else
                    {
                        $array_agenttable[$i]["CampaignID"] = $userlist[$j]["CampaignID"];
                        $array_agenttable[$i]["AgentID"] = $userlist[$j]["AgentID"];
                        $array_agenttable[$i]["tablevalue"] = "0";
                        $array_agenttable[$i]["exists"] = "0";
                    }
                }
              }
        }
      }
        //print_r($array_agenttable);
           for($i=0;$i<$count_agenttable;$i++)
             {
              $tmp[$i] = $array_agenttable[$i]["exists"];
             }
           // print_r($tmp);
            array_multisort($tmp, SORT_DESC, $array_agenttable);
      
      for($i=0;$i<count($array_agenttable_sorted);$i++)
        $agentjson_array[$i]= (object)$array_agenttable_sorted[$i];
      //print_r($array_agenttable);
       $datajson = json_encode($agentjson_array); 
       //print_r($data["agent_tabledetails"]);
      //echo $datajson;
    }
}
function get_assign_agent($agent_id){
  try {
    $HTML='';
      $assigndetails=$this->Campaignmodel->get_agentdetails();
      $userroleid=$this->Campaignmodel->get_userrole();    
          $userrole_count = count($userroleid);
          $assigndetails_count = count($assigndetails);
          $current_user_role = $this->session->userdata['logged_in']['user_role'];
          $HTML.="<option value='0'>Select Agent</option>";
                          $assigndetails_count = count($assigndetails);
                          for($i=0;$i<$userrole_count;$i++)
                          { 
                            if($userroleid[$i]->UserRoleID>=$current_user_role)
                            {
                               $HTML.= '<optgroup label="'.ucfirst($userroleid[$i]->UserRole).'">';
                            
                              for($j=0;$j<$assigndetails_count;$j++)
                              {  
                                if($assigndetails[$j]->UserRoleID==$userroleid[$i]->UserRoleID)
                                {  
                                  if($agent_id=='0')
                                  $HTML.= "<option value =".$assigndetails[$j]->SystemUserID.">".$assigndetails[$j]->FirstName." ".$assigndetails[$j]->LastName."</option>";
                                  else{
                                   if($assigndetails[$j]->SystemUserID != $agent_id)
                                    $HTML.= "<option value =".$assigndetails[$j]->SystemUserID.">".$assigndetails[$j]->FirstName." ".$assigndetails[$j]->LastName."</option>";
                                  }
                                  
                                }
                               
                              }

                            }
                                                   
                          }
              echo $HTML;
  //print_r($result);
 
    
  } catch (Exception $e) {
    
  }
   //echo $agent_id;

     //echo $HTML;
  }
public function assignleads() 
{ 
  if($this->session->userdata('logged_in'))
  {  
      $campaignid = $_POST['campaignid'];
      $contacttype = $_POST['contacttype'];
      $lead_status = $_POST['leadstatus'];
      $agent_id = $_POST['agentid'];
      $assignid = $_POST['assignid'];
      $assigndetails = $_POST['assigndetails'];
      $user_id = $_POST['contacts'];
      $flag = "0";
      $addedby = $this->session->userdata['logged_in']['userid'];
      $count =count($user_id);
      //print_r($user_id);
      if($lead_status=="U")
      {
        $status = "1";
      }
      else
      {
        $status = "2";
      }
      $result ="";
      $count = count($user_id);
      $dateleadconverted = date("Y-m-d H:i:s");
      $agentname =  $this->Campaignmodel->get_agentname($assignid);
      $assignedto = (array)$agentname['0'];
      if($assigndetails=="1")
      { 
        for($i=0;$i<$count;$i++)
        {
        if($user_id[$i]!="0")
        {
          $result =   $this->Campaignmodel->update_assignmentstatus($campaignid, $contacttype,$status,$addedby,$user_id[$i],$assignid,$assigndetails,$dateleadconverted);
          if($result!= FALSE)
          { //echo "in result true";
            $getcampaigncontactID =  $this->Campaignmodel->get_campaigncontactID($campaignid,$user_id[$i]);
            if($getcampaigncontactID != FALSE)
            {
               $assignment_log_data = array('CampaignContactID'=>$getcampaigncontactID['0']->CampaignContactID,
                                        'AssignedTo'=>$assignid,
                                        'CreatedBy'=>$addedby); 
            $insert = $this->Campaignmodel->insert_assignmentlog($assignment_log_data);
            if($insert != FALSE) $flag = "1";
            $status_log_data = array('CampaignContactID'=>$getcampaigncontactID['0']->CampaignContactID,
                                         'LeadStatusID' => '2',
                                         'CreatedBy' => $addedby);  
            $status = $this->Campaignmodel->insert_statuslog($status_log_data);
            if($status!=FALSE) $flag = "1";
            }                 
          }
        }
       }
      }
      else
      {
        $userid = "-1";
        $result =   $this->Campaignmodel->update_assignmentstatus($campaignid, $contacttype,$status,$addedby,$userid,$assignid,$assigndetails,$dateleadconverted);
        if($result!=FALSE)
        {
          $get_contacts =$this->Campaignmodel->get_agent_table_details($agent_id,$campaignid,$contacttype,$lead_status,$status);
        //print_r($get_contacts);
          if($get_contacts!=FALSE)
          {  
             $count_contacts =count($get_contacts);
            for($i=0;$i<$count_contacts;$i++)
            { 
              $getcampaigncontactID =  $this->Campaignmodel->get_campaigncontactID($campaignid,$get_contacts[$i]->ContactsID);
              //print_r($getcampaigncontactID);
              if($getcampaigncontactID!=FALSE)
              {
                //echo "in result true get campaign contact id";
                $assignment_log_data = array('CampaignContactID'=>$getcampaigncontactID['0']->CampaignContactID,
                                            'AssignedTo'=>$assignid,
                                            'CreatedBy'=>$addedby); 

               $insert = $this->Campaignmodel->insert_assignmentlog($assignment_log_data);
               if($insert!= FALSE) $flag = "1";
               $status_log_data = array('CampaignContactID'=>$getcampaigncontactID['0']->CampaignContactID,
                                         'LeadStatusID' => $status,
                                         'CreatedBy' => $addedby);  
               $status = $this->Campaignmodel->insert_statuslog($status_log_data);
               if($status!=FALSE) $flag = "1";
              }               
            }
          }         
         }
      }
     if($flag=="1")
      echo '<div id="flash-messages" class="alert alert-success text-center"> Lead successfully assigned to '.ucfirst($assignedto['FirstName']." ".$assignedto['LastName']).'</div>';
    if($flag=="0")
      echo '<div id="flash-messages" class="alert alert-info text-center"> Leads already assigned to '.ucfirst($assignedto['FirstName']." ".$assignedto['LastName']).'</div>';

      // redirect('Leadassignment');
     }
    else{
               redirect('login');
    }
        }//END OF INDEX FUNCTION 

  function display_assignment_details($campaignID,$AssignedTo,$ContactsID){
    $HTML ="";
     $getdetails = $this->Campaignmodel->displaymodal_details($campaignID, $AssignedTo,$ContactsID);
    // print_r($getdetails);
      for ($i=0;$i<count($getdetails);$i++){
     $details_array[$i] = (array)$getdetails[$i];
     }
     //print_r($details_array);  
    for ($i=0;$i<count($details_array);$i++)
    {
      if($details_array[$i]["LastName"]=="null"||$details_array[$i]["LastName"]=="Null" || $details_array[$i]["LastName"]=="" )
      {
      $details_array[$i]["LastName"]= "";
      }
      if($details_array[$i]["agentlname"]=="null"||$details_array[$i]["agentlname"]=="Null" || $details_array[$i]["agentlname"]=="" )
      {
      $details_array[$i]["agentlname"]= "";
      }
    }
      if(count($details_array)=="1")      
      $HTML .= "<strong>".$details_array['0']["FirstName"]." ".$details_array['0']["LastName"]."</strong>  is also assigned in following Campaign:-<br><br>";
    else
      $HTML .= "<strong>".$details_array['0']["FirstName"]." ".$details_array['0']["LastName"]."</strong>  is also assigned in following Campaigns:-<br><br>";
      $HTML .=  '<table class="table table-striped table-bordered table-hover" id="details_assignment">
              <thead>
              <tr>
                <th> Sr.no </th>
                <th>Campaign Name</th>
                <th>Handled By</th>
                <th>Assigned Date </th>
                <th>Status</th>
                 </tr>
              </thead>
              <tbody>'  ;
              $j=1;
      for ($i=0;$i<count($details_array);$i++)
      {
        $enddate = new DateTime($details_array[$i]["DateAdded"]);
                        $e_date = $enddate->format('d-m-Y');
                        

        $HTML .= "<tr>
                  <td>".$j."</td>
                  <td>".$details_array[$i]["CampaignName"]."</td>
                  <td>".$details_array[$i]["agentfname"]." ".$details_array[$i]["agentlname"]."</td>
                  <td>".$e_date."</td>
                  <td>".$details_array[$i]["LeadStatus"]."</td></tr>";
                  $j++;


      }        
    echo $HTML;



     
     
    
  }
  
 
 }  

?>