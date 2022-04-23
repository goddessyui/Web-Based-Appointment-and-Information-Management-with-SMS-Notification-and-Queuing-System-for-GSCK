        
        
        
<!-------------------------------Start of the BACK TO TOP BUTTON ------------------------------------>
    <button onclick="topFunction()" id="backtotopbtn" title="Go to top">
        <img src="icon/top.png" width="40">
    </button>
  
        <!-------------------------------End of the BACK TO TOP BUTTON ------------------------------------>  
<script>

    //--------------START OF THE SCRIPT FOR THE BACK TO TOP BUTTON------------------------//
    //Get the button:
    mybutton = document.getElementById("backtotopbtn");

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
<style>

        #backtotopbtn { /*--------------START OF THE CSS FOR THE BACK TO TOP BUTTON------------------------*/
        display: none;
        position: fixed;
        bottom: 20px;
        right: 2%;
        z-index: 99;
        border: none;
    }

</style>