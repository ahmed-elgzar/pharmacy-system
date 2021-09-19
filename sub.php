<?php
    //============================
    //== Evergreen system v 2.0 ==
    //============================

    //===============
    //== Page name ==
    //===============
    $pageTitle = "سحب";

    //-------------------------------------
    //-- Include database conaction file --
    //-------------------------------------
    include("config.php");

    //-------------------------------
    //-- A var for the subtract id --
    //-------------------------------
    $id = $_GET['id'];

    //------------------------------------------------------------------
    //-- Query fetch the medcine data the we need to subtract form it --
    //------------------------------------------------------------------
    $query = "SELECT name FROM addpost WHERE id=$id";

    $res = mysqli_query($con,$query);

    $data = mysqli_fetch_array($res);

    //---------------------------------
    //-- Query to fetch the drs name --
    //---------------------------------
    $que = "SELECT drName FROM drs";
    $re  = mysqli_query($con,$que);

    //------------------------
    //-- script to subtract --
    //------------------------
    if(isset($_POST['edit'])){
        $name= $_POST['medname'];
        $dr = $_POST['drName'];
        $sub= $_POST['sub'];
        $date = $_POST['medDate'];

        $edit = "INSERT INTO subs (medID,medName,DrName,sub,subDate) VALUES ('$id','$name','$dr','$sub','$date')";

        $res = mysqli_query($con,$edit);

        if($res){
            mysqli_close($con);
            header("location:index.php");
            exit;
        }else{
            echo mysqli_error();
        }
    }
    //-------------------
    //-- iclude header file --
    //------------------------
    include("includes/header.php");

?>
         <div class="container">

        <h3>سحب دواء</h3>

            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">اسم الدواء</label>
                        <input type="text" name="medname" class="form-control" value="<?php echo $data['name']; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">تاريخ السحب</label>
                        <input type="date" name="medDate" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">إسم الدكتور</label>
                        <select class="custom-select" id="inputGroupSelect01" name="drName">
                            <option selected>اسم الدكتور...</option>
                            <?php while($row = mysqli_fetch_assoc($re)){ ?>
                                <option><?php echo $row['drName']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name">الكميةالمسحوبة</label>
                        <input type="number" name="sub" class="form-control">
                    </div>
                        <button class="btn btn-primary btn-lg btn-block" name="edit">تعديل</button>
                    </div>
                </form>
        </div>
<?php
    //-------------------------
    //-- include footer file --
    //-------------------------
    include("includes/footer.php");
        