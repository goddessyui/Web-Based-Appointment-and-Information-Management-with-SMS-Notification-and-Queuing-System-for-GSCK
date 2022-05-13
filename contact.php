<?php
include("header.php");
?>
<div class="parent-div">
    <div class="number_directory">
        <div class="call">
            <h2>Directory</h2>
            <div class="contact_us">
                <div class="phone_number">09103541663</div>
                <div class="department_name">Registrar</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09683058730</div>
                <div class="department_name">Accounting and Scholarship</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09468426736</div>
                <div class="department_name">Enrollment</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09074357601</div>
                <div class="department_name">Senior High School</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09273803415</div>
                <div class="department_name">BSIT AND ACT</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09684253763</div>
                <div class="department_name">BSSW, BECE, AB-ENG</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09273619386</div>
                <div class="department_name">BSHM, AHM, BTVTED</div>
            </div>
            <div class="contact_us">
                <div class="phone_number">09361974758</div>
                <div class="department_name">BSTM AND BSBA</div>
            </div>
        </div>
        <div class="call">
            <h2>Address</h2> 
            <div class="address">
            
            <p>Rafael Alunan Ave, Poblacion, Koronadal City, 9506 South Cotabato</p>
        </div>
    </div>

    </div>
    
    



    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15856.749667470169!2d124.8414804!3d6.4979415!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2b58bb78e9ae72!2sGoldenstate%20College%20of%20Koronadal%20City!5e0!3m2!1sen!2sph!4v1652461970474!5m2!1sen!2sph" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>
<?php
     include("backtotop.php");
?>


<style>
    .parent-div{
        padding-top: 80px;
       
        font-family: roboto;
    }
    .contact_us{
       padding-left: 20px;
        width: 100%;
        display: flex;
    }
    .number_directory{
        display: flex;
    }
    .call{ width: 50%;}

    .contact_us:nth-child(2),
    .contact_us:nth-child(4),
    .contact_us:nth-child(6),
    .contact_us:nth-child(8) {
        background: #ebedee;
        }
    .phone_number{
        padding-right: 20px;
        padding-top:10px;
        padding-bottom:10px;
        text-align: left;
        font-weight: bold;
    }
    .department_name{
        padding-left: 20px;
        padding-top:10px;
        padding-bottom:10px;
        text-align: left;
    }
    .address{
        padding-left: 20px;
        padding-top: 25px;
        padding-bottom: 25px;
        word-break: break-word;

       
    }
    h4{
        font-weight: bolder;
    }
    h2{
        
        padding: 25px;
        background: #324E9E;
        color: #fff;
        margin-bottom: 25px;
    }

    iframe {
        width: 100%;
        height: 300px;
    }


</style>