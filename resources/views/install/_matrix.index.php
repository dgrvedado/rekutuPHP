        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="card">
                    <div class="card-body wizard-content">
                        <h4 class="card-title">Instalación de rekutuPHP</h4>
                        <h6 class="card-subtitle">Se recomienda de forma especial realizar un backup de su servidor de Bases de Datos. Todos los datos serán seteados del archivo "<i>env.php</i>"</h6>
                        <form id="example-form" action="<?=BASE_URL?>/install/install" method="POST">
                            <div class="card">
                                <div class="card-title alert-info"><h3>Instalación rekutuPHP</h3></div>
                                <section>
                                    <label for="dataBase">Base de Datos </label>
                                    <input id="dataBase" type="text" class="form-control" value="<?=DB_DATABASE?>" readonly>
                                    <label for="dataUser">Usuario</label>
                                    <input id="dataUser" type="text" class="form-control" value="<?=DB_USERNAME?>" readonly>
                                    <label for="dataPass">Password</label>
                                    <input id="dataPass" type="text" class=" form-control" value="<?=DB_PASSWD?>" readonly>
                                </section>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success"> Instalar</button>
                        </form>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->