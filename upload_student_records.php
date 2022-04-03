<?php
include_once("admin_header.php");

//show error message
$message = '';
//-------------------------------upload csv------------------------------------------------------------------------------//
if(isset($_POST["upload"]))
{
    if($_FILES['student_file']['name'])
    {   
        $filename = explode(".", $_FILES['student_file']['name']);//convert file name into array and store into $ file name variable
        if(end($filename) == "csv")//check if file is csv or not
        {//if csv
            //truncate all data from table
            $truncate = "TRUNCATE `tbl_student_record`";
            mysqli_query($db, $truncate);
            //truncate all data from table
            $handle = fopen($_FILES['student_file']['tmp_name'], "r");//file open function
            while($data = fgetcsv($handle))//file get csv function: fetch comma delimited data from csv and convert into array and store into $ variable
            {
                $student_id = mysqli_real_escape_string($db, $data[0]); //data is cleaned by mysqli real escape function
                $first_name = mysqli_real_escape_string($db, $data[1]);  
                $last_name = mysqli_real_escape_string($db, $data[2]);
               
                $query="INSERT INTO tbl_student_record (student_id, first_name, last_name) 
                    VALUES ('$student_id', '$first_name', '$last_name')";
                        mysqli_query($db, $query);
            }
        fclose($handle);
        ?>
        <script type="text/javascript">
            window.location.href = 'upload_student_records.php?updation=1';
        </script>
        <?php
        }
        else//if not csv
        {
        $message = '<label class="text-danger">Please Select CSV File only</label>';
        }
    }
    else
    {
        $message = '<label class="text-danger">Please Select File</label>';
    }
}

if(isset($_GET["updation"]))
{
    $message = '<label class="text-success">Student Records Update Done</label>';
}
//-------------------------------upload csv------------------------------------------------------------------------------//

?>

<main>
<br />
<div class="container">
    <h2 align="center">Update Student Records</a></h2>
    <br />
    <!----------------------Form to Upload CSV ------------------------------------------------------------> 
    <form method="post" enctype='multipart/form-data'>
        <p><label>Please Select File(Only CSV Format)</label>
        <input type="file" name="student_file" /></p>
        <br />
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
    </form>
    <!----------------------Form to Upload CSV ------------------------------------------------------------>
    <br />
    
    <?php echo $message; ?>
        <h3 align="center">Student Record</h3>
   
    <br />
        <!------Form to Add data to tbl_student_record. Sends data to add_studentrecord.php------------------------------------------------>
        <form action="Staff/registrar/add_studentrecord.php" method="post">
            <span class="studentrecord">
                <label for="studentid">Student ID</label>
                <input type="text" id="studentid" name="studentid" required>
            </span>
            <span class="studentrecord">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>
            </span>
            <span class="studentrecord">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname"name="lastname" required>
            </span>
            <input type="submit" value="ADD A STUDENT" name="add">
        </form>
        <!------Form to Add data to tbl_student_record. Sends data to add_studentrecord.php------------------------------------------------>
    <?php
    //----------------------Form to Show, Update, Delete Data From tbl_student_record ------------------------------------------//
        $studentrecordquery = "SELECT * FROM tbl_student_record ORDER BY student_id ASC";
        $studentrecordresult = mysqli_query($db, $studentrecordquery);

        while($row = mysqli_fetch_array($studentrecordresult))
        {
    ?>
            <!--------Send Form Data to updatedelete_studentrecord.php---------------------------------------------->
            <form action="Staff/registrar/updatedelete_studentrecord.php" method="post">
                <input type="text" name="studentid" value="<?php echo $row["student_id"]?>">
                <input type="text" name="firstname" value="<?php echo $row["first_name"]?>">
                <input type="text" name="lastname" value="<?php echo $row["last_name"]?>">
                <button  type="submit" name="update">UPDATE</button>
                <button type="submit" name="delete">DELETE</button><br />
            </form>
            <!---------Send Form Data to updatedelete_studentrecord.php---------------------------------------------->
      <?php
        }
    //----------------------Form to Show, Update, Delete Data From tbl_student_record ------------------------------------------//
     ?>

  </div>
                            <!--success or error-->
                            <?php 
                            if(isset($_GET['success'])){
                        ?>
                                <p align="center">
                                    <?php 
                                        echo $_GET['success'];
                                    ?>
                                </p>
                        <?php
                            }
                            if(isset($_GET['error'])){
                        ?>
                                        <p align="center">
                                            <?php 
                                                echo $_GET['error'];
                                            ?>
                                        </p>
                                <?php
                                    }
                            else{
                            }
                        ?>
                        <!--success or error-->
    <!-------------------------------Start of the BACK TO TOP BUTTON ------------------------------------>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    <!-------------------------------End of the BACK TO TOP BUTTON ------------------------------------>                       
    </main>
</body>
</html>
<style> 
    main {
        margin-left: 5%;
        margin-right: 5%;
        margin-top: 100px;
    }
    .studentrecord{
        display: inline-block;
    }
    .studentrecord input{
        display: block;
    }
    #myBtn { /*--------------START OF THE CSS FOR THE BACK TO TOP BUTTON------------------------*/
        display: none; /* Hidden by default */
        position: fixed; /* Fixed/sticky position */
        bottom: 20px; /* Place the button at the bottom of the page */
        right: 30px; /* Place the button 30px from the right */
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        background-color: red; /* Set a background color */
        color: white; /* Text color */
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 15px; /* Some padding */
        border-radius: 10px; /* Rounded corners */
        font-size: 18px; /* Increase font size */
    }

    #myBtn:hover {
        background-color: #555; /* Add a dark-grey background on hover */
    } /*--------------END OF THE CSS FOR THE BACK TO TOP BUTTON------------------------*/
</style>
<script>
//--------------START OF THE SCRIPT FOR THE BACK TO TOP BUTTON------------------------//
    //Get the button:
    mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
    //--------------END OF THE SCRIPT FOR THE BACK TO TOP BUTTON------------------------//

</script>

