
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Lista de archivos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hover Rows
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre archivos</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
                    $path = "../listar/bak";
                    $i = 1;
                    $directorio = opendir($path);
                    while ($archivo = readdir($directorio)){
                        if (!is_dir($archivo)){
                            echo "<tr>";
                            echo "<td>".$i++."</td>";
                            echo "<td><a href='".$path."/".$archivo."'>".$archivo."</a></td>";
                            echo "</tr> ";
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
