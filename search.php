<?php
    //============================
    //== Evergreen system v 2.0 ==
    //============================

    //===============
    //== Page name ==
    //===============
    $pageTitle = "نتائج البحث";

    //-------------------------------------
    //-- Include database conaction file --
    //-------------------------------------

    include ("config.php");


    //--------------------------
    //-- define search method --
    //--------------------------
    $search = $_GET['search'];



    //-------------------------
    //-- include header file --
    //-------------------------
    include("includes/header.php");

?>
    <!-- display search results in a table -->
        <div class="container">
        <div class="display">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-capsules"></i></th>
                        <th scope="col"><i class="fas fa-calendar-alt"></i></th>
                        <th scope="col"><i class="fas fa-store-alt"></i></th>
                        <th scope="col"><i class="fas fa-store"></i></th>
                        <th scope="col"><i class="fas fa-store-slash"></i></th>
                       <!-- <th scope="col">تاريخ الاضافة</th> -->
                        <th scope="col"><i class="fas fa-minus-circle"></i></th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    </thead>
                    <?php
                        //-------------------------
                        //-- search result query --
                        //-------------------------
                        $query = "SElECT * FROM addpost WHERE name LIKE '%$search%'  LIMIT 5";
                        $result = mysqli_query($con,$query);
                        $no = 0;
                        
                        //----------------------------------------------
                        //-- while loop to display all search results --
                        //----------------------------------------------
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
                            <td><?php echo date("Y-F",$d); ?></td>
                            <td><?php echo $row['much']; ?></td>
                            <?php while($r = mysqli_fetch_assoc($re)){ ?>
                            <td><?php echo $r['total']; ?></td>
                            <?php 
                                        $m = $row['much'];
                                        $s = $r['total'];
                                        $subt = $m-$s;
                            ?>
                            <td><?php echo $subt; ?></td>
                            <?php } ?>
                            <td><a href="sub.php?id=<?php echo $row['id'] ?>" class="fas fa-minus-circle"></a></td>
                            <td><a href="edit.php?id=<?php echo $row['id'] ?>" class="far fa-edit"></a></td>
                            <td><a href="index.php?id=<?php echo $row['id'] ?>" class="far fa-trash-alt"></a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
<?php
    //-------------------------
    //-- include footer file --
    //-------------------------
    include("includes/footer.php");
?>