<html>
	<head>
    	<title>Pippo</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro" />
		<meta name="generator" content="" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
            <div id="main">
				<div id="content">
		        	<form action="step1.php" method="post">
    		        	<table>
        	    	    	<tr>
            		        	<td>Nome Sito</td>
                		        <td><input type="text" name="nomeSito" value=""></td>
							</tr>
		                    <tr>
    		                	<td>Indirizzo DataBase</td>
        		                <td><input type="text" name="indirizzoDB" value=""></td>
            		            <td><font color="#FF6633"><i>Es. localhost</i></font></td>
							</tr>
                    		<tr>
		                    	<td>Nome DataBase</td>
    		                    <td><input type="text" name="nomeDB" value=""></td>
							</tr>
            		        <tr>
                		    	<td>Utente DataBase</td>
                    		    <td><input type="text" name="userDB" value=""></td>
	                    	   	<td><font color="#FF6633"><i>Es. root</i></font></td>
							</tr>
    	    	            <tr>
        	    	        	<td>Password DataBase</td>
            	    	        <td><input type="password" name="passwdDB" value=""></td>
							</tr>
	                	    <tr>
    	                		<td>Porta DataBase</td>
        	                	<td><input type="text" name="portaDB" value="3306" /></td>
							</tr>
    	            	    <br>
        	            	<tr>
                            	<td><input type="submit" name="crea" value="Fine processo guidato" onClick="return confirm('Conferma la tua scelta.')" /></td>
	        	            	<td><input type="reset" name="reset" value="Reset Campi" /></td>
							</tr>
						</table>
	                </form>    
					</div>
                    <div id="clearer">&nbsp;
            		</div>
		        </div>
				<div id="footer">
        		&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
	</body>
</html>			