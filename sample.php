    <html>
    <head>
        <title>
            Sample local page
        </title>
        <script>
            const sample="123"
            sample=456
            console.log(sample+45)
        </script>
    </head>
    <body>
        <p>PHP sample </p>
        <p>
            <?php
                print(phpversion())
            ?>
            
            <a href="https://apple.com">apple</a>
        </p>
        <hr />
        <form action="/output.php" method="post">
            <label for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname" value="John"><br>
            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname" value="Doe"><br><br>
            <input type="submit" value="Submit">
        </form> 
    </body>
</html>