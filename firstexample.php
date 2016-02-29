<?php
//require "cookieharvester.php";
?>
<form action="http://localhost/vuln/xss/firstexample.php" method="get">
    <input type="text" name="q" value="" /><br>
<input type="submit" value="send" />
</form>
<p>Search query: <?php if(isset($_GET['q'])) echo $_GET['q'];?></p>
