<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('productcategory'))
{
    function productcategory($categorydetails,$productdetails)
    {

         $data["categorydetails"] = $categorydetails;
         $data["productdetails"] = $productdetails;
        $category_count=count($data["categorydetails"]);
        for($i=0;$i<$category_count;$i++)
        {
          $data["categorylist"][$i]=(array)$data["categorydetails"][$i];

        }
        $product_count = count($data["productdetails"]);
        $k=0;
        for($i=0; $i<$product_count;$i++)
        {//for loop to convert csv fields extracted from database to single row of table
          $product["data"][$i]=(array)$data["productdetails"][$i];

          $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
          //$product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);
          $count_productcategory = count($product_category[$i]);
          $product["data"][$i]["count"]=$count_productcategory;

          if($product["data"][$i]["count"]>"1")
          {
          
            for($l=0;$l<$product["data"][$i]["count"];$l++)
            {
                $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
                //$product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);            
                $productdetails["data"][$k]["productname"] = $product["data"][$i]["ProductName"];
                $productdetails["data"][$k]["productid"] = $product["data"][$i]["ProductId"];
                $productdetails["data"][$k]["typeid"] = $product["data"][$i]["TypeId"];
                $productdetails["data"][$k]["publishedstatus"] = $product["data"][$i]["PublishedStatus"];
                $productdetails["data"][$k]["categoryid1"] = $product_category[$i][$l];
                //$productdetails["data"][$k]["categoryname1"] = $product_categoryname[$i][$l];
                $k++;                          
            }  
          }
          else if($product["data"][$i]["count"]=="1"){
            //echo "in if";
            for($l=0;$l<$product["data"][$i]["count"];$l++)
          {
            $product_category[$i] = explode(',',$product["data"][$i]["CategoryIds"]);
            //$product_categoryname[$i] = explode(',',$product["data"][$i]["categoryname"]);            
            $productdetails["data"][$k]["productname"] = $product["data"][$i]["ProductName"];
            $productdetails["data"][$k]["productid"] = $product["data"][$i]["ProductId"];
            $productdetails["data"][$k]["typeid"] = $product["data"][$i]["TypeId"];
            $productdetails["data"][$k]["publishedstatus"] = $product["data"][$i]["PublishedStatus"];
            $productdetails["data"][$k]["categoryid1"] = $product_category[$i][$l];
            //$productdetails["data"][$k]["categoryname1"] = $product_categoryname[$i][$l];
            $k++;                          
          }  


          }

        }
        $productcount=count($productdetails["data"]);
         
         for($m=0;$m<count($data["categorylist"]);$m++)
         {
            for($n=0;$n<$productcount;$n++)
            {
                if($data["categorylist"][$m]['CategoryId']==$productdetails["data"][$n]["categoryid1"])
                {
                 if($data["categorylist"][$m]['ParentCategoryId']=="0")
                 {
                     $productdetails["data"][$n]["parentcategoryid"] = "0";                 
                     $productdetails["data"][$n]["HasChild"] = "0";
                     $productdetails["data"][$n]["parentcategoryname"]="0";  
                 }
                 else
                 {
                    $productdetails["data"][$n]["parentcategoryid"] = $data["categorylist"][$m]['ParentCategoryId'];
                    $data["categorylist_1"] = $data["categorylist"];
                    for($p=0;$p<count($data["categorylist_1"]);$p++)
                    {
                      if($data["categorylist_1"][$p]['CategoryId']==$data["categorylist"][$m]['ParentCategoryId'])
                      $productdetails["data"][$n]["parentcategoryname"] = $data["categorylist_1"][$p]['CategoryName'];
                    }
                    //$productdetails["data"][$n]["parentcategoryname"]= $data["categorylist"][$m]['ParentCategoryId'];
                    $productdetails["data"][$n]["HasChild"] = "1";  
                 }
                }

            }            
         } 
           if(!empty($productdetails["data"])) 
           {
            $count = count($productdetails["data"]);
                for($i=0;$i<$count;$i++)
             {
              $tmp[$i] = $productdetails["data"][$i]["parentcategoryname"];
             }
               array_multisort($tmp, SORT_DESC, $productdetails["data"]);
            }
         $HTML='';
         $categorylist_count = count($data["categorylist"]);
         $product_details_count = count($productdetails["data"]);
    for($i=0;$i<$categorylist_count;$i++)
     {
      $category_array[$i] = $data["categorylist"][$i]['ParentCategoryId'];
     }
     $category = array_merge(array_unique($category_array));
     $parentcategory_count = count($category);
     
     for($j=0;$j<$parentcategory_count;$j++)
     { 
       if($category[$j]<>"0")
        {
         for($i=0;$i<$categorylist_count;$i++)
          {
           if($data["categorylist"][$i]['CategoryId'] == $category[$j])
           {  
             $result = get_category_list($data["categorylist"][$i]['CategoryId'],$productdetails["data"],$data["categorylist"]);
             if($result<>"0")
             {
              $HTML .= '<optgroup label="'.$data['categorylist'][$i]['CategoryName'].'">';
              $HTML .= '<option value="0" hidden></option>';
              $HTML .= $result;
             }
             
           }
          }
        }       
      }
      $productlist_count = count($productdetails["data"]);
       for($j=0;$j<$categorylist_count;$j++)
           {
            if($data['categorylist'][$j]['ParentCategoryId']=="0")
            { 
              $HTML .= '<optgroup label="'.$data['categorylist'][$j]['CategoryName'].'">';
              for($i=0;$i<$productlist_count;$i++)
             {
                if($productdetails["data"][$i]["categoryid1"]==$data['categorylist'][$j]['CategoryId'])
                {                 
                  $HTML .= "<option value =".$productdetails["data"][$i]["productid"].">".$productdetails["data"][$i]["productname"]."</option>";
                }
           
             }
            }
            
             
           }
      
       
       return $HTML;//productdetails["data"];             
    }
}
if(! function_exists('get_product_list'))
{
     function get_product_list($categoryid,$productdetails,$categorylist)
     {     $HTML = '';
           $res = '';
           $subcategory = '';
           $productlist_count = count($productdetails);
           $categorylist_count = count($categorylist);
           for($j=0;$j<$categorylist_count;$j++)
           {
            if($categorylist[$j]['CategoryId']==$categoryid)
            { 
              $subcategory = '<optgroup label="--->'.$categorylist[$j]['CategoryName'].'">';
              for($i=0;$i<$productlist_count;$i++)
             {
                if($productdetails[$i]["categoryid1"]==$categoryid)
                {                 
                  $res .= "<option value =".$productdetails[$i]["productid"].">".$productdetails[$i]["productname"]."</option>";
                }
           
             }
            }
             
           }
          if($res=='') 
          {
            return 0;
          }
          else
          {
               $HTML .=$subcategory;
               $HTML .=$res;
               $HTML .= "<option value='0'></option>";
       return $HTML;

          }
       
     }
}


if(! function_exists('get_category_list'))
{

    function get_category_list($categoryid,$productdetails,$categorylist)
     {     $HTML = '';
           $categorylist_count = count($categorylist);
           for($i=0;$i<$categorylist_count;$i++)
           {
             if($categorylist[$i]["ParentCategoryId"]==$categoryid)
             {  

                $HTML .= get_product_list($categorylist[$i]['CategoryId'],$productdetails,$categorylist);
                
             }
           
           }
           if($HTML=='') 
          {
            return 0;
          }
          else
          {
               
          return $HTML;

          }
         

     }

}

/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */