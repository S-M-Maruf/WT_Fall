<?php

if(isset($_REQUEST["Submit"]))
{
    if(empty($_REQUEST["email"]) || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$_REQUEST["email"]))  
      {  
           //$error = "<label>Enter Name</label>"; 
           echo "<h3>Please provide your email</h3>";
      }
      else
      {
        // read json file
$data = file_get_contents('../File/admindata.json');

// decode json to associative array
$json_arr = json_decode($data, true);

// get array index to delete
$arr_index = array();
foreach ($json_arr as $key => $value)
{
    if ($value["email"] == $_REQUEST["email"])
    {
        $arr_index[] = $key;
    }
}

// delete data
foreach ($arr_index as $i)
{
    unset($json_arr[$i]);
    echo "<h3>Admin Deleted</h3>";
}

// rebase array
$json_arr = array_values($json_arr);

// encode array to json and save to file
file_put_contents('../File/admindata.json', json_encode($json_arr,JSON_PRETTY_PRINT));
      }
}


if(isset($_REQUEST['Submit2']))
{
    if(empty($_REQUEST["email2"]) || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$_REQUEST["email2"]))  
      {  
           //$error = "<label>Enter Name</label>"; 
           echo "<h3>Please provide your email</h3>";
      }
    else if(empty($_REQUEST["pass"]))
    {
        echo "<h3>Please provide password</h3>";
    }
    else
    {
        $data = file_get_contents('../File/admindata.json');

        // decode json to array
        $json_arr = json_decode($data, true);

        foreach ($json_arr as $key => $value) {
            if ($value['email'] == $_REQUEST['email2']) {
                $json_arr[$key]['pass'] = $_REQUEST['pass'];
                echo "<h3>Password changed</h3>";
            }
        }

// encode array to json and save to file
        file_put_contents('../File/admindata.json', json_encode($json_arr,JSON_PRETTY_PRINT));
    }
}


?>