<!--
This PHP document shows the code for the 2 CSS Enhancements used in my website.
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
    include "includes/meta.inc";
    include "includes/menu.inc";
  ?>
	<title>CameoAudio | CSS Enhacements</title>
	<link href="styles/style.css" rel="stylesheet" />
</head>


<body>


  <h2>The following CSS enhancements have been used : </h2>
  <ol class="text_info">
     <li><h3>Image Hover Overlay</h3>
        In the first enhancement, I have used 
        <a href="product.php#hover_ani" class="enhance_link"><strong>Slide in Overlay from the Right</strong></a> 
        to design the layout of the products that have been listed on my 
        webpage. When the user hovers their mouse over the product image, a text box will transition from the right, overlapping the image and 
        display the brands CameoAudio has available for that product. Rather than displaying it in a list, I decided to incorporate this method of styling
        images, thus improvising the interface layout.<br /><br />
        I learnt about this from : <a href="https://www.w3schools.com/css/css3_images.asp">w3schools.com</a>
    </li>
    <li><h3>Emoji Feedback</h3>
       In the second enhancement, I have tried to improve user interface and web design by using 
       <a href="enquire.php#satisfaction"><strong>emojis to represent the levels of satisfaction</strong></a>
       of the customer rather than using the
       stationary checkbox, radio or select tags. I have used "CSS element1 ~ element2 Selector" that we haven't learnt about and have also combined it with the
       "CSS :checked Selector". The user can select 1 of the 5 different emojis representing the different levels, and the selected emoji transitions from a smaller 
       grey scale image to a slightly larger color image thus highlighting the selected option.<br /><br />
       I learnt about this from : <a href="https://codepen.io/gustavoquinalha/pen/gZBpxd">codepen.io</a>
    </li>
  </ol>


  <?php
  	include "includes/footer.inc";
  ?>

</body>
</html>
