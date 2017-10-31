<div id="copyrights">
    	<div class="container">
			
            	<div class="copyright-text">
                    <p style="text-align:center;">Copyright &copy 2014. All Right Reserved. </p>
                </div><!-- end copyright-text -->
			
			
        </div><!-- end container -->
    </div><!-- end copyrights -->
    
	<div class="dmtop">Scroll to Top</div>
        
  <!-- Main Scripts-->
  <script src="<?php echo base_url(); ?>websitecontent/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>websitecontent/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>websitecontent/js/menu.js"></script>
   <script src="<?php echo base_url(); ?>websitecontent/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>websitecontent/js/custom.js"></script>
  
  <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
  <script type="text/javascript" src="<?php echo base_url(); ?>websitecontent/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>websitecontent/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
  <script type="text/javascript">
	var revapi;
	jQuery(document).ready(function() {
		revapi = jQuery('.tp-banner').revolution(
		{
			delay:9000,
			startwidth:1170,
			startheight:370,
			hideThumbs:10,
			fullWidth:"on",
			forceFullWidth:"on"
		});
	});	//ready
  </script>
  
<script type="text/javascript"> 
// carousel setup
$(".owl-carousel").owlCarousel({
    navigation: false,
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    autoHeight: true,
    afterMove: moved,
});


function moved() {
    var owl = $(".owl-carousel").data('owlCarousel');
    if (owl.currentItem + 1 === owl.itemsAmount) {
        alert('THE END');
    }
}
 </script>
 
</body>

</html>