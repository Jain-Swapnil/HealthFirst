<!DOCTYPE html>
<html>
<head>
    <title>PRESCRIPTION</title>
<style>
	body 
		{
    background-color: #EAF2F8;font-family: Arial;margin-left:25%;margin-right:25%;border: 1px solid #000000;margin-bottom: 5px;padding: 0px 15px 0 15px;}
	input[type=text], textarea{width: 97%;padding: 10px;margin: 5px 0 22px 0;display: inline-block;border: none;background: #dbdbdb;}
	hr {border: 1px solid #e6e6e6;margin-bottom: 5px;}
	.button{background-color: #2a79d3;color: white;padding: 15px 20px;margin: 10px 0px;border: none;cursor: pointer;width: 100%;text:bold;}
	p{text-align:right;}
</style>
</head>
<body>
	<center>
	<form action="send.php" method="post">
		<u><h1>PRESCRIPTION OF DISEASE</h1></u>
	</center>
		
		<label for="firstname"><b>Name Of Patient</b></label>
		<input type="text" placeholder="Enter Patient's Name" id="firstname" name="firstname" required><br>

		<label for="email"><b>Email ID of Patient</b></label> 
		<input type="text" placeholder="Enter Patient's E-mail ID" id="email" name="email" required><br>

        <label for="subject">Description Of Disease</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea><br>
	<button type="submit" class="button">Submit</button>
		
	</form>


</body>
</html>