<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sửa bài viết</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Sửa bài viết</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <form action="index.php?controller=post&action=update&id=<?php echo $post->id ?>" method="post" enctype="multipart/form-data">
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
                  <img id="preview-img" style="max-width:300px;max-height:100px;display:block" src="uploads/post/<?php echo $post->image ?>">
                  <input name="img" class="img" type="file" id="img" class="form-control" onchange="loadFile(event)">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputStatus">Danh mục</label>
                  <select id="inputStatus" name="category_id" class="form-control custom-select">
                    <option selected="" disabled=""> chọn danh mục </option>
                    <?php foreach ($category as $cats) { 
                      if($cats->id == $post->category_id){?>
                      <option selected value="<?php echo $cats->id ?>"><?php echo $cats->name ?></option>
                        <?php }else{ ?>
                          <option value="<?php echo $cats->id ?>"><?php echo $cats->name ?></option>
                    <?php }} ?>



                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Tiêu đề</label>
              <input value="<?php echo $post->title ?>" name="title" type="text" id="title" class="form-control" onkeyup="ChangeToSlug('title','slug')">
            </div>
            <div class="form-group">
              <label for="inputName">Từ khoá</label>
              <input value="<?php echo $post->slug ?>" name="slug" type="text" id="slug" class="form-control" >
            </div>
            <div class="form-group">
              <label for="inputName">Mô tả</label>
              <input value="<?php echo $post->desc ?>" name="desc" type="text" id="desc" class="form-control">
            </div>
            
            <div class="form-group">
              <label for="inputName">Nội dung</label>
              <textarea name="content" type="text" id="content" class="form-control"><?php echo $post->content ?></textarea>
            </div>
            <?php if (isset($mess)) {
                  if ($mess === true) { ?>
                    <div class="col-md-10 mx-auto alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Bạn đã tạo danh mục thành công</strong>
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
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>
    <div class="row">
      <div class="col-12">
        <a href="#" class="btn btn-secondary">Cancel</a>
        <input  type="submit" value="Sửa bài viết" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<script>
  CKEDITOR.replace("content");
</script>
