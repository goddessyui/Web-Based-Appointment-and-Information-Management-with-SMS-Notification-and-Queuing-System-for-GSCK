 <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
        
        <div class="card_row_div">
            <!--------------Start of No. of Active Requests-------------->
            
            <div class="col_3">
                <a href="#">
                    <div class="card">

                        <div class="card_title" id="activerequests">Enrolled student</div>

                        <div class="card_body">
                            <?php
                                $enrolledstudents = "SELECT COUNT(*) AS total FROM tbl_student_record";
                                $enrolledstudents_result = mysqli_query($db, $enrolledstudents);
                                $count =mysqli_fetch_assoc($enrolledstudents_result);
                                echo $count['total'];
                            ?>
                        </div>
                    </div>
                </a>
            </div>
          
            <!--------------End of No. of Active Requests-------------->
            <!--------------Start of No. of Pending Requests-------------->
            <div class="col_3">
                <a href="#">
                    <div class="card">
                        <div class="card_title" id="pendingrequests">Employed Staff</div>
                        <div class="card_body">
                            <?php
                                $enrolledstaff = "SELECT * FROM tbl_staff_record";
                                $enrolledstaff_result = mysqli_query($db, $enrolledstaff);
                                $count = mysqli_num_rows($enrolledstaff_result);
                                echo $count;
                            ?>
                        </div>
                    </div>
                </a>
            </div>
            <!--------------End of No. of Pending Requests-------------->
            <!--------------Start of No. of Missed Requests-------------->
            <div class="col_3">
                <a href="#">
                    <div class="card">
                        <div class="card_title" id="missedrequests">Registered Student</div>
                        <div class="card_body">
                            <?php
                                $registeredstudents = "SELECT * FROM tbl_student_registry";
                                $registeredstudents_result = mysqli_query($db, $registeredstudents);
                                $count = mysqli_num_rows($registeredstudents_result);
                                echo $count;
                            ?>
                        </div>
                    </div>
                </a>
            </div>
            <!--------------End of No. of Missed Requests-------------->

            <!--------------Start of No. of Declined Requests-------------->
            <div class="col_3">
                <a href="#">
                <div class="card">
                    <div class="card_title" id="declinedrequests">Registered Staff</div>
                    <div class="card_body">
                        <?php
                                $registeredstaff = "SELECT * FROM tbl_staff_registry";
                                $registeredstaff_result = mysqli_query($db, $registeredstaff);
                                $count = mysqli_num_rows($registeredstaff_result);
                                echo $count;
                        ?>
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Declined Requests-------------->
            <!--------------Start of No. of Cancelled Requests-------------->
            <div class="col_3">
                <a href="#">
                <div class="card">
                    <div class="card_title" id="cancelledrequests">Total Active Appts.</div>
                    <div class="card_body">
                        <?php
                                $app = "SELECT * FROM tbl_appointment_detail WHERE `status`= 'Accepted'";
                                $app_result = mysqli_query($db, $app);
                                $count = mysqli_num_rows($app_result);
                                echo $count;
                        ?>
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Cancelled Requests-------------->
            <!--------------Start of No. of Past Requests-------------->
            <div class="col_3">
                <a href="#">
                <div class="card">
                    <div class="card_title" id="pastrequests">Active Appts. Today</div>
                    <div class="card_body">
                        <?php
                            date_default_timezone_set('Asia/Manila');                           		
                            $currentdate = date("Y-m-d");

                            $app = "SELECT * FROM tbl_appointment_detail WHERE appointment_date = '$currentdate' 
                                AND `status`='Accepted'";

                            $app_today = mysqli_query($db, $app);
                            $count = mysqli_num_rows($app_today);
                            echo $count;
                        ?>
                    </div>
                </div>
                </a>
            </div>
            <!--------------End of No. of Declined Requests-------------->
        </div>
        <!--------------Start of Parent of No. of Appointment Requests (5 DIVS - active, pending, declined, cancelled, past)-------------->
