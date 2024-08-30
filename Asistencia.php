<!DOCTYPE html>
<html>

<head>
    <title>Asistencias de alumnos</title>
    <meta charset="utf-8">
</head>

<body>
    <style>
        body{
            font-family: Verdana;
            text-align: center;
        }
        legend{
            font-size: 50px;
            text-align: center;
        }
        fieldset{
            display: inline-block;
            margin: 0 auto;
            
        }
        table,
        th,
        td,
        thead {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            margin: 0 auto;
        }
        thead{
            background-color: lightgray;
        }
        td{
            text-align: center;
        }
        button{
            padding-left: 10px;
        }
    </style>
    <form method="post" action="./php/GenerarArchivo.php">
        <fieldset>
            <legend>Sistema de Asistencia</legend><br>
            <h2>Listado de Alumnos</h2>
            <label>Fecha</label>
            <input type="date" name="fecha" required><br><br>
            <table>
                <thead>
                    <tr>
                        <th>Número de Legajo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $RutaArchivo = "./archivos/alumnos.txt";
                    if (file_exists($RutaArchivo) == false)
                        throw new Exception("Error al abrir el archivo $RutaNombre.");
                    $pf = fopen($RutaArchivo, "r");
                    $i = 0;

                    while (!feof($pf)) {
                        $linea = fgets($pf);
                        $linea = trim($linea);
                        echo "";
                        $separada = explode(",", $linea);
                        if (!empty($linea)) {
                            echo "<tr> 
                                    <td name='legajo' style='text-align: center;'>$separada[0]</td> 
                                    <td>$separada[1]</td> <td>$separada[2]</td> 
                                    <td>
                                        <input type='hidden' name='legajo[]' value='$separada[0]'/>
                                        <input type='checkbox' name='chk$i' value=1 />
                                    </td>
                                </tr>";
                        }
                        $i++;
                    }
                    fclose($pf)
                    ?>
                </tbody>
            </table><br>
            <input type="submit" class="button" value="Enviar">
            <input type="reset" class="button" value="Cancelar">
        </fieldset>
    </form>
</body>

</html>