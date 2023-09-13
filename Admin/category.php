<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Category records</title>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <button type="button" class="btn bg-primary btn-sm ml-2" data-toggle="modal" data-target="#add_user"><i class="fa-sharp fa-solid fa-square-plus"></i> New category</button>

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr>
                    <!-- <th>#</th> -->
                    <th>CATEGORY NAME</th>
                    <th>DATE ADDED</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM category");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                      <tr>
                        <!-- <td><?php echo $i++; ?></td> -->
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo date("F d, Y", strtotime($row['date_added'])); ?></td>
                        <td>
                            <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['cat_id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                            <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['cat_id']; ?>"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </td> 
                    </tr>
                    <?php include 'category_update_delete.php'; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <?php include 'category_add.php';  ?>
 <?php include 'footer.php'; ?>

