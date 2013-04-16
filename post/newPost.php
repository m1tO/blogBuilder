<html>
	<head>
    	<title>Blog</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro" />
		<meta name="generator" content="" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
        <?php include("../config.php"); ?>
        <!--Script editor di testo-->
        <script language="javascript" type="text/javascript" src="../tinymcpuk/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
</script>	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
            <div id="main">
            	<?php
					//Estrapolazione menu
					$query="SELECT nome, percorso FROM menu";
					$result=mysql_query($query,$myconn) or die ("Errore query");
					$riga=mysql_fetch_array($result);
				?>                 
				<div id="menu">
					<div class="nav">
						<ul>
							<?php
								while($riga)
								{
									print('<li><a href="../'.$riga['percorso'].'">'.$riga['nome'].'</a></li>');
									$riga=mysql_fetch_array($result);
								}
							?>
						</ul>
					</div>
				</div>
				<div id="content">
		        	<form action="rispNewPost.php" method="post">
    		        	<table>
        	    	    	<tr>
            		        	<td>Titolo</td>
                		        <td><input type="text" name="titolo" value="">
				</tr>
				<tr>
					<td>Testo</td>
					<td><textarea name="testo" rows="15" cols="80" style="width: 100%" value=""></textarea></td>
    	            	    <br>
        	            	<tr>
                            	<td><input type="submit" name="crea" value="Salva" onClick="return confirm('Conferma la tua scelta.')" /></td>
	        	            	<td><input type="reset" name="reset" value="Reset Campi" /></td>
							</tr>
						</table>
	                </form>    
					</div>
				<div id="clearer">&nbsp;
            	</div>
		        <div id="footer">
       				<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
		</div>
	</body>
</html>		
