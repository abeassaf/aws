<?php /*
File Name: aws.php
Author: Abe Assaf
This php script takes two inputs from the user. AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY. The submit form will use
POST method as it's more secure than the GET method. For optimal security use SSL with web interface. This  script will
also call a BASH  script (aws.sh). The aws.sh script will create json files for each of the AWS products (ec2, rds, elb,
elastic cache, and cloudformation). After the json files been created, this php script will parse the files and dump the
content to the screen.
 */
?>
<form action="aws.php" method="post">
AWS_ACCESS_KEY: <input type="text" name="aws-access_key"><br>
AWS_SECRET_KEY: <input type="text" name="aws_secret_key"><br>
<input type="submit">
</form>
<?php

/* declaring array for the products need description */
$aws = array("ec2","rds","elb","elc","clf");
/* check if the user typed the aws-access_key and aws_secret_key after submit */
if (empty($_POST["aws-access_key"]) || empty($_POST["aws_secret_key"])) 
{
echo "Error: all fields are  required";
exit();
}
/* Assigning the POST data to variables */
$accessKey=$_POST["aws-access_key"]; 
$accessPasswd=$_POST["aws_secret_key"]; 
/*  Setting up the AWS CLI environment*/
putenv("AWS_ACCESS_KEY_ID=$accessKey");
putenv("AWS_SECRET_ACCESS_KEY=$accessPasswd");
putenv("AWS_DEFAULT_REGION=us-east-1");
/* Calling the  bash script to genrate the json files */
$message=shell_exec("aws.sh 2>&1");
/* loop through the products array */
foreach ($aws as $product)
  {
  $productj =  $product . "_json";
  /* Reading the json files */
  $productj  = file_get_contents("/tmp/$product.json");
  /* Decoding json files */
  $productd =  json_decode($productj); 
  /* Getting the property name of the json object */     
 $propertyName = key(get_object_vars($productd));
  /* creating an arry of the object data */
$output = $productd->$propertyName;
echo "<!DOCTYPE html>";
echo  "<html>";
echo "<head>";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo "<title>Describe AWS products</title>";
echo "</head>";
echo "<body>";
echo "<h1>";

/* Displaying product name one by one */
echo  strtoupper($product);
echo ":</h1>";
echo "<pre><h4><";
/* Dump the object array data to the screen */
var_dump($output) ;
echo "></h4></pre>";
echo  "</body>";
echo "</html>";
}
?>
