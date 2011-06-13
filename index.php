<?php if(empty($_GET['resource'])): ?>
    <html>
        <head>
        	<title>OneClick Installer</title>
        	<script type="text/javascript" src="<?php echo $_SERVER['SCRIPT_NAME']; ?>?resource=script" async="true"></script>
        </head>
        <body>
        	<center>
        		<h1>Welcome.</h1><br>
        		<b>Please wait...</b>
        	</center>
    	</body>
    </html>

<?php else: ?>
    <?php require_once __DIR__.'/logic.php'; ?>
<?php endif; ?>
