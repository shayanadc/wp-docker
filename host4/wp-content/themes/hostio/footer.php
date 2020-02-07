<?php $hostio_redux = get_option('hostio_redux');?> 
            
        <!-- Footer Section Starts -->
        <footer>
            <!-- Container Starts -->
            <div id="footer" class="container-fluid">
                <div class="container">
                	<div class="row">
	                <?php if ( is_active_sidebar( 'footer-area-1' ) ) : ?>
	                  <?php dynamic_sidebar( 'footer-area-1' ); ?>
	                <?php endif; ?>
	                <?php if ( is_active_sidebar( 'footer-area-2' ) ) : ?>
	                  <?php dynamic_sidebar( 'footer-area-2' ); ?>
	                <?php endif; ?>
	                </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>


<?php 
if(is_page('83')){


 ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	
$("li .platform-link").hover(function () {
var  imgid=  $(this).attr('data-pid') ;
    $("li .platform-link").removeClass("active");
 $(".webpage img").removeClass("active");
    // $("li .platform-link").addClass("active"); // instead of this do the below 
    $(this).addClass("active"); 
 $('#p'+imgid).addClass("active");
$  
});


</script>

<?php
}
?>

