
    <h2>modification user</h2>
    <form method="post" action="modifUser.php">
        <input type="text" name="loginUser" id="loginUser" value="<?php echo $_POST['login'];?>" required/><br/>
        <label for="pwdUser">Password :</label>
        <input type="text" name="pwdUser" id="pwdUser" placeholder="pwd..." size="30" maxlength="30" required/><br/>
        <label for="lastnameUser">Last name :</label>
        <input type="text" name="lastnameUser" id="lastnameUser" placeholder="nom..." size="30" maxlength="30" required/><br/>
        <label for="firstnameUser">First name :</label>
        <input type="text" name="firstnameUser" id="firstnameUser" placeholder="prenom..." size="30" maxlength="30" required/><br/>
        <input type="submit" value="modifier"/>
    </form>
