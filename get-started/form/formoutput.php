<html>
<body>
<?php
    $username = '';
    if(isset($_POST['submit'])){
        $ok = true;

        if(!isset($_POST['username']) || $_POST['username']===''){
            $ok=false;
        }else{
            $username=$_POST['username'];
        }

        if(!isset($_POST['gender']) || $_POST['gender'] === ''){
            $ok=false;
        }
        if($ok){
            printf('
                <br>username: %s
                <br>password: %s
                <br>gender: %s
                <br>languages: %s
                ',
                htmlspecialchars($_POST['username'],ENT_QUOTES),
                $_POST['password'],
                $_POST['gender'],
                implode(' - ', $_POST['languages'])   
            );
        }else{
            printf("Error!!!!!");
            //echo("Error!!!!!");
        }

        //is_array(needle,haystack); //check if element is present in array
    }
?>
<br>
<form method="post" action="">
    username: 
    <input type="text" name="username" value="<?php echo(htmlspecialchars($username)); ?>"/><br/>
    
    password: 
    <input type="password" name="password" value=""/><br/>
    
    gender: 
    <input type="radio" name="gender" value="m"/>m&nbsp;
    <input type="radio" name="gender" value="f"/>f<br/>
    
    languages: 
    <select name="languages[]" multiple size="3">
        <option value="en">english</option>
        <option value="sp">spanish</option>
    </select>
    
    <input type="submit" name="submit" value="submit"/>
</form>    
</body>
</html>