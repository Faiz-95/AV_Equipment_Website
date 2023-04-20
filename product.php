<!--
This PHP document shows the code for the Product Page of my website
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include "includes/meta.inc";
    include "includes/menu.inc";
  ?>
  <title>CameoAudio | Product Range</title>
  <link href="styles/style.css" rel="stylesheet" />
</head>


<body>


<!--
Each product has a picture and some information related to it enclosed in its own box.
To group each product separately, i have used the <section> tag.
-->

  <h2>You can choose from a wide variety of products listed below to suit your requirements perfectly : </h2>
  <section class="products" id="hover_ani" >
    <h3>Projectors</h3>
      <div class="container">
      <img src="images/projector.jpeg" alt="Photo of Projector" id="imgprj" class="image"/>
      <div class="overlay">
        <div class="text">Brands : <br />Sanyo, Panasonic, Apple</div>
      </div>
      </div>
      <br />
      <br />
      A Projector is an optical device that projects a figure or picture onto a surface and enlargens the display. This surface is usually light in color and it may be a on projection screen, white screen or sometimes a wall and is used for an alternative for a TV.
  </section>

  <section class="products" >
    <h3>Display Screens</h3>
    <div class="container">
    <img src="images/screen.jpeg" alt="Photo of Display Screen" id="imgscn" class="image"/>
    <div class="overlay">
      <div class="text">Brands : <br />LG, Samsung</div>
    </div>
    </div>
    <br />
    <br />
    A Screen is a visual device that is part of the monitor that displays information that is visible to the user. Our display screens use LED and OLED technology with a high resolution and contrast to ensure maximum customer satisfaction.
  </section>

  <section class="products" >
  <h3>Studio Lights</h3>
    <div class="container">
      <img src="images/light.jpeg" alt="Photo of Studio Lights" id="imgstl" class="image"/>
      <div class="overlay">
        <div class="text">Brand : <br />Zanfi</div>
      </div>
    </div>
      <br />
      <br />
      Studio lighting is an essential addition to most photographers arsenal as it allows you to create natural lighting effects. This type of lighting is more commonly known as flash lighting as light is flashed each time the camera is fired.
  </section>

  <section class="products" >
    <h3>Speakers</h3>
    <div class="container">
      <img src="images/speaker.jpg" alt="Photo of Speaker" id="imgspk" class="image"/>
       <div class="overlay">
        <div class="text">Brands : <br />Bose, Meridian, JBL, Harmann</div>
      </div>
    </div>
      <br />
      <br />
      Speakers are one of the most common output devices used with computer systems. They convert electromagnetic waves into sound waves. Our speaker system's have the ability to accurately reproduce sound frequencies and provide loud and clear sound for the user. 
  </section>

  <section class="products" >
    <h3>Microphones</h3>
    <div class="container">
      <img src="images/microphone.jpeg" alt="Photo of Microphone" id="imgmic" class="image"/>
       <div class="overlay">
        <div class="text">Brands : <br />Sennheiser, Neumann, Schoeps</div>
       </div>
    </div>
      <br />
      <br />
      A microphone is a device that captures audio by converting sound waves into an electrical signal. This signal can be amplified as an analog signal or a digital signal, which can be processed by a computer or other digital audio devices. We offer the option for wired and wireless microphones.
  </section>

  <section class="products" >
    <h3>Headphones</h3>
    <div class="container">
      <img src="images/headphone.jpeg" alt="Photo of Headphones" id="imghdp" class="image"/>
      <div class="overlay">
        <div class="text">Brand : <br />Beats by Dr. Dre</div>
       </div>
    </div>
      <br />
      <br />
      Headphones are a pair of small loudspeaker drivers worn on or around the head over a user's ears. They convert an electrical signal to a corresponding sound. Headphones let a single user listen to an audio source privately, in contrast to a loudspeaker.
  </section>

<!--
I have used a PHP-MySQL connection to display a table showing the product charges to the customer so that it is easier to read and compare for the user.
-->

      <?php
          echo "<figure>";
          require_once('settings.php');
          // The @ operator suppresses the display of any error messages
          // mysqli_connect returns false if connection failed, otherwise a connection value
          $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
          if ($conn){
              $sql_table = "products";
              $query = "select * from products order by product_type";
              $result = mysqli_query($conn, $query);
              if (!$result) {
                $tableResult .= "Something is wrong with ". $query . "<br />";   
              } 
              else {
                if (mysqli_num_rows($result) > 0 ){
                  echo "<table id='Diff_Prd'>";
                  echo "<tr>\n"
                     ."<th scope='col'>Product Type</th>\n"
                     ."<th scope='col'>Brands</th>\n"
                     ."<th scope='col'>Charges (per day)</th>\n"
                     ."</tr>\n";
                  
                  while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td class='prod_type'>",$row["product_type"],"</td>";
                    echo "<td>",$row["product_brand"],"</td>";  
                    echo "<td>",$row["product_charges"],"</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                  mysqli_free_result($result);
                }
                else {
                  echo "<h3>No records exist</h3>"; 
                }
              }
              mysqli_close($conn);
          } 
          echo "</figure>";       
      ?>
     
<!--
I have combined the requirement of unordered and ordered list in one and used it to display CameoAudio's biggest events.
-->

  <section id="events">
    <h3>Major Events Sponsored</h3>
      <ol>
        <li>2018
        <ul>
          <li>ICC World Cup</li>
          <li>The Weeknd Concert</li>
          <li>Marshmello Concert</li>
        </ul></li>
        <li>2019
        <ul>
          <li>Melbourne Grand Prix</li>
          <li>Commonwealth Games</li>
          <li>Australian Open</li>
        </ul></li>
        <li>2020
        <ul>
          <li>Australian Paralympics</li>
          <li>Sydney Grandprix</li>
        </ul></li>
      </ol>
  </section>

  <aside>
    <h3>Coming soon....</h3>
    The Silver, Gold and Diamond Packages will be available for our users very soon. They offer the
    best prices (depends on brand selection) and will eliminate the hastle of placing orders for
    equipment individually. Prices range from 150A$ - 500A$. Stay tuned for the latest updates and
    offers and be quick to claim yours!
  </aside>


  <?php
    include "includes/footer.inc";
  ?>

</body>
</html>
