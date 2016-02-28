<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form action="http://localhost/vuln/xss/firstexample.php" method="get">
    <input type="text" name="q" value="" /><br>
<input type="submit" value="send" />
</form>
<p>Search query: <?php if(isset($_GET['q'])) echo $_GET['q'];?></p>
