<?php require_once 'inc/header.php'; ?>
 <?php
    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url .= "://" . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $base_url = str_replace('update/', '', $base_url);
  ?>
<div class="easy_form_content_area">
  <div class="container" >
    <div class="easy_step_wapper default" >
      <div class="row pt-50">
        <div class="col-sm-6 offset-sm-3">
          <div class="easy_step_content">
            <ul id="easy_step_progressbar">
                <li class="indicator active step"><p>Account Setup</p></li>
                <li class="indicator step"><p>Personal Details</p></li>
              </ul>
          </div>
        </div><!-- col -->
        <div class="col-sm-6 offset-sm-3">
          <div class="tab_area easy_step_tab">
            <div class="install_area text-center">
                <h3> Updater</h3>
                <p>Follow This instruction</p>
            </div>
             <form action="<?php echo htmlspecialchars('install.php');?>" method="post"  id="installForm" enctype="multipart/form-data">
              <div class="tab">
                <div class="easy_step_user_section">
                  <div class="single_top_user">
                      <div class="user_details_area">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Host</label>
                             <input type="text" name="hostname" id="dbhost" class="form-control" placeholder="Host name *" required="" value="localhost">
                           </div>
                         </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Username</label>
                            <input type="text" id="dbuser" name="username" class="form-control" placeholder="Enter Database UserName" required value="">
                           </div>
                         </div>

                         <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Password</label>
                            <input type="text" id="dbpass" name="password" class="form-control" placeholder="Enter Database Password" >
                           </div>
                         </div>

                         <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Database Name</label>
                            <input type="text" id="dbname" name="database" class="form-control" placeholder="Enter Database Name" required value="">    
                           </div>
                         </div>
                         <input type="hidden" id="base_url" name="base_url" placeholder="Base URL" value="<?php echo $base_url; ?>"> 
                        </div><!-- row -->
                      </div>
                  </div>
                </div>
              </div> <!-- 1st tab -->

              <!-- Form Second Step Start -->
              <div class="tab">
                <div class="easy_step_user_section">
                  <div class="single_top_user">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group easy_step_label">
                              <label for="email">Username <span class="error">*</span></label>
                              <input type="text" name="name" class="form-control" id="username" placeholder="Enter Username" required>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group easy_step_label">
                              <label for="email">Email <span class="error">*</span></label>
                              <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email" required >
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group easy_step_label">
                              <label for="password"></i>Password <span class="error">*</span></label>
                              <input type="password" name="pass" class="form-control" id="password" placeholder="Enter Password" required >
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div><!-- tab -->
              <!-- Form Second Step Start -->

              <div class="easy_step_footer_button">
                  <div class="install_area text-center" style="display: none;">
                     <i class="fa fa-spinner fa-spin"></i>
                      <p style="text-transform: capitalize;">please wait until the installation is Complete, Your system in Installing...</p>
                  </div>
                    <!-- Buttons Start -->
                    <div class="button_area">
                        <button type="button" class="btn btn-danger" id="prevBtn" onclick="nextPrev(-1)"> <i class="fa fa-angle-double-left"></i> Previous</button>

                        <button type="button" class="btn btn-info" id="nextBtn" class="nextbtn btn-success" onclick="nextPrev(1)">Next <i class="fa fa-angle-double-right"></i></button>

                        <button type="button" class="btn btn-success" class="btn-danger" id="form-submit">Submit</button>
                    </div>
                    <!-- Buttons End -->
                    
                    <!-- Error / success messege: -->
                    <div id="msgSubmit" class=" easy_error_msg h3 text-center"></div>
              </div><!-- easy_step_footer_button -->
            </form>
          </div><!-- easy step_tab -->
        </div>
      </div>
    </div><!--east_step_wapper  -->
  </div>
</div>
<?php require_once 'inc/footer.php'; ?>