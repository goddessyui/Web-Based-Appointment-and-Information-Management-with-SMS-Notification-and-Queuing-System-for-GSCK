 <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
        
        <div class="row">
            <!--------------Start of No. of Active Requests-------------->
            
            <div class="col_3">
            <a href="#">
                <div class="card">
                    <div class="card_title" id="activerequests">No. of Enrolled Students</div>
                    <div class="card_body">
                        <div class="card_text">
                            <?php
                                 $enrolledstudents = "SELECT COUNT(*) AS total FROM tbl_student_record";
                                 $enrolledstudents_result = mysqli_query($db, $enrolledstudents);
                                 $count =mysqli_fetch_assoc($enrolledstudents_result);
                                 echo $count['total'];
                            ?>
                        </div>
                    </div>
                </div>
                </a>
            </div>
          
            <!--------------End of No. of Active Requests-------------->
            <!--------------Start of No. of Pending Requests-------------->
            <div class="col_3">
                <a href="#">
                    <div class="card">
                        <div class="card_title" id="pendingrequests">No. of Employed Staff</div>
                        <div class="card_body">
                            
                            <div class="card_text">
                                <?php
                                    $enrolledstaff = "SELECT * FROM tbl_staff_record";
                                    $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                                    $count = mysqli_num_rows($enrolledstaff_result);
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
                <a href="#">
                    <div class="card">
                        <div class="card_title" id="missedrequests">No. of Registered Students</div>
                        <div class="card_body">
                        
                            <div class="card_text">
                                <?php
                                    $registeredstudents = "SELECT * FROM tbl_student_registry";
                                    $registeredstudents_result = mysqli_query($db, $registeredstudents);
                                    $count = mysqli_num_rows($registeredstudents_result);
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
                <a href="#">
                <div class="card">
                    <div class="card_title" id="declinedrequests">No. of Registered Staff</div>
                    <div class="card_body">
                        
                        <div class="card_text">
                            <?php
                                 $registeredstaff = "SELECT * FROM tbl_staff_registry";
                                 $registeredstaff_result = mysqli_query($db, $registeredstaff);
                                 $count = mysqli_num_rows($registeredstaff_result);
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
                <a href="#">
                <div class="card">
                    <div class="card_title" id="cancelledrequests">Total No. of Appointments</div>
                    <div class="card_body">
                        <div class="card_text">
                            <?php
                                 $app = "SELECT * FROM tbl_appointment_detail WHERE `status`= 'Accepted'";
                                 $app_result = mysqli_query($db, $app);
                                 $count = mysqli_num_rows($app_result);
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
                <a href="#">
                <div class="card">
                    <div class="card_title" id="pastrequests">Total No. of Appointments Today</div>
                    <div class="card_body">
                        <div class="card_text">
                            <?php
                                date_default_timezone_set('Asia/Manila');                           		
                                $currentdate = date("Y-m-d");

                                $app = "SELECT * FROM tbl_appointment_detail WHERE appointment_date = '$currentdate' 
                                    AND `status`=('Accepted' OR 'Cancelled')";

                                $app_today = mysqli_query($db, $app);
                                $count = mysqli_num_rows($app_today);
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