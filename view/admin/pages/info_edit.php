    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm danh mục</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm danh mục</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
         <form action="index.php?controller=info&action=store" method="post" enctype="multipart/form-data" >
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thông tin Website</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
               
              <div class="form-group">
                <label for="inputName">Email</label>
                <input value="<?php echo $info->email ; ?>" name="email" type="text" id="email" class="form-control" >
              </div>
               <div class="form-group">
                <label for="inputName">Số điện thoại</label>
                <input value="<?php echo $info->phone ; ?>" name="phone" type="text" id="phone" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Địa chỉ</label>
                <input value="<?php echo $info->adress ; ?>" name="adress" type="text" id="adress" class="form-control" >
              </div>
               <div class="form-group">
                <label for="inputName">Dịch vụ 1</label>
                <input value="<?php echo $info->service1 ; ?>" name="service1" type="text" id="service1" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Dịch vụ 2</label>
                <input value="<?php echo $info->service2 ; ?>" name="service2" type="text" id="service2" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Dịch vụ 3</label>
                <input value="<?php echo $info->service3 ; ?>" name="service3" type="text" id="service3" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Dịch vụ 4</label>
                <input value="<?php echo $info->service4 ; ?>" name="service4" type="text" id="service4" class="form-control">
              </div>
             
             <?php if(isset($mess)){if($mess){ ?>
              <div class="col-md-10 mx-auto alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>Bạn đã sửa thông tin thành công</strong>
              </div>
              <?php }else { ?>
                <div class="col-md-10 mx-auto alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>Có lỗi xảy ra vui lòng thử lại sau</strong>
              </div>
                <?php } }?>
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
          <input type="submit" value="Sửa thông tin" class="btn btn-success float-right">
        </div>
      </div>
    </form>
    </section>