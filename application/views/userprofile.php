

<header>

</header>

<body style="background-color: #3E3E42;">
<!-- Begin header content -->
<header>
    <div class="clearfix" style="margin-top: 20px;"></div>
</header>
<!-- Begin page content -->
<main role="main" class="container">
  <div class="row">
    <div class="well">
      <table class="table table-bordered table-striped">
        <tr><th colspan="2"><h4 class="text-center">User Info</h3></th></tr>
        <tr><td>Name</td><td><?php echo $this->session->userdata('name'); ?></td></tr>
        <tr><td>User Email</td><td><?php echo $this->session->userdata('email');  ?></td></tr>
        <tr><td>Last Name</td><td><?php echo $this->session->userdata('lastname');  ?></td></tr>
        <tr><td>Username</td><td><?php echo $this->session->userdata('username');  ?></td></tr>
      </table>
    </div>
  </div>
</div>
</main>
<!-- End page content -->
