<!DOCTYPE html>
<HTML lang="en">
<HEAD>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> healthcare </title>
    <link rel='stylesheet' href='css/style.css' />
</HEAD>
<body>
    <div class="header">
        your Doctor
    </div> 

    <div class="navigation">
	
      <ul>
      
           <form  action="signup.php" method="post">
           <input type="submit" value="sign up">
           </form>
           
        <li>our products</li>
        <li>How to use it</li>
        <li>about us</li>
        <li>help</li>
      </ul>
    </div>

    <div class="content">
       <form action="patient.php" method="post">
            <fieldset class="fieldset">
            <legend >Wellcome</legend>
            <label class="user">Username</label>
            <input  type="text" name="username"  > <br>
            <label class="pass">Password </label>
            <input  type="password" name="password" >
            <input type="submit" value="login"><br>
                <div class="Rem">
                <input  type="checkbox">
                <label >Remember Me</label>
                </div>
         </fieldset>
        </form>
    </div>
     <div class="footer">
       Copyright &copy; 2018 all Right Reserved To EECE-CUFE healthcare project team
    </div> 
</body>
</HTML>