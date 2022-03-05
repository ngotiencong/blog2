

    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập vào tài khoản quản trị</p>

                <form action="index.php?controller=admin&action=login" method="post">
        
                    <div class="input-group mb-3">
                        <input type="text" name='user' class="form-control" placeholder="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="pass" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                           
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                
            </div>
            <?php if (isset($mess)) {
                    foreach ($mess as $mess) { ?>
                      <div class="col-md-10 mx-auto alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $mess ?></strong>
                      </div>
                <?php }
                  }
                 ?>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

