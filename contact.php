<!DOCTYPE html>
<html>
<head>
<?php
		require("header.php");
	?>
</head>
	<body>
	
	
            <div class="con">
                <fieldset class="roow">
				<legend>Contact/Send us E-mail</legend>
                    <form method="post">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="text" placeholder="Your Name" >
                            </div>
                            <div class="col">
                                <input type="email" name="email" placeholder="Your E-mail">
                            </div>
                            <div class="col">
                                <input type="text" name="subject" placeholder="Subject">
                            </div>
                            <div class="col">
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                            </div>
							<div class="col">
                                <input type="file" name="file" placeholder="files">
                            </div>
							<div class="col">
                                <button type="submit" class="btn">Send Message</button>
                                <button type="submit" class="btn">Cencel</button>
                            </div>
						</div>
                    </form>
				</fieldset>
            </div>
            
            
    <?php
		require("footer.php");
	?>
	</body>
</html>
