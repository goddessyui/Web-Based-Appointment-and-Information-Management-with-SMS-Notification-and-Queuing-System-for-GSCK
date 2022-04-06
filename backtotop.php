        <!-------------------------------Start of the BACK TO TOP BUTTON ------------------------------------>
        <button onclick="topFunction()" id="backtotopbtn" title="Go to top">Top</button>
  
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
        display: none; /* Hidden by default */
        position: fixed; /* Fixed/sticky position */
        bottom: 20px; /* Place the button at the bottom of the page */
        right: 30px; /* Place the button 30px from the right */
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        background-color: #324e9e; /* Set a background color */
        color: white; /* Text color */
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 15px; /* Some padding */
        border-radius: 10px; /* Rounded corners */
        font-size: 18px; /* Increase font size */
    }

    #backtotopbtn:hover {
        background-color: #fcd228;
        color: #324e9e;  /* Add a dark-grey background on hover */
    } /*--------------END OF THE CSS FOR THE BACK TO TOP BUTTON------------------------*/
</style>