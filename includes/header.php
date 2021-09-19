<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='css/cairo.css' rel='stylesheet' type='text/css'> <!-- system font -->
        <link rel="stylesheet" href='css/all.css'> <!-- font awsome files -->
        <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- bootstarp -->
        <link rel="stylesheet" href="css/bootstrap-rtl.css">

        <title>Ever Green- <?php echo $pageTitle; ?></title>
        <style>
         body{
             font-family: cairo;
         }
         .display{
             padding-top: 50px;
         }
         .container{
             padding-top: 100px;
         }
         h1,.col-12{
             text-align: center;
             padding: 20px;
         }
		 footer{
             position: fixed;
             left: 0;
             bottom: 0;
             width: 100%;
             height: 30px;
             background: #e3e7ea;
             text-align: center;
             color: #007bff;
		 }
        </style>
    </head>
    <body>
		<!-- start nav bar -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="index.php">
                <img src="ever.png" width="60" height="60" class="d-inline-block" alt="">
                Ever Green
            </a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="إبحث عن دواء" aria-label="Search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="go"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </nav>
		<!-- end nav bar -->