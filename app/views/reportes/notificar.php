<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h3 class="card-text">Notificar Ciudadanos covid positivo</h3>
                <p class="card-text">Por favor cargue alguna de las sgtes extensiones: <?php echo '.'. implode(', .', $data['extensionsAllowed']) ?></p>
            </div>
        
            <div class="card-body">
                <form method="post" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email">Archivo<sub>*</sub></label>
                        <input type="file" name="excel" accept="<?php echo '.'. implode(', .', $data['extensionsAllowed']) ?>>" class="form-control-file" />                        
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-info btn-block pull-left" value="CARGAR ARCHIVO">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>