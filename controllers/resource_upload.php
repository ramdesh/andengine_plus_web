<?php
/*$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["resourceFile"]["name"]));*/
/**/
if ( (($_FILES["resourceFile"]["type"] == "image/gif")
		|| ($_FILES["resourceFile"]["type"] == "image/jpeg")
		|| ($_FILES["resourceFile"]["type"] == "image/png")
		|| ($_FILES["resourceFile"]["type"] == "image/pjpeg"))
		&& ($_FILES["resourceFile"]["size"] < 20000) )
{
	if ($_FILES["resourceFile"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		echo "Upload: " . $_FILES["resourceFile"]["name"] . "<br>" .
			 "Type: " . $_FILES["resourceFile"]["type"] . "<br>".
			 "Size: " . ($_FILES["resourceFile"]["size"] / 1024) . " kB<br>".
			 "Temp file: " . $_FILES["resourceFile"]["tmp_name"] . "<br>";

		if (file_exists("upload/" . $_FILES["resourceFile"]["name"]))
		{
			echo $_FILES["resourceFile"]["name"] . " already exists. ";
		}
		else
		{
			move_uploaded_file($_FILES["resourceFile"]["tmp_name"],
			"../resources/" . $_FILES["resourceFile"]["name"]);
			echo "Stored in: " . "resources/" . $_FILES["file"]["name"];
		}
	}
}
else
{
	echo "Invalid file";
}
?>