<?php /** @var \Core\View\ViewInterface $this */?>

<h1>This is register page.</h1>
<form method="POST" action="<?= $this->url("users","registerProcess");?>">
    Username: <input type="text" name="username" ><br/>
    Password: <input type="password" name="password"><br/>
    Confirm Password: <input type="password" name="confirmPassword"><br/>
    <input type="submit" name="save" value="Save">
</form>

