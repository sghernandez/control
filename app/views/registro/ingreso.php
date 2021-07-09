<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h2 class="card-text">Registrar Ingreso</h2>
            <p class="card-text">Por favor ingrese el No. de Documento</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">No. Documento<sub>*</sub></label>
                        <input type="number" name="documento" required autocomplete="off" class="form-control form-control-lg <?php echo (!empty($data['documento_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['documento'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['documento_err'] ;?> </span>
                    </div>    

                    <?php if(! empty($data['nuevo_registro'])): ?>
                        <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <button name="nuevo" value="1" class="btn btn-danger btn-block pull-left">REGISTRAR CIUDADANO</button>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>             

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-info btn-block pull-left" value="REGISTRAR INGRESO">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>