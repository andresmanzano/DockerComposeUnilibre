<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taller 3 - Electiva </title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous">
    <style>
        .wrapper {
            margin: 1em auto;
            width: 95%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

</head>
<body>
<div class="wrapper">
    <h1>Administración</h1>
    
    <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-warning" onclick="addData();" type="button">Agregar Registros</button>
        <button class="btn btn-danger"  onclick="delData();" type="button">Eliminar Registros</button>
        <a class="btn btn-primary" role="button" href="index.php">Regresar</a> 
    </div>

    <?php
    require_once 'vendor/autoload.php';
   
    $faker = Faker\Factory::create();
   

    $data = [];
    $replace = ['"',"'"];
    for ($i=0; $i < 13; $i++) { 
        $data[] = [
            'name' => preg_replace("/[\r\n|\n|\r]+/", "",  str_replace($replace, "", $faker->name())),
            'email' =>  preg_replace("/[\r\n|\n|\r]+/", "", str_replace($replace, "", $faker->email())),
            'phone' => preg_replace("/[\r\n|\n|\r]+/", "", str_replace($replace, "", $faker->numerify())),
            'address' => preg_replace("/[\r\n|\n|\r]+/", "", str_replace($replace, "", $faker->address())),
            'nacionality' =>  preg_replace("/[\r\n|\n|\r]+/", "", str_replace($replace, "", $faker->company()))
        ];        
    }

    $data = json_encode($data);
    ?>
</div>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous">
</script>

<script type="text/javascript">
    function delData(){
        
        console.log("eliminando datos");
        var Wurl = 'http://' + window.location.hostname + ':5001/api/deleteData';
        
        $.ajax({                     
            type: 'POST',
            url:  Wurl,                     
            data: JSON.stringify({
                'dropU':1
            }),
            dataType : "text",     
            contentType: "application/json",
            success: function(data) {
                alert(data);
            },
            error: function(error){
                
                alert(JSON.stringify(error));
            }
        });
        
    }

    function addData(){

        console.log("agregando datos");
        var Wurl = 'http://' + window.location.hostname + ':5001/api/addData';

        $.ajax({
            type: 'POST',
            url: Wurl,                      
            data: JSON.stringify({
                'inseU':1,
                'idata': '<?php echo $data; ?>'
            }),
            dataType : "text",     
            contentType: "application/json",            
            success: function(result) {
                alert(result);
            },
            error: function(error){
                
                alert(JSON.stringify(error));
            }
        });
    }
</script>
</body>
</html> 
