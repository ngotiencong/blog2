    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Projects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Danh sách danh mục</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Danh sách danh mục</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10%">
                  STT
                </th>
                <th style="width: 25%">
                  Tên danh mục
                </th>
                <th style="width: 25%">
                  từ khóa
                </th>

                <th style="width: 15%">

                </th>
              </tr>
            </thead>
            <tbody>



              <?php $i = 1; foreach ($category as $item) { ?>


                <tr>
                  <td>
                  <?php echo  $i++ + (($page-1)*5) ?>
                  </td>
                  <td>

                    <?php echo  $item->name ?>


                  </td>
                  <td>
                    <?php echo  $item->slug ?>
                  </td>
                  <td class="project-actions text-right">
                    <form action="index.php?controller=category&action=destroy&id=<?php echo $item->id ?>" method="POST">
                      <a class="btn btn-info btn-sm" href="index.php?controller=category&action=edit&id=<?php echo $item->id ?>">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Sửa
                      </a>


                      <button type="submit" Class="btn btn-danger btn-sm">
                        <i class="fas fa-trash">
                        </i>
                        Xóa
                      </button>
                    </form>


                  </td>
                </tr>

              <?php } ?>
            </tbody>

          </table>
          <?php
          $next = $page + 1;
          $prev = $page - 1;
          ?>
          <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
              <li class="page-item <?php if ($page <= 1) {
                                      echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($page <= 1) {
                                              echo '#';
                                            } else {
                                              echo "index.php?controller=category&page=" . $prev;
                                            } ?>">Previous</a>
              </li>
              <?php for ($i = 1; $i <= $total; $i++) : ?>
                <li class="page-item <?php if ($page == $i) {
                                        echo 'active';
                                      } ?>">
                  <a class="page-link" href="index.php?controller=category&page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
              <?php endfor; ?>
              <li class="page-item <?php if ($page >= $total) {
                                      echo 'disabled';
                                    } ?>">
                <a class="page-link" href="<?php if ($page >= $total) {
                                              echo '#';
                                            } else {
                                              echo "index.php?controller=category&page=" . $next;
                                            } ?>">Next</a>
              </li>
            </ul>
          </nav>
        </div>

        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->