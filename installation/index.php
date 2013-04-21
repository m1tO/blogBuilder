<html>
	<head>
    	<title>Installazione/Installation</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Lo Porto Giovanni & Emmanuele Catanzaro" />
		<meta name="generator" content="" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/configuration.png" width="200" alt="configuration" /></a>
                </div>
			</div>
            <div id="main">
				<div id="content">
		        	<?php
						if(isset($_GET['ln']))
						{
							$ln=$_GET['ln'];
							if($ln=="it")
							{
								//Codice italiano ?>
								<form action="it.php" method="post">
			    		        	<table>
        				    	    	<tr>
            		    			    	<td>Nome Sito</td>
			                		        <td><input type="text" name="nomeSito" value=""></td>
										</tr>
                        			    <tr>
		        	    		        	<td>Upload Logo Sito</td>
        			        		        <td><input type="text" name="nomeSito" value=""></td>
                    			            <td><input type="button" value="Upload" onClick="return confirm('Assicurati che il logo abbia dimensioni: \n360 x 140 pixel.')"></td>
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
	                			</form><?php
							}
							elseif ($ln=="en")
							{
								//Codice inglese ?>
								<form action="en.php" method="post">
			    		        	<table>
        				    	    	<tr>
            		    			    	<td>Name Site</td>
			                		        <td><input type="text" name="nomeSito" value=""></td>
										</tr>
                        			    <tr>
		        	    		        	<td>Upload Logo Site</td>
        			        		        <td><input type="text" name="nomeSito" value=""></td>
                    			            <td><input type="button" value="Upload" onClick="return confirm('Logo dimensions are: \n360 x 140 pixels?')"></td>
										</tr>
		            			        <tr>
    			                			<td>Address DataBase</td>
		    	    		                <td><input type="text" name="indirizzoDB" value=""></td>
            					            <td><font color="#FF6633"><i>Eg. localhost</i></font></td>
										</tr>
            			        		<tr>
		                			    	<td>Name DataBase</td>
			    		                    <td><input type="text" name="nomeDB" value=""></td>
										</tr>
            		    			    <tr>
			                		    	<td>User DataBase</td>
            			        		    <td><input type="text" name="userDB" value=""></td>
	                    				   	<td><font color="#FF6633"><i>Eg. root</i></font></td>
										</tr>
    	    				            <tr>
        	    	    			    	<td>Password DataBase</td>
			            	    	        <td><input type="password" name="passwdDB" value=""></td>
										</tr>
	                				    <tr>
			    	                		<td>Port DataBase</td>
        				                	<td><input type="text" name="portaDB" value="3306" /></td>
										</tr>
    	            	    			<br>
			        	            	<tr>
            			                	<td><input type="submit" name="crea" value="End-led process" onClick="return confirm('Confirm your choice.')" /></td>
	        	        			    	<td><input type="reset" name="reset" value="Reset" /></td>
										</tr>
									</table>
	                			</form><?php
							}
						}
						else
						{ ?>
							<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='GET'>
                                <table>
                                	<tr>
                                    	<td><font color="#FF6633"><i>Seleziona la tua lingua</i></font></td>
                                        <td></td><td></td><td>|</td>
                                        <td><font color="#FF6633"><i>Select your language</i></font></td>
                                        
                                	</tr>
                                    <tr>
                                    	<td>Italiano<input type="radio" name="ln" value="it" onClick="this.form.submit();"></td>
                                        <td></td><td></td><td>|</td>
                                    	<td>English<input type="radio" name="ln" value="en" onClick="this.form.submit();"></td>
									</tr>
								</table>
							</form>
					<?php } ?>
                    </div>
					<!--<div id="clearer">&nbsp;
            		</div>-->
		        	<div id="footer">
       					<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
					</div>
              </div>
		</div>
	</body>
</html>