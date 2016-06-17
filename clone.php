<?php

//$username = "root";
//$password = "";
//$hostname = "localhost"; 
//
////connection to the database
//$dbhandle = mysql_connect($hostname, $username, $password)
//
//$db_selected = mysql_select_db('angular',$dbhandle)
//if (!$db_selected) {
//    die ('Can\'t use the db : ' . mysql_error());
//}
$errors = array();
//$data = array();
// Getting posted data and decodeing json
 $data = json_decode(file_get_contents('php://input'), true);
//print_r($data['name1']);
//exit;
// checking for blank values.
mysql_connect("localhost", "root", "") or die(mysql_error()); 
mysql_select_db("angular") or die(mysql_error());
//
//print_r($_GET['action']);
//exit;

if($_GET['action']=='add_mode')
{

if($data['name1'])
{
$name = $data['name1'];

$username = $data['username1'];

$email=$data['email1'];
//print_r($name);
//exit;
//
}
//print_r

$data = mysql_query("INSERT INTO angulartable(name,username,email) VALUES('".$name."','".$username."','".$email."')");


//$result= mysql_query("select * from angulartable");
//
//while ($row = mysql_fetch_array($result)) {
//  $execution[] = $row;
//}
//echo json_encode($execution);

refreshTableRow();
}

if($_GET['action']=='edit_product')
{
    $getID = $data['id'];
    $sql="select * from angulartable where id='$getID'";
    $getNames = mysql_query($sql);
//    while ($row = mysql_fetch_array($getNames)) {
//  $execution[] = $row;
//}
    //print_r($sql);
    //exit;
    while($row=mysql_fetch_array($getNames))
    {
        
        $data[] = array(
        "name" => $row['name'],
        "username" => $row['username'],
        "email" => $row['email']
        );
        
    }

    //print_r(json_encode($data));
    //exit;
    echo json_encode($data);
}

if($_GET['action']=='Update')
{
    
$id = $data['id'];
    
$name = $data['name'];

$username = $data['username'];

$email=$data['email'];
    $sql="UPDATE angulartable set name='$name',username='$username',email='$email' where id='$id'";
    $getNames = mysql_query($sql);

    refreshTableRow();
}

if($_GET['action']=='delete_product')
{
    $getID = $data['id'];
    $sql="Delete from angulartable where id='$getID'";
    $getNames = mysql_query($sql);
    //while($row=mysql_fetch_array($getNames))
    //{
        
    //    $data[] = $row;
        
    //}
    
    
    refreshTableRow();
    //print_r(json_encode($data));
    //exit;
    //echo json_encode($getNames);
}


function refreshTableRow()
{
    
$result= mysql_query("select * from angulartable");

while ($row = mysql_fetch_array($result)) {
  $execution[] = $row;
}
echo json_encode($execution);
}
?>