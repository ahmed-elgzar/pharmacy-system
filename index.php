<?php
    //============================
    //== Evergreen system v 2.0 ==
    //============================

    //===============
    //== Page name ==
    //===============
    $pageTitle = "الرئيسية";

    //-------------------------------------
    //-- Include database conaction file --
    //-------------------------------------
    include("config.php");
   
    //-------------------------------------
    //-- Define variables for the inputs -- 
    //-------------------------------------
    if(isset($_POST['save'])){
        $dname = $_POST['dname'];
        $exp    = $_POST['exp'] ."-01";
        $mu     = $_POST['much'];
        $addname = $_POST['save'];
    }
    if(isset($_GET['search'])){
     $search = $_GET['search'];
    }

    //------------------
    //-- Delete Query --
    //------------------
    
    if(isset($_GET['id'])){
        $del = $_GET['id'];
        $query = "DELETE FROM addpost WHERE id = $del";
        $delete = mysqli_query($con,$query);
        $suQ    = "DELETE FROM subs WHERE medID = $del";
        $subDelete = mysqli_query($con,$suQ);
    }

    //-----------------------------
    //-- Pagination limit script --
    //-----------------------------
    $limit = 10;  
    if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
        } 
        else{ 
        $page=1;
        };  
    $start_from = ($page-1) * $limit;

    //-------------------------
    //-- Include header file --
    //-------------------------
    include("includes/header.php");
?>
         <div class="container">
            <div calss="messages"> <!-- alerts -->
                <?php 
                    //------------------------------
                    //-- database data validation --
                    //------------------------------
                    if(isset($addname)){
                        if(empty($dname || $mu)){
                            echo "<div class='alert alert-danger' role='alert' id='alert'>
                            لايمكنك ترك هذه الحقول فارغة
                          </div>";
                        }else{
                            $query = "INSERT INTO addpost (name,exp,much) VALUES ('$dname','$exp',$mu)";
                
                            $res = mysqli_query($con,$query);
                
                            if(isset($res)){
                                echo "<div class='alert alert-success' role='alert' id='alert'>
                                        تم إضافة الدواء بنجاح
                                    </div>";
                            }else{
                                echo "<div class='alert alert-warning' role='alert' id='alert'>
                                        عفوا حدث خطأ ما!!
                                    </div>";
                            }
                        }
                    }
                    if(isset($del)){
                        echo "<div class='alert alert-danger' role='alert' id='alert'>
                        تم حذف الدواء
                        </div>";  
                    }
                ?>
            </div>
            <!-- Insert data form -->
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">اسم الدواء</label>
                        <input type="text" name="dname" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">تاريخ الانتهاء</label>
                        <input type="month" name="exp" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name">الكمية</label>
                        <input type="number" name="much" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" name="save" id="save">حفظ</button>
                </div>
            </form>
            <!-- display data from data base -->
            <div class="display">
            <table class="table table-hover">
                    <thead class="thead-dark">
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-capsules"></i></th>
                        <th scope="col"><i class="fas fa-calendar-alt"></i></th>
                        <th scope="col"><i class="fas fa-store-alt"></i></th>
                        <!-- <th scope="col"><i class="fas fa-store"></i></th>-->
                        <!-- <th scope="col"><i class="fas fa-store-slash"></i></th>-->
                       <!-- <th scope="col">تاريخ الاضافة</th> -->
                        <th scope="col"><i class="fas fa-minus-circle"></i></th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    </thead>
                    <?php

                        //-------------------------------------------------------------------------
                        //-- Query to fetch data from database and sort it with Pagination limit --
                        //-------------------------------------------------------------------------
                        $query = "SELECT * FROM addpost ORDER BY id DESC  LIMIT $start_from, $limit";
                        $result = mysqli_query($con,$query);
                        $no = 0;

                        //-------------------------------------------
                        //-- while loop to display database result --
                        //-------------------------------------------
                        while($row = mysqli_fetch_assoc($result)){
                            $no++;
                            $Id = $row['id'];
                            $q = "SELECT SUM(sub) AS total FROM subs WHERE medID = '$Id'";
                            $re = mysqli_query($con,$q);
                            
                            
                    ?>
                    <tr>
                            <th><?php echo $no; ?></th>
                            <td><a href="med.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a></td>
                            <?php $d = strtotime($row['exp']); ?>
                            <td><?php echo date("y-M",$d); ?></td>
                            <td><?php echo $row['much']; ?></td>
                            <?php //while($r = mysqli_fetch_assoc($re)){ ?>
                            <!-- <td><?php //echo $r['total']; ?></td>-->
                           <?php 
                                       // $m = $row['much'];
                                       // $s = $r['total'];
                                      //  $subt = $m-$s;
                            ?>
                            <!-- <td><?php //echo $subt; ?></td>-->
                            <?php// } ?>
                            <!-- <td><?php //echo $row['addDate']; ?></td> -->
                            <td><a href="sub.php?id=<?php echo $row['id'] ?>" class="fas fa-minus-circle"></a></td>
                            <td><a href="edit.php?id=<?php echo $row['id'] ?>" class="far fa-edit"></a></td>
                            <td><a href="index.php?id=<?php echo $row['id'] ?>" class="far fa-trash-alt"></a></td>
                    </tr>
                    <?php } ?>
                </table>
                <?php 
                    //-----------------------
                    //-- Pagination script --
                    //----------------------- 
                    $result_db = mysqli_query($con,"SELECT COUNT(id) FROM addpost"); 
                    $row_db = mysqli_fetch_row($result_db);  
                    $total_records = $row_db[0];  
                    $total_pages = ceil($total_records / $limit); 
                    /* echo  $total_pages; */
                    $pagLink = "<ul class='pagination'>";  
                    for ($i=1; $i<=$total_pages; $i++) {
                                $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a></li>";	
                    }
                    echo $pagLink . "</ul>";  
                ?>
            </div>
         </div>
<?php
    include("includes/footer.php");
?>