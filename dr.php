<?php
    //============================
    //== Evergreen system v 2.0 ==
    //============================

    //===============
    //== Page name ==
    //===============
    $pageTitle = "بيانات الطبيب";

    //-------------------------------------
    //-- Include database conaction file --
    //-------------------------------------
    include("config.php");

    //------------------------------------------------------------------------
    //-- a varible for the doctor name that we need to display his/her data --
    //------------------------------------------------------------------------
    $dr = $_GET['dr'];

    //---------------------------------------------------------------
    //-- Query to fetch sum of the medcine that the doctor used it --
    //---------------------------------------------------------------
    $query = "SELECT SUM(sub) AS total FROM subs WHERE DrName = '$dr'";

    $res = mysqli_query($con,$query);


    $data = mysqli_fetch_array($res);

    //------------------------
    //-- iclude header file --
    //------------------------
    include("includes/header.php");
  
?>
         <div class="container">
            <h1>"<?php echo $dr; ?>"</h1>
            <div class="row">
            <div class="col-12">
                عدد الادوية المسحوبة: <?php echo $data['total']; ?>
            </div>
         </div>
         <?php
            $query = "SELECT * FROM subs WHERE DrName = '$dr'";
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
                    </thead>
                    <?php
                        $query = " SELECT * FROM subs WHERE DrName = '$dr' ORDER BY id DESC";
                        $result = mysqli_query($con,$query);
                        $no = 0;
                        
                        while($row = mysqli_fetch_assoc($result)){
                            $no++;
                            
                    ?>
                    <tr>
                            <th><?php echo $no; ?></th>
                            <td><?php echo $row['medName']; ?></a></td>
                            <td><?php echo $row['DrName']; ?></td>
                            <td><?php echo $row['sub']; ?></td>
                            <td><?php echo $row['subDate']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        <?php  }
            //------------------------
            //-- iclude footer file --
            //------------------------
            include("includes/footer.php");
        ?>