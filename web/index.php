 
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
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>
<div class="wrapper">
    <h1>Registros</h1>
    <table class="table table-striped table-hover table-bordered" id="dataT">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
            <th scope="col">Nacionalidad</th>
        </tr>
        </thead>
        <tbody>

        <?php
            $json = file_get_contents('http://api-service/api/getData');
            $obj = json_decode($json);
            
            $iter = 0;

            if($obj)
            {
                foreach ($obj as $item){
                    $iter = $iter + 1;
                    echo "<tr>";
                        echo "<td>{$iter}</td>";
                        echo "<td>{$item->name}</td>";
                        echo "<td>{$item->email}</td>";
                        echo "<td>{$item->phone}</td>";
                        echo "<td>{$item->address}</td>";
                        echo "<td>{$item->nacionality}</td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr>";
                        echo "<td>1</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                    echo "</tr>";
            }               
        ?>
        </tbody>
    </table>
    <br><br>

    <div class="d-grid gap-2 col-6 mx-auto">        
        <a class="btn btn-primary" role="button" href="admin.php">Admin</a>        
    </div>
</div>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous">
</script>

<script>

    $.extend( true, $.fn.dataTable.defaults, {
        "searching": false,
        "ordering": false
    } );

    $(document).ready(function() {
        $('#dataT').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            "lengthMenu": [[5, 10, 30, -1], [5, 10, 30, "All"]]
        });
    } );
</script>

</body>
</html>