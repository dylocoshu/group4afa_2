<div class="text-above">
  
  <p>Investing in Everybody Welcome can be a wise decision for venue owners and operators who want to promote accessibility and inclusion in their businesses. By paying for this tool, venue owners can easily record and share information about their venue's accessibility features, which can attract more customers who are looking for accessible options. This can result in increased revenue and customer loyalty, as well as a positive reputation for the venue as a welcoming and inclusive space. Additionally, using Everybody Welcome demonstrates a commitment to accessibility, which can help comply with legal requirements and avoid potential lawsuits related to accessibility barriers. Finally, by using Everybody Welcome, venue owners can contribute to a more inclusive society, promoting equal access to public spaces for all individuals, regardless of their abilities</p>
</div>


<script async
  src="https://js.stripe.com/v3/buy-button.js">
</script>

<stripe-buy-button
  buy-button-id="buy_btn_1MqubgBg0Cs1uhrXwb1lJ4J0"
  publishable-key="pk_test_51MlYwCBg0Cs1uhrX9uaURcFBysIKun9cST7o8XhodMS1H4Ka3SxVd3EH2la3bSWBIjwN22DvoZMYD6s2QoKtJ15H00Qea64vt4"
>
</stripe-buy-button>

<style>

body {font-family:Arial, Helvetica, sans-serif; font-size:12px;}
 
.fadein { 
position:relative; height:332px; width:500px; margin:0 auto;
background: #ebebeb;
padding: 10px;
 }
.fadein img{
	position:absolute;
	width: calc(96%);
    height: calc(94%);
    object-fit: scale-down;
}

.text-above {
  margin-bottom: 20px;
}

stripe-buy-button {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
}

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
$(function(){
	$('.fadein img:gt(0)').hide();
	setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 3000);
});
</script>
<body>
  <div>
  <div class="fadein">
<?php 
// display images from directory
// directory path
$dir = "./sliders/";
 
$scan_dir = scandir($dir);
foreach($scan_dir as $img):
	if(in_array($img,array('.','..')))
	continue;
?>
<img src="<?php echo $dir.$img ?>" alt="<?php echo $img ?>">
<?php endforeach; ?>
</div>


</div>

</body>






