
		<script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            //-----------------------------
            //-- alerts actions function --
            //-----------------------------
            $("#alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert").slideUp(500);
            });

            //-------------------------
            //-- stop repeat posting --
            //-------------------------
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            };
        </script>
		<footer>
			<p>جميع الحقوق محفوظة <a href="#">ahmed-elgzar</a> &copy; 2021</p>
		</footer>
    </body>
</html>