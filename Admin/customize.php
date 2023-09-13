<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Website settings</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Website settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Website settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#add_users"><i class="fa-sharp fa-solid fa-square-plus"></i> New settings</button>

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool text-light" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>LOGO</th>
                    <th>BRAND NAME</th>
                    <th>ABOUT</th>
                    <th>MISSION</th>
                    <th>VISION</th>
                    <th>CONTACT/EMAIL</th>
                    <th>SETTING STATUS</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM customization");
                        if(mysqli_num_rows($sql) > 0 ) {
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                    <tr>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#viewphoto<?php echo $row['customID']; ?>">
                              <img src="../images-customization/<?php echo $row['logo']; ?>" alt="" width="40" class="img-circle d-block m-auto">
                            </a>
                              <br>
                              <?php if($row['logoStatus'] == 0): ?>
                                <span class="badge badge-warning pt-1" type="button" data-toggle="modal" data-target="#active<?php echo $row['customID']; ?>">Set as Active</span>
                              <?php else: ?>
                                <span class="badge badge-success pt-1">Active</span>
                              <?php endif; ?>
                            

                        </td>
                        <td><?php echo $row['brandName']; ?></td>
                        <td><?php echo custom_echo($row['about'], 25); ?></td>
                        <td><?php echo custom_echo($row['mission'], 25); ?></td>
                        <td><?php echo custom_echo($row['vision'], 25); ?></td>
                        <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if(!empty($row['contact'])) { echo '+63 '.$row['contact']; } ?></span></td>
                        <td class="text-center">
                          <?php if($row['status'] == 0): ?>
                            <span class="badge badge-warning pt-1" type="button" data-toggle="modal" data-target="#activeSettings<?php echo $row['customID']; ?>">Set as Active</span>
                          <?php else: ?>
                            <span class="badge badge-success pt-1">Active</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <button type="button" class="btn bg-primary btn-xs" data-toggle="modal" data-target="#view<?php echo $row['customID']; ?>"><i class="fas fa-folder"></i></button>
                          <button type="button" class="btn bg-info btn-xs" data-toggle="modal" data-target="#update<?php echo $row['customID']; ?>"><i class="fas fa-pencil-alt"></i></button>
                          <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['customID']; ?>"><i class="fas fa-trash"></i></button>
                        </td> 
                    </tr>

                    <?php include 'customize_update_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No record found</td>
                      </tr>
                    <?php }?>

                  </tbody>
                </table>

              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include 'customize_add.php'; ?>
<?php include 'footer.php'; ?>
