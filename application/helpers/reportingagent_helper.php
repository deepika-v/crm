<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('reportingto'))
{
    function reportingto($userroleid,$assigndetails,$current_user_role,$userid)
    {
        try{

            if(!empty($assigndetails))
            {
              //print_r($assigndetails);

              $userrole_count = count($userroleid);
              $assigndetails_count = count($assigndetails);
              $k=0;
              $no=0;
              $sub_reporting_agent = array();
              for($a=0;$a<$assigndetails_count;$a++)
               {
                 if($assigndetails[$a]->UserRoleID == $current_user_role)
                  {
                     {   
                         $sub_reporting_agent[$k]['SystemUserID'] = $assigndetails[$a]->SystemUserID;
                         $sub_reporting_agent[$k]['ReportingTo'] = $assigndetails[$a]->ReportingTo;
                         $sub_reporting_agent[$k]['FirstName'] = $assigndetails[$a]->FirstName;
                         $sub_reporting_agent[$k]['LastName'] = $assigndetails[$a]->LastName;
                         $sub_reporting_agent[$k]['UserName'] = $assigndetails[$a]->UserName;
                         $sub_reporting_agent[$k]['UserRoleID'] = $assigndetails[$a]->UserRoleID;
                         $sub_reporting_agent[$k]['Email'] = $assigndetails[$a]->EmailId;
                         $sub_reporting_agent[$k]['MobileNo'] = $assigndetails[$a]->MobileNo;
                         $sub_reporting_agent[$k]['DOB'] = $assigndetails[$a]->DOB;
                         $sub_reporting_agent[$k]['Address'] = $assigndetails[$a]->Address;
                         $sub_reporting_agent[$k]['City'] = $assigndetails[$a]->City;
                         $sub_reporting_agent[$k]['State'] = $assigndetails[$a]->State;
                         $sub_reporting_agent[$k]['Country'] = $assigndetails[$a]->Country;
                         $sub_reporting_agent[$k]['IsActive'] = $assigndetails[$a]->IsActive;
                         $sub_reporting_agent[$k]['UserRole'] = $assigndetails[$a]->UserRole;
                         $sub_reporting_agent[$k]['ReportingFName'] = $assigndetails[$a]->ReportingFName;
                         $sub_reporting_agent[$k]['ReportingLName'] = $assigndetails[$a]->ReportingLName;

                         //find_agent_reporting_to($assigndetails,$assigndetails[$j]->ReportingTo,$k++);
                           $k++;
                      }
                    }
                 }
                 for($i=0;$i<$userrole_count;$i++)
                  { 
                    if($userroleid[$i]->UserRoleID >= $current_user_role)
                     {
                       for($j=0;$j<$assigndetails_count;$j++)
                       {
                        if($assigndetails[$j]->UserRoleID==$userroleid[$i]->UserRoleID)
                        {
                         if(((($assigndetails[$j]->SystemUserID != $userid) 
                              && $assigndetails[$j]->ReportingTo == $userid)))
                          {
                            {   
                                          $reporting_agent[$no]['SystemUserID'] = $assigndetails[$j]->SystemUserID;
                                          $reporting_agent[$no]['ReportingTo'] = $assigndetails[$j]->ReportingTo;
                                          $reporting_agent[$no]['FirstName'] = $assigndetails[$j]->FirstName;
                                          $reporting_agent[$no]['LastName'] = $assigndetails[$j]->LastName;
                                          $reporting_agent[$no]['UserName'] = $assigndetails[$j]->UserName;
                                          $reporting_agent[$no]['UserRoleID'] = $assigndetails[$j]->UserRoleID;
                                          $reporting_agent[$no]['Email'] = $assigndetails[$j]->EmailId;
                                          $reporting_agent[$no]['MobileNo'] = $assigndetails[$j]->MobileNo;
                                          $reporting_agent[$no]['DOB'] = $assigndetails[$j]->DOB;
                                          $reporting_agent[$no]['Address'] = $assigndetails[$j]->Address;
                                          $reporting_agent[$no]['City'] = $assigndetails[$j]->City;
                                          $reporting_agent[$no]['State'] = $assigndetails[$j]->State;
                                          $reporting_agent[$no]['Country'] = $assigndetails[$j]->Country;
                                          $reporting_agent[$no]['IsActive'] = $assigndetails[$j]->IsActive;
                                          $reporting_agent[$no]['UserRole'] = $assigndetails[$j]->UserRole;
                                          $reporting_agent[$no]['ReportingFName'] = $assigndetails[$j]->ReportingFName;
                                          $reporting_agent[$no]['ReportingLName'] = $assigndetails[$j]->ReportingLName;
                                          $no++;
                                          for($a=0;$a<$assigndetails_count;$a++)
                                          {
                                            if($assigndetails[$a]->ReportingTo == $assigndetails[$j]->SystemUserID )
                                             {
                                              {   
                                                   $sub_reporting_agent[$k]['SystemUserID'] = $assigndetails[$a]->SystemUserID;
                                                   $sub_reporting_agent[$k]['ReportingTo'] = $assigndetails[$a]->ReportingTo;
                                                   $sub_reporting_agent[$k]['FirstName'] = $assigndetails[$a]->FirstName;
                                                   $sub_reporting_agent[$k]['LastName'] = $assigndetails[$a]->LastName;
                                                   $sub_reporting_agent[$k]['UserName'] = $assigndetails[$a]->UserName;
                                                   $sub_reporting_agent[$k]['UserRoleID'] = $assigndetails[$a]->UserRoleID;
                                                   $sub_reporting_agent[$k]['Email'] = $assigndetails[$a]->EmailId;
                                                   $sub_reporting_agent[$k]['MobileNo'] = $assigndetails[$a]->MobileNo;
                                                   $sub_reporting_agent[$k]['DOB'] = $assigndetails[$a]->DOB;
                                                   $sub_reporting_agent[$k]['Address'] = $assigndetails[$a]->Address;
                                                   $sub_reporting_agent[$k]['City'] = $assigndetails[$a]->City;
                                                   $sub_reporting_agent[$k]['State'] = $assigndetails[$a]->State;
                                                   $sub_reporting_agent[$k]['Country'] = $assigndetails[$a]->Country;
                                                   $sub_reporting_agent[$k]['IsActive'] = $assigndetails[$a]->IsActive;
                                                   $sub_reporting_agent[$k]['UserRole'] = $assigndetails[$a]->UserRole;
                                                   $sub_reporting_agent[$k]['ReportingFName'] = $assigndetails[$a]->ReportingFName;
                                                   $sub_reporting_agent[$k]['ReportingLName'] = $assigndetails[$a]->ReportingLName;
                                                   //find_agent_reporting_to($assigndetails,$assigndetails[$j]->ReportingTo,$k++);
                                                   $k++;
                                              }
                                            }
                                          }
                                          

                                          
                                        }
                                        
                                      }
                                    }
                                  }
                                }
                              }
          }
          if(!empty($reporting_agent))
          {
            if(!empty($sub_reporting_agent))
            {
              $assign_array=array_merge($reporting_agent,$sub_reporting_agent);
               $count_agenttable = count($assign_array);
               for($i=0;$i<$count_agenttable;$i++)
                {
                     $tmp[$i] = $assign_array[$i]["UserRoleID"];
                }
           // print_r($tmp);
            //array_multisort($tmp,SORT_ASC,$assign_array);
               for($i=0;$i<count($assign_array);$i++)
                   $assigndetails_array[$i]= (object)$assign_array[$i];

            }
            else
            {
              $assign_array=$reporting_agent;
               $count_agenttable = count($assign_array);
               for($i=0;$i<$count_agenttable;$i++)
               {
                     $tmp[$i] = $assign_array[$i]["UserRoleID"];
                }
           // print_r($tmp);
            //array_multisort($tmp,SORT_ASC,$assign_array);
               for($i=0;$i<count($assign_array);$i++)
                   $assigndetails_array[$i]= (object)$assign_array[$i];

            }


          }
          else
           {
            $assign_array=$sub_reporting_agent;
               $count_agenttable = count($assign_array);
               for($i=0;$i<$count_agenttable;$i++)
               {
                     $tmp[$i] = $assign_array[$i]["UserRoleID"];
                }
           // print_r($tmp);
            //array_multisort($tmp,SORT_ASC,$assign_array);
               for($i=0;$i<count($assign_array);$i++)
                   $assigndetails_array[$i]= (object)$assign_array[$i];
           } 
          
              
        //echo "<pre>";      
        //print_r($assigndetails_array);
        //echo "</pre>"; 
      //  echo "<pre>";
      //print_r($sub_reporting_agent);
      //echo "</pre>";   
               return $assigndetails_array;
                  
            } catch(Execptions $ex)
            {
   

            }  
        
    }
}



/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */