<form action="upload" method="post" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit">
</form>


<?php
error_reporting(0);

echo $name = $_FILES['file']['name'];
//$size = $_FILES['file']['size'];
//$type = $_FILES['file']['type'];

echo $tmp_name = $_FILES['file']['tmp_name'];

if (isset($name))
{
  if(!empty($name))
 {
  echo  $location = 'uploads/';

      if(move_uploaded_file($tmp_name, $location.$name))
        {
          echo 'uploaded';
        }

      else 
	  {
        echo 'please choose file';
      }
  }
}


?>
<input type="text" value= "<?php echo $name; ?>"  />