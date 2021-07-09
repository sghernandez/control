<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
            <?php flash('register_success'); ?>
                <h2 class="card-text">Registro Centro Comercial</h2>
            <p class="card-text">Por favor ingrese todos los campos</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Razón Social<sub>*</sub></label>
                        <input type="text" name="razonSocial" required class="form-control form-control-lg <?php echo (!empty($data['razonSocial_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['razonSocial'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['razonSocial_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="name">NIT<sub>*</sub></label>
                        <input type="text" name="nit" required class="form-control form-control-lg <?php echo (!empty($data['nit_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['nit'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['nit_err'] ;?> </span>
                    </div>                  

                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirme Password<sub>*</sub></label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['confirm_password'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ;?> </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-info btn-block pull-left" value="REGISTRARME">
                            </div>
                            <div class="col">
                                <a href="<?php echo URLROOT ;?>/ccomercial/login" class="btn btn-light btn-block pull-right">¿Ya se encuentra Registrado? Ir al Login </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>