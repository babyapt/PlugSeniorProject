<link rel="stylesheet" type="text/css" href="require/bootstrap-colorselector.css" />
<script src="require/bootstrap-colorselector.js"></script>
<style>
	.dropdown-colorselector {
		display: inline;
	}
	.btn-colorselector {
		border: 1px solid rgba(0,0,0,0.5);
	}
</style>
<script>
    $('#colorselector').colorselector({
        callback: function (value, color, title) {
			$("#colorTitle").text(title);
		}
	});
</script>