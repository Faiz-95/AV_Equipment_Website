<!--
This PHP document shows the code for the 2 Javascript Enhancements used in my website.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "includes/meta.inc";
        include "includes/menu.inc";
    ?>
    <title>CameoAudio | Enhacements</title>
    <link href="styles/style.css" rel="stylesheet" />
</head>


<body>


    <h2>The following Javascript enhancements have been used : </h2>
    <ol class="text_info">
        <li><h3>Brand Name Display</h3>
            In the first enhancement, I have used a 
            <a href="enquire.php#enhance_button"><strong>"Display Brands" button</strong></a> 
            in the Enquiry/Order form to allow the user to view the various brands offered by
            CameoAudio for the particular product. When the user selects a product and clicks on the button, a small box appears on the right showing the 
            different brands. Likewise, when the option 'None' is selected, the box disappears.<br>I wanted the user to be able to select the desired brand 
            of a product using radio buttons to improve customer preference, however upon further research, I realised i couldnt with my limited knowledge of 
            Javascript :(<br>I do hope to learn it in future though!
        </li>
        <li><h3>Name on Credit Card</h3>
           In the second enhancement, I have tried to improve user easibility by obtaining a concatenation of the firstname and lastname through their input on the 
           enquiry page and automatically using that data to pre-load it to the
           <a href="payment.php#CC_Name"><strong>Cardholder Name</strong></a>
           on the Credit Card payment page.
        </li>
    </ol>


    <?php
  	   include "includes/footer.inc";
    ?>

</body>
</html>
