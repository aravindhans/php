<!DOCTYPE html>
<html>
    <head>
        <title>Title Page</title>
    </head>
    <body>
        <h1 class="text-center">Hello World</h1>
        <h2>Welcome <?php echo $name;?></h2>
        Your colors are:
        <?php
            foreach($colors as $color){
                echo '<li>'.htmlspecialchars($color).'</li>';
            } 
        ?>
    </body>
</html>
