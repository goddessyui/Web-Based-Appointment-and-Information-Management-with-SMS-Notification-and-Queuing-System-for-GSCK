<?php
include("../../dbconfig.php");
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div>
    
    <?php
    
    $name = explode(", ", $_POST['search']);
    $search2 = $name[0];
    $search = end($name);


    $sql="SELECT *
    FROM tbl_unifast_grantee WHERE last_name = '$search2' AND first_name LIKE '$search'";
    $run= mysqli_query($db, $sql);
    
    if($run==TRUE) {
        $foundnum = mysqli_num_rows($run);
        if($foundnum > 0) {$i=0;
             
    ?>
                
    <?php
            while($rows = mysqli_fetch_assoc($run)) { 
                
    ?>               
                    <div  class="list_group_container">    
                        
                        <form action="Staff/accounting_staff/updatedelete_unifastgrantee.php" method="post">
                            
                            
                                <div class="form_list">
                                    <p>Search Result</p>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $rows["last_name"]?>">               
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $rows["first_name"]?>">
                                    <input type="text" class="form-control" id="studentid" name="studentid" value="<?php echo $rows["student_id"]?>">
                                    <select name="batchstatus" class="form-control" id="batchstatus" >
                                        <?php $batch_status = $rows["batch_status"];
                                        if($batch_status=='old'){?>
                                            <option value="old">old</option>
                                            <option value="new">new</option>
                                            <?php 
                                        }
                                        else {?>
                                            <option value="new">new</option>
                                            <option value="old">old</option>
                                        <?php         
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="btn_group" role="group" aria-label="Basic example">
                                    <button class="btn_update" type="submit" name="update">UPDATE</button>
                                    <button class="btn_delete" type="submit" name="delete">DELETE</button>
                                </div> 
                        </form>
                    </div>            
    <?php     
            }
            ?>
            
            <?php
        }
        else {
            echo "<h5 style='color:red;'>There is no student named \"". $_POST['search'] . "\" on the list of unifast grantees.</h5>";
            ?>    
            <?php
        }
    }
    else {
        echo "<h5 style='color:red;'>There are no students in the list of unifast grantees.</h5>";
    }
?>
</div>

<!------Shows the result when pressing the appointment type button---->
<div id="showform"></div>
<!------Shows the result when pressing the appointment type button---->
