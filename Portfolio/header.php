
    <head>
        <title>My English Study Site</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/style.css?v10" rel="stylesheet" type="text/css">
    </head>
    <body>
			<header>
                <div>
					<table style = "height:100px;">
						<tr>
							<td style = "vertical-align:top; text-align:left; font-size:30px;", width = "600"><a href="resume.html"><b>😀Seungkyun Kim</b></a></td>
							<td style = "vertical-align:bottom; font-family: Lucida Bright; font-size:50px; color:orange;", width = "800"><b>Practice Makes Perfect!</b></td>
							<?php date_default_timezone_set('America/Toronto'); ?>
							<td style = "vertical-align:bottom; font-family: impact; text-align:right; font-size:25px; color:#ffffff;", width = "450"><?php echo date("Y-M-d");?><br><?php echo date("l"); ?></td>
						<tr>
					</table>
                </div>
            </header>

            <nav>
                <div id="menuItems">
                    <ul>
						<form name="search" id="search" method="post" action="searchWord.php">
							<li><a href="index.php">Main</a></li>
							<li><a href="word_list.php">Vocabulary</a></li>
							<li><a href="hangman.php">Games</a></li>
							<li><a href="resume.html">Resume</a></li>
							<li><input type="text" name="keyword" id="keyword" size='20' placeholder="Vocabulary Search" style="font-size: 15pt;"><input type='submit' name='btnSubmit' id='btnSubmit' value='🔍' style="font-size: 13pt;"></li>
						</form>
                    </ul>
                </div>
            </nav>