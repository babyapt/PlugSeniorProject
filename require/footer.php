        </div>



    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>PC E-Lemac Website 2014 - <?php $ye = date('Y');  echo "$ye"; ?></p>
					
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom JavasScript -->
	<script src="require/script.js"></script>
	<script src="require/fileinput.js" type="text/javascript"></script>
	<script src="require/fileinput_locale_th.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
<?php
// 	echo $requireDialog;
	if (is_array($requireDialog)||is_object($requireDialog)) foreach($requireDialog as $val) require_once($val); 
?>
</body>

</html>
<?php
	$conn = null;
?>