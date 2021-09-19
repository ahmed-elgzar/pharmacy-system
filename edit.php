<?php
    //============================
    //== Evergreen system v 2.0 ==
    //============================

    //===============
    //== Page name ==
    //===============
    $pageTitle = "تعديل دواء";

    //-------------------------------------
    //-- Include database conaction file --
    //-------------------------------------
    include("config.php");

    //-------------------------------------------------------------
    //-- define a var for the id of medicne that we need to edit --
    //------------------------------------------------------------- 
    $id = $_GET['id'];

    //-----------------------------------------------
    //-- Query to fetch all data about the medcine --
    //-----------------------------------------------
    $query = "SELECT * FROM addpost WHERE id=$id";

    $res = mysqli_query($con,$query);

    $data = mysqli_fetch_array($res);

    //----------------------
    //-- The update Query --
    //----------------------
    if(isset($_POST['edit'])){
        $name= $_POST['dname'];
        $exp = $_POST['exp'];
        $much= $_POST['much'];

        $edit = "UPDATE addpost SET name = '$name', exp = '$exp', much = '$much' WHERE id = $id";

        $res = mysqli_query($con,$edit);

        if($res){
            mysqli_close($con);
            header("location:index.php");
            exit;
        }else{
            echo mysqli_error();
        }
    }
    //-------------------------
    //-- include header file --
    //-------------------------
    include("includes/header.php");

?>
         <div class="container">

        <h3>تعديل الدواء</h3>

            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">اسم الدواء</label>
                        <input type="text" name="dname" class="form-control" value="<?php echo $data['name']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تاريخ الانتهاء</label>
                        <input type="date" name="exp" class="form-control" value="<?php echo $data['exp']; ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name">الكمية</label>
                        <input type="number" name="much" class="form-control" value="<?php echo $data['much']; ?>">
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
?>
        