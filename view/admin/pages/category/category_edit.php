    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa danh mục</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa danh mục</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
         <form action="index.php?controller=category&action=update&id=<?php echo $category->id ?>" method="post" enctype="multipart/form-data" >
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thông tin danh mục</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
               
              <div class="form-group">
                <label for="inputName">Tên danh mục</label>
                <input value="<?php echo $category->name ?>" name="name" type="text" id="name" class="form-control" onkeyup="ChangeToSlug('name','slug')">
              </div>
               <div class="form-group">
                <label for="inputName">Từ khóa</label>
                <input value="<?php echo $category->slug ?>" name="slug" type="text" id="slug" class="form-control">
              </div>
             
              <?php if (isset($mess)) {
                  if ($mess === true) { ?>
                    <div class="col-md-10 mx-auto alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Bạn đã sửa danh mục thành công</strong>
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
          <input type="submit" value="Sửa danh mục" class="btn btn-success float-right">
        </div>
      </div>
    </form>
    </section>