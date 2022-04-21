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
    FROM tbl_staff_record WHERE last_name = '$search2' AND first_name LIKE '$search'";
    $run= mysqli_query($db, $sql);
    
    if($run==TRUE) {
        $foundnum = mysqli_num_rows($run);
        if($foundnum > 0) {
            $i=0;
             
    ?>
                
    <?php
            while($rows = mysqli_fetch_assoc($run)) { 
                
    ?>               
                    <div  class="form_group">    
                        
                        <form action="Staff/registrar/updatedelete_staffrecord.php" method="post">
                            
                            <div class="form_inline" >
                                <div class="form_list">
                                    <label><div class="left_counter">Search Result:</div></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $rows["last_name"]?>">               
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $rows["first_name"]?>">
                                    <input type="text" class="form-control" id="staffid" name="staffid" value="<?php echo $rows["staff_id"]?>">
                                </div>
                                <div class="btn_group" role="group" aria-label="Basic example">
                                    <button class="btn_update" type="submit" name="update">UPDATE</button>
                                    <button class="btn_delete" type="submit" name="delete">DELETE</button>
                                </div> 
                            </div>

                        </form>
                    </div>            
    <?php     
            }
            ?>
            
            <?php
        }
        else {
            echo "<h5 style='color:red;'>There is no staff named \"". $_POST['search'] . "\" on the list of employees.</h5>";
            ?>    
            <?php
        }
    }
    else {
        echo "<h5 style='color:red;'>There are no staffs in the list of employees.</h5>";
    }
?>
</div>

<!------Shows the result when pressing the appointment type button---->
<div id="showform"></div>
<!------Shows the result when pressing the appointment type button---->
