<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistem Informasi Anugerah Jaya Abadhi</title>
<link rel="stylesheet" href="menu/css/style.css">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="login.css" />
<script type="text/javascript" src="login.js"></script>
</head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="top"><table width="1368" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<table width="1368" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td bgcolor="#444" align="center" valign="center"><img src="images/utravel-logo.jpg" width="100px"><br/><br/><font color="white" size="5"><b>Sistem Informasi Utravel</font></td>
			</tr>
				<tr>
         		   <td height="800" align="left" valign="top">
					<div align="center" style="margin-top:30px; ">
					<div id="content">
					<div class="constrainedContent" id="contentWrap">
					<script type="text/javascript" src="FormSpring_files/user.js"></script>
					<link rel="stylesheet" type="text/css" href="FormSpring_files/login.css">
					<font color="#FF0000">
					<?php
						error_reporting (E_ALL ^ E_NOTICE);
						echo $_GET['msg'];
					?>
					</font>
					<form method="post" action="checklogin.php"  id="loginForm">
						<div id="loginContainer">
						<div id="loginHeader">
							<h1 style="color:#fff; font-size:16pt; font-weight: bold;">Login</h1>
						</div>
							<table id="loginContent">
								<tbody>
								<tr>
									<td class="tdLabel"><label for="email">Username</label></td>
									<td><input id="email" name="myusername" size="25" type="text"></td>
								</tr>
								<tr>
									<td class="tdLabel"><label for="password">Password</label></td>
									<td>
										<input id="password" name="mypassword" size="25" type="password">
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										<input value="Login" id="submit" type="submit">
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</form>
					</td>
				</tr>
				<tr>
					<td height="30" align="center" bgcolor="#444"><span class="style2"><font color="white"><b><p>&copy; Anugerah Jaya Abadhi
						<script language="JavaScript" type="text/javascript">
							now = new Date
							theYear=now.getYear()
							if (theYear < 1900)
								theYear=theYear+1900
								document.write(theYear)
						</script></span></td>
				</tr>
			</table>
		</td>
      </tr>
	</td>
  </tr>
</table>
</body>
</html>
