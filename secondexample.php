<?php
require "cookieharvester.php";
?>
<form action="http://localhost/vuln/xss/secondexample.php" method="post">
    <input type="text" name="q" value="" /><br>
<input type="submit" value="send" />
</form>
<p>Search query: <?php if(isset($_POST['q'])) echo $_POST['q'];?></p>

