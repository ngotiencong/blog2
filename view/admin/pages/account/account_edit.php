    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm tài khoản</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm tài khoản</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="index.php?controller=account&action=update&id=<?php echo $account->id; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thông tin tài khoản</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">

                <div class="form-group">
                  <label for="inputName">Tên đăng nhập</label>
                  <input value="<?php echo $account->user ?>" name="user" type="text" id="user" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Mật khẩu cũ</label>
                  <input  value="" name="pass_current" type="password" id="pass" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputName">Mật khẩu mới</label>
                  <input  value="" name="pass" type="password" id="pass" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputStatus">Vai trò</label>
                  <select id="inputStatus" name="role" class="form-control custom-select">
                    <?php if($account->role == 0){ ?>
                    <option selected="" value="0">ADMIN</option>
                    <option  value="1" >Author</option>
                    <?php } else if($account->role == 1){ ?>
                    <option  value="0" >ADMIN</option>
                    <option selected="" value="1" >Author</option>
                    <?php }?>
                  </select>
                </div>

                <?php if (isset($mess)) {
                  if ($mess === true) { ?>
                    <div class="col-md-10 mx-auto alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Bạn đã sửa tài khoản thành công</strong>
                    </div>
                    <?php } else {
                    foreach ($mess as $mess) { ?>
                      <div class="col-md-10 mx-auto alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong><?php echo $mess ?></strong>
                      </div>
                <?php }
                  }
                } ?>
                <!-- <div class="alert alert-danger">
                    <ul>
                       <li>Có lỗi x</li>
                    </ul>
                </div> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <div class="row">
          <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="sửa tài khoản" class="btn btn-success float-right">
          </div>
        </div>
      </form>
    </section>