<?php
include("dbconfig.php");
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    
    <?php
    
    $name = explode(", ", $_POST['search']);
    $search2 = $name[0];
    $search = end($name);


    $sql="SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name, tbl_staff_appointment.appointment_type 
    FROM tbl_staff_registry INNER JOIN tbl_staff_appointment 
    ON tbl_staff_registry.staff_id = tbl_staff_appointment.staff_id 
    WHERE EXISTS(SELECT * FROM tbl_staff_record WHERE tbl_staff_record.staff_id = tbl_staff_registry.staff_id) AND tbl_staff_registry.last_name = '$search2' AND tbl_staff_registry.first_name LIKE '$search'";
    $run= mysqli_query($db, $sql);
    
    if($run==TRUE) {
        $foundnum = mysqli_num_rows($run);
        if($foundnum > 0) {$i=0;
             
    ?>
    <div class="search_box_div">
        <button id="back_search"><p>Go Back</p></button>
        <p class="at_under_staff">Appointments Under <?php echo  $search . " " . $search2; ?></p>
    </div>

                <form method="post">
    <div class="main_apt_container">
        <div class="aptype-container">
    <?php
    
            while($rows = mysqli_fetch_assoc($run)) { 
                $at = "at".$i++;
    ?>     

       
            

                <button type="submit" class="aptype" name="<?php echo $at;?>" id="<?php echo $at;?>" required value="<?php echo $rows['appointment_type'];?>">
                    <div class="content_type">
                        <h4><?php echo $rows['appointment_type'];?></h4>
                        <div class="p_flex_end">
                            <p>
                            <?php
                                $atype=$rows['appointment_type'];
                                if($atype=="Meeting"){?>
                                    <p>This is a general appointment type. Indicate your purpose in the note.</p>
                                <?php
                                }
                                if($atype=="Presentation"){?>
                                    <p>For defense, reporting, or other presentation types.</p>
                                <?php
                                }
                                if($atype=="Module Claiming or Submission"){?>
                                    <p>Bring your receipt to claim your module.</p>
                                <?php
                                }
                                if($atype=="Project Submission"){?>
                                    <p>Ensure your name is written on the project.</p>
                                <?php
                                }
                                if($atype=="Pre-Enrollment"){?>
                                    <p>Requested From Registrar. Please bring a pen and necessary documents.</p>
                                <?php
                                }
                                if($atype=="Enrollment"){?>
                                    <p>Requested From Registrar. Please bring a pen and necessary documents.</p>
                                <?php
                                }
                                if($atype=="Evaluation of Grades"){?>
                                    <p>Please choose the correct Department Head for your department.</p>
                                <?php
                                }
                                if($atype=="Request Documents From Registrar"){?>
                                    <p>Requested From Registrar. Bring your own pen.</p> 
                                <?php
                                }
                                if($atype=="Request for Grades"){?>
                                    <p>Requested From Registrar.</p>
                                <?php
                                }
                                if($atype=="UniFAST - Claim Cheque"){?>
                                    <p>Bring your own pen and necessary documents.</p>
                                <?php
                                }
                                if($atype=="UniFAST - Submit Documents"){?>
                                    <p>Bring your own pen and necessary documents.</p>
                                <?php
                                }
                                if($atype=="Application for Graduation"){?>
                                    <p>Bring your own pen and necessary documents.</p>
                        </div>    
                                <?php
                            }
                        ?>
                    </div>
                </button>
          

                <input type="hidden" name="fn" id="fn" value="<?php echo $rows['first_name'];?>"> 
                <input type="hidden" name="ln" id="ln" value="<?php echo $rows['last_name'];?>"> 
                <input type="hidden" name="appointment_type" id="appointment_type" value="<?php echo $rows['appointment_type'];?>"> 
                
    <?php     
            }
            ?>
              </div>
        </div>
            </form>
            <?php
        }
        else {
            
            echo "No result. This person is not a current staff of GSCK."
            ?>
            
            <br><a href="student_appointment.php"><button>Back to List of Appointments</button></a>
            <?php
            
        }
    }
    else {
        echo "This staff has no appointment types listed.";
    }
?>


<!------Shows the result when pressing the appointment type button---->

<div id="showform"></div>
<!------Shows the result when pressing the appointment type button---->

<script>
$(document).ready(function() {

    for(let i=0;i<12;i++){
        
        $('#at'+i).click(function(){
    

            $.post("search_button_form.php", 
            {fn: $('#fn').val(),
            ln: $('#ln').val(),
            staff_id: $('#staff_id').val(),
            appointment_type: $('#at'+i).val(),}, 
            function(data){
                $('#showform').html(data);
            });
            return false;

        });
    }   
});



$(document).ready(function() {
    $('#back_search').click(function(){
     location.reload(true);
    });

});
</script>

<style>
    #back_search {
        background: none;
        padding: 0;
        border: none;
        margin: 0;
        margin-right: 10px;
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
    .at_under_staff {
        font-family: 'Roboto';
        text-transform: uppercase;
        font-size: 14px;
        color: #333;
    }
    .search_box_div {
        margin-left: 10%;
        padding-left: 8px;
        margin-bottom: 20px;
    }

    @media screen and (max-width: 652px) {
        .search_box_div {
            margin-left: 4%;
            padding-left: 4px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
    }
</style>