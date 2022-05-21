<?php
include("new_header_admin.php");
?>
<main>

<?php include("unifast_count_app.php"); ?>

    <div class="appointment_result">
        <div class="row">
            <!--success or error-->
            <?php 
            if(isset($_GET['success'])){
            ?>
            <p>
                <?php echo $_GET['success']; ?>
            </p> <?php
            }
            else{
            }
            if(isset($_GET['error'])){ ?>
                <p>
                    <?php echo $_GET['error']; ?>
                </p> <?php
            }
            else {
                
            }
            ?>
            <!--success or error-->
        </div>

        <div class="row_label">
          
            <div class="col_app">Date Declined</div>
            <div class="col_app">Date Requested</div>
            <div class="col_app">Appt.Type</div>
            <div class="col_app">Student</div> 
            <div class="col_app">Student's Note</div>
            <div class="col_app">Comment</div>

        </div>

        <div>
        <!-------------------------Show Declined Requests in Descending Order or From Most Current------------------------------>  
            <?php
        
                $declinedrequests="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                    WHERE tbl_appointment_detail.status = 'Declined' AND tbl_appointment.staff_id = '$staff_id' 
                    AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')
                    ORDER BY appointment_date DESC";
                $declinedrequest_result = mysqli_query($db, $declinedrequests);
            
                if($declinedrequest_result==TRUE) {
                    $count = mysqli_num_rows($declinedrequest_result);
                                
                    if($count>0) {
                        
                        while($rows=mysqli_fetch_assoc($declinedrequest_result)) {?>
                            <div class="row_app">

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['date_accepted']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['date_created']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['appointment_type']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php echo $rows['first_name']." ".$rows['last_name']; ?>
                                    </p>
                                    <p>
                                        <?php echo $rows['course']."-".$rows['year']; ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php
                                        if($rows['note']==""){
                                            echo "No note.";
                                        }
                                        else{
                                            echo $rows['note'];
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="col_app">
                                    <p>
                                        <?php
                                        if($rows['comment']==""){
                                            echo "You did not comment.";
                                        }
                                        else{
                                        echo $rows['comment'];
                                        }
                                        ?>
                                    </p>    
                                </div>
                                
                            </div><?php 
                        }
                    }
                    else{
                        echo "<p class='no_appt_result'>No Declined Appointments.</p>";
                    }
                }   
            ?>
        <!-------------------------Show Declined Requests ------------------------------>          
        </div>
    </div>
        <?php
        include("backtotop.php");
        ?>  
</main>

</div>
</div>

<div class="mobile_header"></div>

</body>
</html>



<style>

@import url('https://fonts.googleapis.com/css2?family=Roboto+Serif:opsz,wght@8..144,400;8..144,500;8..144,700&family=Roboto:wght@400;500;700&display=swap');

main {  
    padding: 15px;
    background: #EFF0F4;
}

main h3 {
    text-transform: uppercase;
    margin-left: 15px;
    margin-bottom: 15px;
    font-family: 'Roboto';
    color: red;
}
.card_row_div {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 15px;
    background: #EFF0F4;
    padding: 0 15px;
}
.card_row_div .col_3 {
    width: 182px;
    text-align: center;
    cursor: pointer;
    background: #fff;
}
.card_row_div .col_3 a {
    text-decoration: none;
    color: #000;
}

.card_row_div .col_3 .card .card_title {
    padding: 15px;
    font-size: 13px;
    text-transform: uppercase;
    color: #333;
    font-family: 'Roboto';
}
.card_row_div .col_3 .card .card_body {
    padding-bottom: 15px;
    font-size: 30px;
    font-family: 'Roboto';
}

/*---------appointment_result------------*/
.appointment_result {
    background: #EFF0F4;
    padding: 15px;
    padding-top: 5px;
    padding-bottom: 0;
}
.appointment_result .row {
    margin-bottom: 20px;
}
#error_appt {
    width: 100%;
    background: orange;
    color: #fff;
    font-size: 13px;
}
.row form input {
    padding: 4px 12px;
    border: none;
    background: #fff;
    cursor: pointer;
    outline: none;
    margin-right: 5px;
    transition: all .2s ease-in-out;
    font-size: 13px;
}
.row form input:hover {
    background: gold;
}
.row form input:nth-child(1) {
    border: 1px solid grey;
    background: #fff;
}


.appointment_result .row_app, .row_label {
    display: flex;
    justify-content: space-between;
    margin-top: 0;
}

.row_app {
    padding: 15px;
    background: #fff;
}
.row_app:nth-child(even) {
    background: #0001;
}
.row_label {
    text-transform: uppercase;
    color: #fff;
    background: #324e9e;
    padding: 0 15px;
    align-items: center;
}
.appointment_result .row_app .col_app,
.appointment_result .row_label .col_app {
    width:  10%;
    margin-right: 15px;
    font-size: 13px;
    font-family: 'Roboto';
}
.appointment_result .row_app .col_app,
.appointment_result .row_label .col_app :not(.col_app:nth-child(4)) {
    padding-top: 15px;
}


.appointment_result .row_label .col_app:nth-child(4) {
    width: 22%;
    padding: 15px;
}
.appointment_result .row_app .col_app:nth-child(4) {
    width: 22%;
    padding: 15px;
    background: none;
    color: #333;
    font-size: 14px;;
}
.appointment_result .row_app .col_app:nth-child(4) p {
    margin-bottom: 2px;
    font-family: 'Roboto Serif';
}
.appointment_result .row_app .col_app:nth-child(4) p:nth-child(1) {
    color: #324e9e;
    text-transform: uppercase;
    margin-bottom: 10px;
}
.appointment_result .row_app .col_app:nth-child(4) p:nth-child(4) {
    color: #324e9e;
    margin-top: 10px;
}
.appointment_result .row_app .col_app:nth-child(6),
.appointment_result .row_label .col_app:nth-child(6) {
    width: 20%;
}
.appointment_result .row_app .col_app:nth-child(5),
.appointment_result .row_label .col_app:nth-child(5) {
    width: 12%;
}



.appointment_result .row_app .col_app textarea {
    width: 90%;
    height: 105px;
    resize: none;
    padding: 5px;
    border: 1px solid gray;
    font-family: 'Roboto Serif';
}
.appointment_result .row_app .col_app input,
.appointment_result .row_app .col_app button {
    width: 90%;
    padding: 4px 12px;
    margin-bottom: 10px;
    font-size: 13px;
    cursor: pointer;
    border: none;
    color: #fff;
    background: #324e9e;
}

.appointment_result .row_app .col_app:nth-child(5) input:nth-child(1),
.appointment_result .row_app .col_app:nth-child(5) button {
    border: none;
    border: 1px solid gray;
    background: none;
    padding: 4px 12px;
    color: #333;
}
.appointment_result .row_app .col_app:nth-child(7) input {
    border: none;
    background: #444;
    padding: 4px 12px;
}
.appointment_result .row_app .col_app:nth-child(7) button {
    background: #324e9e;
}
.appointment_result .row_app .col_app:nth-child(7) a {
    color: #fff;
}


    #declinedrequests {
        background: #324e9e;
    }
    #declinedrequests .card_title,
    #declinedrequests .card_body {
        color: #fff;
    }
</style>