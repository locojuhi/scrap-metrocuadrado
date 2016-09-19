<?php
    include './ConnectionDB.php';
    $lines = file('./example.txt');
    $data = new ConnectionDB();
    $added = array();
    $notadded = array();
    
    foreach($lines as $line){
        try {
            $db = $data->con;
            $sentencia = $db->prepare("Select url from properties");
            $sentencia->execute();
            $results =  $sentencia->fetchAll();
            foreach ($results as $result){
                if($result['url'] == trim ($line, "\t\n\r\0\x0B")){
                    if(!in_array(trim ($line, "\t\n\r\0\x0B"), $notadded, true)){
                        array_push($notadded, trim ($line, " \t\n\r\0\x0B"));
                    }else{
                    }
                }else{
                    if(!in_array(trim ($line, "\t\n\r\0\x0B"), $added, true)){
                        array_push($added, trim ($line, " \t\n\r\0\x0B"));
                    }else{       
                    }
                }
            } 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Scrapper</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <button onclick="return send()">Send</button>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="row center-block">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h1>Existente</h1>
                            <ul id="Outside" class="connectedSortable">
                                <?php
                                    foreach ($notadded as $notadd){
                                        echo "<li>".$notadd."</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h1>No registrado</h1>
                            <ul id="Inside" class="connectedSortable">
                                <?php
                                    foreach ($added as $add){
                                        echo "<li>".$add."</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2"></div>
            </div>
            <div id="results"></div>
        </div>
      

        <div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" data-backdrop='static' aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="progress">
                  <div id="progressbar"  class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                      <span id="progressbarspan" class="sr-only">45%</span>
                </div>
              </div>
                <button onclick="closeModal()" id="closeModal" style="display: none">Close</button>
            </div>
          </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $( function() {
          $( "#Inside, #Outside" ).sortable({
            connectWith: ".connectedSortable"
          }).disableSelection();
        });
        
        function send(){
            $('#myModal').modal({
                keyboard: false
            },'toggle');
            var total = $("#Inside li").length;
            var progress = 0;
            $('#Inside > li').each(function(){
                $.ajax({
                    method: "POST",
                    url: "./ScrapUrlTest.php",
                    data: { url: $(this).text()}
                }).done(function( msg ) {
                    $( "#results" ).append( msg );
                    console.log(msg);
                    var result = ((progress+1)*100)/total;
                    progressbarupdate(result);
                    progress = progress+1;
                });
            });
            
        }
        function progressbarupdate(number){
            $('#progressbar').attr( "aria-valuenow", number);
            $('#progressbar').attr( "style", "width: "+number+"%");
            $('#progressbarspan').text(number+"%");
            if(number < 100){
                $("#closeModal").attr( "style", "display: none;");
            }else{
                $("#closeModal").attr( "style", "display: true;");
            }
        }
        function closeModal(){
            $('#myModal').modal('hide');
        }
    </script>
      <style>
        #Inside, #Outside {
          border: 1px solid #eee;
          
          min-height: 200px;
          list-style-type: none;
          margin: 0;
          padding: 5px 0 0 0;
        }
        #Inside li, #Outside li {
          margin: 0 5px 5px 5px;
          padding: 5px;
          font-size: 1.2em;
        }
        #Outside li{
            background-color:#b92c28;
            color: white;
        }
        #Inside li{
            background-color: #d9edf7;
            
        }
        body{
            background-color: #737373;
        }
  </style>
</html>

