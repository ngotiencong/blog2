<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Thêm bài viết</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Thêm bài viết</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <form action="index.php?controller=post&action=store" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Thông tin bài viết</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Thêm ảnh</label>
                  <img id="preview-img" style="max-width:300px;max-height:100px;display:block">
                  <input name="img" class="img" type="file" id="img" class="form-control" onchange="loadFile(event)">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputStatus">Danh mục</label>
                  <select id="inputStatus" name="category_id" class="form-control custom-select">
                    <option selected="" value="chon" disabled=""> chọn danh mục </option>
                    <?php foreach ($category as $cats) { ?>

                      <option value="<?php echo $cats->id ?>"><?php echo $cats->name ?></option>

                    <?php } ?>



                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Tiêu đề</label>
              <input name="title" type="text" id="title" class="form-control" onkeyup="ChangeToSlug('title','slug')">
            </div>
            <div class="form-group">
              <label for="inputName">Từ khoá</label>
              <input name="slug" type="text" id="slug" class="form-control">
            </div>
            <div class="form-group">
              <label for="inputName">Mô tả</label>
              <input name="desc" type="text" id="desc" class="form-control">
            </div>

            <div class="form-group">
              <label for="inputName">Nội dung</label>
              <textarea name="content" type="text" id="content" class="form-control"></textarea>
            </div>

            <?php if (isset($mess)) {
                  if ($mess === true) { ?>
                    <div class="col-md-10 mx-auto alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Bạn đã tạo bài viết thành công</strong>
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
        <input type="submit" value="Tạo bài viết" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<script>
  CKEDITOR.replace("content");
</script>