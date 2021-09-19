<?php
    //============================
    //== Evergreen system v 2.0 ==
    //============================

    //===============
    //== Page name ==
    //===============
    $pageTitle = "بيانات دواء";

    //-------------------------------------
    //-- Include database conaction file --
    //-------------------------------------
    include("config.php");

    //------------------------------------------------------------------
    //-- define a varible for the id to featch the data from database --
    //------------------------------------------------------------------
    $id = $_GET['id'];

    //------------------
    //-- Delete Query --
    //------------------
    if(isset($del)){
        $query = "DELETE FROM sub WHERE med = $id";
        $delete = mysqli_query($con,$query);
    }

    //--------------------------------------------------
    //-- Query to fetch the sum of data form database --
    //--------------------------------------------------
    $query = "SELECT SUM(sub) AS total FROM subs WHERE medID = $id";

    //--------------------------------------------------------
    //-- Query that return all data form database by the id --
    //--------------------------------------------------------
    $qu = "SELECT * FROM addpost WHERE id = $id";

    $res = mysqli_query($con,$query);
    $result = mysqli_query($con,$qu);

    $data = mysqli_fetch_assoc($res);
    $da   = mysqli_fetch_assoc($result);

    $m = $da['much'];
    $s = $data['total'];
    $subt= $m-$s;
    $d = strtotime($da['exp']);

    //-------------------------
    //-- Include header file --
    //-------------------------
    include("includes/header.php");
?>
         <div class="container">
            <h1>"<?php echo $da['name']; ?>"</h1>
            <div class="row">
                <div class="col">
                    الكمية الاساسية : <?php echo $da['much']; ?>
                </div>
                <div class="col">
                    الكمية المستهلكة : <?php echo $data['total']; ?>
                </div>
                <div class="col">
                    الكمية المتبقية : <?php echo $subt; ?>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
                تارخ انتهاء الصلاحية: <?php echo date("Y-F",$d); ?>
            </div>
         </div>
         <?php
            $query = "SELECT * FROM subs WHERE medID = $id";
            $result = mysqli_query($con,$query);
            $resp = mysqli_fetch_assoc($result);

            if($resp == null){
                echo "<div class='alert alert-primary' role='alert'>
                لم يتم السحب من هذا الدواء اي كميات بعد!!
              </div>";  
            }else{
        ?>
        <div class="display">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th scope="col">م</th>
                        <th scope="col">اسم الدواء</th>
                        <th scope="col">إسم الدكتور</th>
                        <th scope="col">السحب</th>
                        <th scope="col">تاريخ السحب</th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    </thead>
                    <?php
                        $query = " SELECT * FROM subs WHERE medID = $id ORDER BY id DESC";
                        $result = mysqli_query($con,$query);
                        $no = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                            $no++;
                            
                    ?>
                    <tr>
                            <th><?php echo $no; ?></th>
                            <td><?php echo $row['medName']; ?></a></td>
                            <td><a href="dr.php?dr=<?php echo $row['DrName']; ?>"><?php echo $row['DrName']; ?></a></td>
                            <td><?php echo $row['sub']; ?></td>
                            <td><?php echo $row['subDate']; ?></td>
                            <td><a href="edit.php?id=<?php echo $row['medID']; ?>" class="far fa-edit"></a></td>
                            <td><a href="med.php?id=<?php echo $row['id']; ?>" class="far fa-trash-alt"></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        <?php  }
            //-------------------------
            //-- Include footer file --
            //-------------------------
            include("includes/footer.php");
        ?>
