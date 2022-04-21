 <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
        
        <div class="row">
            <!--------------Start of No. of Active Requests-------------->
            
            <div class="col_3">
            <a href="staff_accepted_requests.php">
                <div class="card">
                    <div class="card_title" id="activerequests">Active Requests</div>
                    <div class="card_body">
                        <div class="card_text">
                            <?php
                                $acceptedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                    WHERE tbl_appointment_detail.status = 'Accepted' AND tbl_staff_registry.staff_id = '$staff_id'";
                                $acceptedrequest_result = mysqli_query($db, $acceptedrequest);
                                $count = mysqli_num_rows($acceptedrequest_result);
                                echo $count;
                            ?>
                        </div>
                    </div>
                </div>
                </a>
            </div>
          
            <!--------------End of No. of Active Requests-------------->
            <!--------------Start of No. of Pending Requests-------------->
            <div class="col_3">
                <a href="staff_pending_requests.php">
                    <div class="card">
                        <div class="card_title" id="pendingrequests">Pending Requests</div>
                        <div class="card_body">
                            
                            <div class="card_text">
                                <?php
                                    $pendingrequest="SELECT * FROM tbl_appointment INNER JOIN tbl_staff_registry 
                                        ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                        WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
                                        WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
                                        AND tbl_staff_registry.staff_id = '$staff_id'";
                                    $pendingrequest_result = mysqli_query($db, $pendingrequest);
                                    $count = mysqli_num_rows($pendingrequest_result);
                                    echo $count;
                                ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--------------End of No. of Pending Requests-------------->
            <!--------------Start of No. of Missed Requests-------------->
            <div class="col_3">
                <a href="staff_missed_requests.php">
                    <div class="card">
                        <div class="card_title" id="missedrequests">Missed Requests</div>
                        <div class="card_body">
                        
                            <div class="card_text">
                                <?php
                                    $missedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                        WHERE DATE(tbl_appointment_detail.appointment_date) < CURDATE() 
                                        AND tbl_appointment_detail.status = 'Accepted' 
                                        AND tbl_staff_registry.staff_id = '$staff_id'";
                                    $missedrequest_result = mysqli_query($db, $missedrequest);
                                    $count = mysqli_num_rows($missedrequest_result);
                                    echo $count;
                                ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--------------End of No. of Missed Requests-------------->

            <!--------------Start of No. of Declined Requests-------------->
            <div class="col_3">
                <a href="staff_declined_requests.php">
                <div class="card">
                    <div class="card_title" id="declinedrequests">Declined Requests</div>
                    <div class="card_body">
                        
                        <div class="card_text">
                            <?php
                                $declinedrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                    WHERE tbl_appointment_detail.status = 'Declined' AND tbl_appointment.staff_id = '$staff_id'";
                                $declinedrequest_result = mysqli_query($db, $declinedrequest);
                                $count = mysqli_num_rows($declinedrequest_result);
                                echo $count;
                            ?>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Declined Requests-------------->
            <!--------------Start of No. of Cancelled Requests-------------->
            <div class="col_3">
                <a href="staff_cancelled_requests.php">
                <div class="card">
                    <div class="card_title" id="cancelledrequests">Cancelled Requests</div>
                    <div class="card_body">
                        <div class="card_text">
                            <?php
                                $cancelledrequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
                                    WHERE tbl_appointment_detail.status = 'Cancelled' AND tbl_appointment.staff_id = '$staff_id'";
                                $cancelledrequest_result = mysqli_query($db, $cancelledrequest);
                                $count = mysqli_num_rows($cancelledrequest_result);
                                echo $count;
                            ?>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Cancelled Requests-------------->
            <!--------------Start of No. of Past Requests-------------->
            <div class="col_3">
                <a href="staff_done_requests.php">
                <div class="card">
                    <div class="card_title" id="pastrequests">Past Requests</div>
                    <div class="card_body">
                        <div class="card_text">
                            <?php
                                $donerequest="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
                                    ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
                                    INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
                                    INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id
                                    WHERE tbl_appointment_detail.status = 'done' AND tbl_appointment.staff_id = '$staff_id'";
                                $donerequest_result = mysqli_query($db, $donerequest);
                                $count = mysqli_num_rows($donerequest_result);
                                echo $count;
                            ?>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Declined Requests-------------->
        </div>
        <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->

        <style>
            .row {
            width: 100%;
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
            background-color: #fafafa;
            text-align: center;
            }
        
            .col_3{
                width: 320px;
                margin-bottom: 10px;
                margin-left:auto;
                margin-right:auto;
            }
            .card {
                text-align: center;
            }
            .card_title{
                background-color: #324e9e;
                padding-top: 20px;
                padding-bottom: 20px;
                color: #fff;
            }
            .card_body {
                background-color: white;
                font-size: 20px;
                color: #324e9e;
                padding-top: 10px;
                padding-bottom: 10px;
            }
        </style>