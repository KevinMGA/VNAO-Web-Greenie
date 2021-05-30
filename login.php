<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/login.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="sidenav">
         <div class="login-main-text">
             <img src="assets/img/logoSTREAM.png" class="img-responsive" style="width:100%;">
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">   
            <div class="login-form">
                <h2 style="font-weight:700;">Login</h2>
               <form action="action.php?id=login" method="POST">
                   <?php
                   if(isset($_GET['login'])){
                       if ($_GET['login'] == 'wrong') {
                           echo '<p class="alert alert-danger">Wrong Creds. Please try again.</p>';
                       }
                   }
                   ?>
                  <div class="form-group">
                     <label>E-Mail</label>
                     <input type="text" class="form-control" name="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                  <!-- <button type="submit" class="btn btn-secondary">Register</button> -->
               </form>
            </div>
         </div>
      </div>