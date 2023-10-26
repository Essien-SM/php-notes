<?php
setcookie("user", "", time() - 3600);
?>
<?php
session_start();
?>
<?php
$cookie_name = "user";
$cookie_value = "Abou";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .error {
            color: #FF0000;
        }
    </style>


</head>

<body>


    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["website"])) {
            $website = "";
        } else {
            $website = test_input($_POST["website"]);
            // check if URL address syntax is valid
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteErr = "Invalid URL";
            }
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>


    <div class="container">
        <div style="display: flex; flex-direction:column; margin-top:20px;">

            <h3>PHP OOP</h3>
            <h5>Class and object</h5>
            <h6>Using set and get methods</h6>
            <?php
            class Fruit
            {
                public $name;
                public $color;

                function setName($name)
                {
                    $this->name = $name;
                }
                function getName()
                {
                    return $this->name;
                }
            }

            $mango = new Fruit();
            $orange = new Fruit();

            $mango->setName("mango");
            $orange->setName("orange");

            echo $mango->getName() . "<br>";
            echo $orange->getName();
            ?>

            <h6>Using constructor function</h6>
            <?php
            class Car
            {
                public $name;
                public $color;

                function __construct($name)
                {
                    $this->name = $name;
                }

                function getName()
                {
                    return $this->name;
                }
            }

            $ben = new Car("Benz");
            echo $ben->getName();
            ?>

            <h6>Inheritance</h6>
            <?php
            class Fruits
            {
                public $name;
                public $color;

                function __construct($name, $color)
                {
                    $this->name = $name;
                    $this->color = $color;
                }

                function intro()
                {
                    echo "The fruit is {$this->name} and the color is {$this->color}.";
                }
            }

            class Strawberry extends Fruits
            {
                function message()
                {
                    echo "Am I a fruit or a berry? ";
                }
            }

            $strawberry = new Strawberry("Strawberry", "red");
            $strawberry->message();
            $strawberry->intro();
            ?>
            <h6>PHP class constant</h6>
            <?php
            class Byebye
            {
                const BYE = "Thank you for visiting w3School";
                public function mess()
                {
                    echo self::BYE;
                }
            }

            echo Byebye::BYE . "<br>";
            $x = new Byebye();
            $x->mess();
            ?>

            <h6>PHP abstract classes</h6>


            <?php

            abstract class ParentClass {
                abstract protected function prefix($name);
            }

            class ChildClass extends ParentClass{
                function prefix($name, $separator = ".", $greet = "Dear")
                {
                    if ($name == "John Doe"){
                        $prefix = "Mr";
                    } elseif($name == "Jane Doe"){
                        $prefix = "Mrs";
                    } else{
                        $prefix = "";
                    }

                    return "{$greet} {$prefix}{$separator} {$name}";
                }                
            }

            $class = new ChildClass();
            echo $class->prefix("John Doe");
            echo "<br>";
            echo $class->prefix("Jane Doe");
            
            ?>

            <?php
            echo "<br>";
            abstract class NewCar
            {
                public $name;
                function __construct($name)
                {
                    $this->name = $name;
                }
                abstract function intro(): string;
            }

            class Audi extends NewCar
            {
                function intro(): string
                {
                    return "Choose German quality! I'm an {$this->name}";
                }
            }

            class Benz extends NewCar
            {
                function intro(): string
                {
                    return "Proud to be Swedish! I'm a {$this->name}";
                }
            }

            class Toyota extends NewCar
            {
                function intro(): string
                {
                    return "French extravagance! I'm {$this->name}";
                }
            }

            $audi = new Audi("Audi");
            echo $audi->intro();
            echo "<br>";

            $benz = new Benz("Benz");
            echo $benz->intro();
            echo "<br>";

            $toyota = new Toyota("Toyota");
            echo $toyota->intro();

            ?>

            <h6>PHP interfaces</h6>
            <?php
            interface Animal
            {
                function makeSound();
            }

            class Cat implements Animal
            {
                function makeSound()
                {
                    echo "Cats make Meow sound" . "<br>";
                }
            }

            class Dog implements Animal
            {
                function makeSound()
                {
                    echo "Dogs Bark" . "<br>";
                }
            }

            class Mouse implements Animal
            {
                function makeSound()
                {
                    echo "Mouse Squeaks";
                }
            }

            $cat = new Cat();
            $dog = new Dog();
            $mouse = new Mouse();
            $animals = array($cat, $dog, $mouse);

            foreach ($animals as $animal) {
                $animal->makeSound();
            }


            ?>

            <h6>PHP trait</h6>

            <?php
            trait message1
            {
                function msg1()
                {
                    echo "OOP is fun! ";
                }
            }

            trait message2
            {
                function msg2()
                {
                    echo "OOP helps reduce code duplication";
                }
            }

            class Welcome
            {
                use message1;
            }

            class Welcome2
            {
                use message1, message2;
            }

            $obj = new Welcome();
            $obj->msg1();
            echo "<br>";

            $obj2 = new Welcome2();
            $obj2->msg1();
            $obj2->msg2();
            ?>
            <hr>
            <h3>PHP Exception</h3>
            <?php
            function divide($dividend, $divisor)
            {
                if ($divisor == 0) {
                    throw new Exception("Division by zero");
                }

                return $dividend / $divisor;
            }

            try {
                echo divide(4, 0);
            } catch (Exception $e) {
                $code = $e->getCode();
                $message = $e->getMessage();
                $file = $e->getFile();
                $line = $e->getLine();
                echo "Exception thrown in $file on line $line: [code $code] $message.";
            }

            ?>
            <hr>
            <h3>PHP and JSON</h3>
            <h5>PHP JSON encode</h5>
            <?php
            $age = array("Peter" => 34, "Ben" => 45, "Joe" => 50);
            echo json_encode($age) . "<br>";

            $car = array("Benz", "Sentra", "Toyota");
            echo json_encode($car);


            echo "<h5>PHP JSON decode</h5>";
            $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
            echo "<h6>PHP object</h6>";
            var_dump(json_decode($jsonobj));

            echo "<h6>PHP associative array</h6>";
            var_dump(json_decode($jsonobj, true));

            echo "<h6>PHP accessing decoded values from PHP objects</h6>";
            $obj = json_decode($jsonobj);
            echo "Peter is " . $obj->Peter;
            echo "<br>";
            echo "Ben is " . $obj->Ben;
            echo "<br>";
            echo "Joe is " . $obj->Joe;

            echo "<h6>PHP accessing decoded values from PHP associative array</h6>";
            $arr = json_decode($jsonobj, true);
            echo "Peter is " . $arr["Peter"];
            echo "<br>";
            echo "Ben is " . $arr["Ben"];
            echo "<br>";
            echo "Joe is " . $arr["Joe"];

            echo "<h6>PHP-Looping through the values from PHP objects</h6>";
            foreach ($obj as $key => $value) {
                echo $key . " is " . $value . "<br>";
            }
            echo "<h6>PHP-Looping through the values from PHP associative array</h6>";
            foreach ($arr as $key => $value) {
                echo $key . " is " . $value . "<br>";
            }
            ?>
            <hr>
            <h3>PHP callback</h3>
            <h5>My self with PHP callback</h5>

            <?php
            function name($str)
            {
                return "My name is " . $str . ".";
            }

            function age($str)
            {
                return "I am " . $str . " years old.";
            }

            function mySelf($str, $define)
            {
                echo $define($str);
            }

            mySelf("EMenS", "name");
            echo "<br>";
            mySelf("35", "age");
            ?>

            <hr>
            <h3>PHP session</h3>
            <a href="welcome.php">session</a>
            <?php
            $_SESSION["name"] = "Web";
            $_SESSION["author"] = "Essien";
            $_SESSION["date"] = "09/10/2023";
            echo "session is set!";
            ?>

            <hr>

            <h3>PHP cookie</h3>
            <?php
            echo "cookie is deleted";

            ?>

            <hr>

            <h3>PHP File handling</h3>
            <?php
            $file = fopen("web.txt", "r") or die("unable to open");
            while (!feof($file)) {
                echo fgets($file) . "<br>";
            }

            fclose($file);
            ?>

            <?php
            $myFile = fopen("newFile.txt", "w");

            $txt = "PHP is my preferred language because of it easy to learn \n";
            echo fwrite($myFile, $txt);

            $txt = "PHP is beginner friendly in the sense that beginners are able to learn and understand very well \n";
            echo fwrite($myFile, $txt);

            fclose($myFile);
            $myFile = fopen("newFile.txt", "a");

            $txt = "PHP  \n";
            echo fwrite($myFile, $txt);

            $txt = "PHP is beginner friendly \n";
            echo fwrite($myFile, $txt);

            fclose($myFile);
            ?>


            <h3 class="mt-3">file upload</h3>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
            <hr>

            <h2>PHP Form Validation Example</h2>
            <p><span class="error">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $name ?>">
                    <span class="error">* <?php echo $nameErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $email ?>">
                    <span class="error">* <?php echo $emailErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Website</label>
                    <input type="text" name="website" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $website ?>">
                    <span class="error"> <?php echo $websiteErr ?></span>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">comment</label>
                    <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $comment ?></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">
                    <label class="form-check-label">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">
                    <label class="form-check-label">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">
                    <label class="form-check-label">
                        Others
                    </label>
                    <span class="error">* <?php echo $genderErr ?></span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

        </div>
        </form>

        <div class="card" style="width: 18rem; margin-top:20px; margin-bottom: 20px;">
            <div class="card-body">
                <h5 class="card-title">Your input</h5>
                <p class="card-text"><?php echo $name; ?></p>
                <p class="card-text"><?php echo $email; ?></p>
                <p class="card-text"><?php echo $website; ?></p>
                <p class="card-text"><?php echo $comment; ?></p>
                <p class="card-text"><?php echo $gender; ?></p>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>