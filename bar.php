<?php
$error = '';
$ctitle = '';
$xtitle = '';
$ytitle = '';
$height = '';
$width = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripcslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST['']))
{
    if(empty($_POST['ctitle'])) 
    {
        $error .= '<p><label class='text-danger'>Please Enter the Chart Title</label></p>';
    } 
    else 
    {
        $ctitle = clean_text($_POST['ctitle']);
        if(!preg_match('/^[a-zA-Z]*$/', $ctitle))
        {
            $error .= '<p><label class='text-danger'>Only letters and white space allowed</label></p>';
        }
    }
    if(empty($_POST['xtitle'])) 
    {
        $error .= '<p><label class='text-danger'>Please Enter the X-Title</label></p>';
    } 
    else 
    {
        $xtitle = clean_text($_POST['xtitle']);
        if(!preg_match('/^[a-zA-Z]*$/', $xtitle))
        {
            $error .= '<p><label class='text-danger'>Only letters and white space allowed</label></p>';
        }
    }
    if(empty($_POST['ytitle'])) 
    {
        $error .= '<p><label class='text-danger'>Please Enter the Y-Title</label></p>';
    } 
    else 
    {
        $ytitle = clean_text($_POST['ytitle']);
        if(!preg_match('/^[a-zA-Z]*$/', $ytitle))
        {
            $error .= '<p><label class='text-danger'>Only letters and white space allowed</label></p>';
        }
    }
    if(empty($_POST['height'])) 
    {
        $error .= '<p><label class='text-danger'>Please Enter the height</label></p>';
    } 
    else 
    {
        $height = clean_text($_POST['height']);
        if(!preg_match('/^[a-zA-Z]*$/', $height))
        {
            $error .= '<p><label class='text-danger'>Only integer values</label></p>';
        }
    }
    if(empty($_POST['width'])) 
    {
        $error .= '<p><label class='text-danger'>Please Enter the width</label></p>';
    } 
    else 
    {
        $width = clean_text($_POST['width']);
        if(!preg_match('/^[a-zA-Z]*$/', $width))
        {
            $error .= '<p><label class='text-danger'>Only integer values</label></p>';
        }
    }
    if($error == '')
    {
        $file_open = fopen('contact_data.csv', 'a');
        $no_rows = count(file('contact_data.csv'));
        if($no_rows > 1)
        {
            $no_rows = ($no_rows - 1) + 1;
        }
        $form_data = array(
            'Sr_no.'      =>  $no_rows,
            'Chart Tile'  =>  $ctitle,
            'X-Title'     =>  $xtitle,
            'Y-Title'     =>  $ytitle,
            'Height'      =>  $height,
            'Width'       =>  $width,
        );
        fputcsv($file_open,$form_data);
        $error = '<label class='text-success'>Your entries have been recorded! </label>';
        $ctitle = '';
        $xtitle = '';
        $ytitle = '';
        $height = '';
        $width = '';
    }
    
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Line chart</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style media="screen">
  #upload {
  padding: 5px;
  color: rgb(250, 248, 248);
  background-color: rgb(79, 243, 88);
  border: 1px solid #000000;
  border-radius: 5px;
  cursor: pointer;
}

#upload:hover {
  background-color: rgb(35, 102, 8);
}
#custom-text {
  margin-left: 10px;
  font-family: sans-serif;
  color: #aaa;
}
#CreateChart{
  padding: 5px;
  color: rgb(250, 248, 248);
  background-color: rgb(79, 243, 88);
  border: 1px solid #000000;
  border-radius: 5px;
  cursor: pointer;
}
</style>
</head>
  <body>
      <h1>Line Chart</h1>
      <div class = "barchart">
        <h2>Customize your visualization</h2>
      <form method="post" id="barchart" action="">
          
          <label> Chart Title </label><br>
          <input type="text" name="ctitle" id="title"
          placeholder="Enter your Chart Title" class='form-control' value='<?php echo $ctitle; ?>' /><br><br>
          <label> X-Title </label><br>
          <input type="text" name="xtitle" id="title"
          placeholder="Enter your X-Title"><br><br>
          <label> Y-Title </label><br>
          <input type="text" name="ytitle" id="title"
          placeholder="Enter your Y-Title"><br><br>
          <label> Height </label><br>
         <input type="number" id="height" name="height" step="1" min="0" max="1000"
          placeholder="select height"><br><br>
          <label> Width </label><br>
          <input type="number" id="width" name="width" step="1" min="0" max="1000"
          placeholder="select width"><br><br>
          <div class="inline-div">
            <p align="center">X-Values</p>
            <textarea cols="15" rows="15" class="inline-txtarea"></textarea> 
        </div>
        <div class="inline-div">
        <p align="center">Y-Values</p>
            <textarea cols="15" rows="15" class="inline-txtarea"></textarea>  
        </div><br><br>
        <div class="form-control" align="center">
            <input type="submit" name="Create Chart"
            class="btn btn-info" id="CreateChart" value="Create Chart"  />
        </div><br>
        <label> Or upload your CSV file </label><br><br>
          <input type="file" id="real-file" hidden="hidden"/>
          <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
          <script type="text/javascript">
              $(function () {
                  $("#upload").bind("click", function () {
                      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                      if (regex.test($("#fileUpload").val().toLowerCase())) {
                          if (typeof (FileReader) != "undefined") {
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                  var entities = new Array();
                                  var rows = e.target.result.split("\r\n");
                                  for (var i = 0; i < rows.length; i++) {
                                      var cells = rows[i].split(",");
                                      if (cells.length > 1) {
                                          var entity = {};
                                          entity.rows = cells[0];
                                          entity.colums = cells[1];
                                          entities.push(entity);
                                      }
                                  }
                                  $("#dvCSV").html('');
                                  $("#dvCSV").append(JSON.stringify(entities));
                              }
                              reader.readAsText($("#fileUpload")[0].files[0]);
                          } else {
                              alert("This browser does not support HTML5.");
                          }
                      } else {
                          alert("Please upload a valid CSV file.");
                      }
                  });
              });
          </script>
          <input type="file" id="fileUpload" />
          <input type="button" id="upload" value="Upload" />
          <hr />
          <div id="dvCSV">
          </div>
          
    

          </script>
      </form>
      </div>
  </body>
</html>
