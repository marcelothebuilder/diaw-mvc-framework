<style type="text/css">
#vendor_debug {
	display: block;
	background-color: rgba(0, 0, 0, .80);
	position: fixed;
	margin: 0 !important;
	padding: 20px !important;
	bottom: 0;
	right: 0;
	color: white;
	transition: opacity 1s
}
</style>
<script type="text/javascript">
setInterval( function () {
    'use strict';
    document.getElementById('vendor_debug').style.opacity = 0;
},
        2000);
</script>
<div id="vendor_debug">
<pre>Script took <?php echo ($benchmark_end - $benchmark_init) ?> seconds to run
GET <?php if (isset($_GET)) var_dump($_GET); ?>
POST <?php if (isset($_POST)) var_dump($_POST); ?>
SESSION <?php if (isset($_SESSION)) var_dump($_SESSION); ?>
</pre>
</div>