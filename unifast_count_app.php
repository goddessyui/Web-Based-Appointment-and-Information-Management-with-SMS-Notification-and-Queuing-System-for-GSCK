<!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
        
<div class="card_row_div">
            <!--------------Start of No. of Active Requests-------------->
            <div class="col_3"  id="activerequests">
            <a href="unifast_accepted_request.php">
                <div class="card">
                    <div class="card_title">Active Requests</div>
                    
                    <div class="card_body">
                    
                        <?php
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");
                            
                            $acceptedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id'
                                AND tbl_appointment_detail.appointment_date >= '$currentdate'
                                AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')";
                            $acceptedrequest_result = mysqli_query($db, $acceptedrequest);
                            $count = mysqli_num_rows($acceptedrequest_result);
                            echo $count;
                        ?>

                    </div>

                </div>
            </a>
            </div>
          
            <!--------------End of No. of Active Requests-------------->


             <!--------------Start of No. of Claim Cheque Pending Requests-------------->
             <div class="col_3"  id="claimpendingrequests">
            <a href="unifast_claim_pending.php">
                <div class="card">
                    <div class="card_title">Claim Cheque Pending Requests</div>

                    <div class="card_body">
                    <?php

$claimpendingrequest="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                            tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                            tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                            tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_unifast_grantee.batch_status
                            FROM tbl_appointment INNER JOIN tbl_staff_registry 
                            ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                            LEFT OUTER JOIN tbl_unifast_grantee ON tbl_student_registry.student_id = tbl_unifast_grantee.student_id 
                            WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                            WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                            AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Claim Cheque' 
                            ORDER BY date_created ASC";

                            
                            $claimpendingrequest_result = mysqli_query($db, $claimpendingrequest);
                            $count = mysqli_num_rows($claimpendingrequest_result);
                            echo $count;
                            
                            ?>
                        
                    </div>
                </div>
            </a>
            </div>
            <!--------------End of No. of Claim Cheque Pending Requests-------------->

            <!--------------Start of No. of Submit Documents Pending Requests-------------->
            <div class="col_3"  id="submitpendingrequests">
            <a href="unifast_submit_pending.php">
                <div class="card">
                    <div class="card_title">Submit Document Pending Requests</div>

                    <div class="card_body">
                    <?php


                            $submitpendingrequest="SELECT tbl_appointment.appointment_id, tbl_appointment.date_created,
                            tbl_appointment.student_id, tbl_appointment.staff_id, tbl_appointment.appointment_type,
                            tbl_appointment.note, tbl_appointment.status, tbl_student_registry.first_name, 
                            tbl_student_registry.last_name, tbl_student_registry.course, tbl_student_registry.year, tbl_unifast_grantee.batch_status
                            FROM tbl_appointment INNER JOIN tbl_staff_registry 
                            ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                            INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                            LEFT OUTER JOIN tbl_unifast_grantee ON tbl_student_registry.student_id = tbl_unifast_grantee.student_id 
                            WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                            WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                            AND tbl_staff_registry.staff_id = '$staff_id' AND tbl_appointment.appointment_type='UniFAST - Submit Documents' 
                            ORDER BY date_created ASC";
                            
                           
                            $submitpendingrequest_result = mysqli_query($db, $submitpendingrequest);
                            $count = mysqli_num_rows($submitpendingrequest_result);
                            echo $count;
                            
                            ?>
                        
                    </div>
                </div>
            </a>
            </div>
            <!--------------End of No. of Submit Documents Pending Requests-------------->

            
            <!--------------Start of No. of Missed Requests-------------->
            <div class="col_3" id="missedrequests">
                <a href="unifast_missed_request.php">
                    <div class="card">
                        <div class="card_title">Missed Requests</div>
                        <div class="card_body">
                        
                            
                                <?php
                                    $missedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                        WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                                        AND tbl_appointment_detail.status = 'Accepted' 
                                        AND tbl_staff_registry.staff_id = '$staff_id'
                                        AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')";
                                    $missedrequest_result = mysqli_query($db, $missedrequest);
                                    $count = mysqli_num_rows($missedrequest_result);
                                    echo $count;
                                ?>

                        </div>
                    </div>
                </a>
            </div>
            <!--------------End of No. of Missed Requests-------------->

            <!--------------Start of No. of Declined Requests-------------->
            <div class="col_3" id="declinedrequests">
                <a href="unifast_declined_request.php">
                <div class="card">
                    <div class="card_title">Declined Requests</div>
                    <div class="card_body">
                        
                        
                            <?php
                                $declinedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                    WHERE tbl_appointment_detail.status = 'Declined' AND tbl_appointment.staff_id = '$staff_id'
                                    AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')";
                                $declinedrequest_result = mysqli_query($db, $declinedrequest);
                                $count = mysqli_num_rows($declinedrequest_result);
                                echo $count;
                            ?>
        
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Declined Requests-------------->
            <!--------------Start of No. of Cancelled Requests-------------->
            <div class="col_3" id="cancelledrequests">
                <a href="unifast_cancelled_request.php">
                <div class="card">
                    <div class="card_title">Cancelled Requests</div>
                    <div class="card_body">
                        
                            <?php
                                $cancelledrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                    WHERE tbl_appointment_detail.status = 'Cancelled' AND tbl_appointment.staff_id = '$staff_id'
                                    AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')";
                                $cancelledrequest_result = mysqli_query($db, $cancelledrequest);
                                $count = mysqli_num_rows($cancelledrequest_result);
                                echo $count;
                            ?>
               
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Cancelled Requests-------------->
            <!--------------Start of No. of Past Requests-------------->
            <div class="col_3" id="pastrequests">
                <a href="unifast_done_request.php">
                <div class="card">
                    <div class="card_title">Past Requests</div>
                    <div class="card_body">
                        
                            <?php
                                $donerequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                                    WHERE tbl_appointment_detail.status = 'done' AND tbl_appointment.staff_id = '$staff_id'
                                    AND tbl_appointment.appointment_type IN ('UniFAST - Claim Cheque', 'UniFAST - Submit Documents')";
                                $donerequest_result = mysqli_query($db, $donerequest);
                                $count = mysqli_num_rows($donerequest_result);
                                echo $count;
                            ?>
                  
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Declined Requests-------------->
        </div>
        <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
