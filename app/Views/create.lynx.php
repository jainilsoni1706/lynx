<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"rel="stylesheet"/>
    <title><?=$moduleName?></title>
</head>
<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="https://mdbgo.com/">
        <h4><?=$moduleName?></h4>
    </a>

    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
      
        <button type="button" class="btn btn-primary me-3">
          <?=$date?>
        </button>
        <a
          class="btn btn-dark px-3"
          href="https://github.com/mdbootstrap/mdb-ui-kit"
          role="button"
          ><i class="fab fa-github"></i
        ></a>
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->





<div class="container">
    <a href="<?=url('')?>"> 
        <button type="button" class="btn btn-primary me-3" style="margin-top:100px;">
          Home 
        </button>
    </a>

    <form action="<?=url('store')?>" method="POST">  <?=csrf_token()?>
    <div class="row g-3" style="margin-top:30px;">
        <div class="col-sm-7">
            <div class="form-outline">
            <input type="text" id="form10Example1" class="form-control" name="name" />
            <label class="form-label" for="form10Example1">Name</label>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-outline">
            <input type="text" id="form10Example2" class="form-control" name="email" />
            <label class="form-label" for="form10Example2">Email</label>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-outline">
            <input type="text" id="form10Example3" class="form-control" name="password" />
            <label class="form-label" for="form10Example3">Password</label>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-outline">
                <input type="submit" class="btn btn-primary"/>
            </div>
        </div>
    </div>
    </form>

  </div>


<script src="https://jsplayground.syncfusion.com/kfoadv3z?_gl=1*euyhvm*_ga*MTQwMjI4ODU3MS4xNjc3Nzc4NDg0*_ga_WC4JKKPHH0*MTY3Nzc3ODQ4My4xLjAuMTY3Nzc3ODQ4My42MC4wLjA.&_ga=2.154794872.1737323724.1677778484-1402288571.1677778484"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>
</html>