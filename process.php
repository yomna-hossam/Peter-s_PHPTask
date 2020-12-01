<?php


    function OpenCon()
     {
     $dbhost = "localhost";
     $dbuser = "root";
     $dbpass = "";
     $db = "schooldb";
    // $conn = mysql;
     $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
     
     return $conn;
     }
     
    function CloseCon($conn)
     {
     $conn -> close();
     }
    
     $dbhost = "localhost";
     $dbuser = "root";
     $dbpass = "";
     $db = "schooldb";
     $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

     $updates = false;
     $updatet = false;


     $ID =  '';
     $class =  '';
     $classID = '';
     $description = '';
     $firstname =  '';
     $lastname = '';
     $IDt = '';
     $IDs = '';

     if (isset($_POST['saves'])){

        $fnames = $_POST['fnames'];
        $lnames = $_POST['lnames'];
        $IDs = $_POST['IDs'];
        $classnames = $_POST['classnames'];
        $classID = $_POST['classID'];

        $conn->query("INSERT INTO student (ID,class,classID) VALUES('$IDs','$classnames','$classID')") or die($conn->error);
        $conn->query("INSERT INTO person (firstname,ID,lastname,IDs,IDt) VALUES('$fnames','$IDs','$lnames','$IDs','')") or die($conn->error);

     }


     if (isset($_POST['savec'])){

        $classname = $_POST['classname'];
        $classID = $_POST['classID'];
        $IDt = $_POST['IDt'];

        $conn->query("INSERT INTO classes (classID,class,IDt) VALUES('$classID','$classname',$IDt)") or die($conn->error);

     }


     if (isset($_POST['savet'])){

        $fnamet = ($_POST['fnamet']);
        $lnamet = ($_POST['lnamet']);
        $IDt = ($_POST['IDt']);
        $description = ($_POST['description']);
        $ct = ($_POST['ct']);
        
        $conn->query("INSERT INTO teacher (ID,description) VALUES('$IDt','$description')") or die($conn->error);
        $conn->query("INSERT INTO teacher_classes (classes,IDt) VALUES('$ct','$IDt')") or die($conn->error);
        $conn->query("INSERT INTO person (firstname,ID,lastname,IDs,IDt) VALUES('$fnamet','$IDt','$lnamet','0','$IDt')") or die($conn->error);

     }


     if (isset($_GET['delete'])){ 

      $id = $_GET['delete'];
      echo $id;
      $conn->query("DELETE FROM student WHERE ID=$id") or die($conn->error);

   }

   if (isset($_GET['deletet'])){ 

      $id = $_GET['deletet'];
      echo $id;
      $conn->query("DELETE FROM teacher WHERE ID=$id") or die($conn->error);

   }

   if (isset($_GET['deletec'])){ 

      $id = $_GET['deletec'];
      echo $id;
      $conn->query("DELETE FROM classes WHERE classID=$id") or die($conn->error);

   }

   if (isset($_GET['deletep'])){ 

      $id = $_GET['deletep'];
      echo $id;
      $conn->query("DELETE FROM person WHERE ID=$id") or die($conn->error);

   }



   if (isset($_GET['edit'])){ 
      $id = $_GET['edit'];
      echo $id;
      $updates = true;

      $resultp = $conn->query("SELECT * FROM person WHERE ID=$id") or die($conn->error);
      $results = $conn->query("SELECT * FROM student WHERE ID=$id") or die($conn->error);
         $row = $results->fetch_array();
         $rowp = $resultp->fetch_array();

         $ID =  $row['ID'];
         $class =  $row['class'];
         $classID =  $row['classID'];
         $firstname = $rowp['firstname'];
         $lastname = $rowp['lastname'];
         }

         if (isset($_GET['editt'])){ 
            $id = $_GET['editt'];
            echo $id;
            $updatet = true;

            $resultt = $conn->query("SELECT * FROM teacher WHERE ID=$id") or die($conn->error);
               $row = $resultt->fetch_array();
               $ID =  $row['ID'];
               $description =  $row['description'];
               }

               if (isset($_GET['editc'])){ 
                  $id = $_GET['editc'];
                  echo $id;
                  $resultc = $conn->query("SELECT * FROM classes WHERE ID=$id") or die($conn->error);
                     $row = $resultc->fetch_array();
                     $IDt =  $row['IDt'];
                     $class =  $row['class'];
                     $classID =  $row['classID'];
                     }

                     if (isset($_GET['editp'])){ 
                        $id = $_GET['editp'];
                        echo $id;
                        $resultp = $conn->query("SELECT * FROM person WHERE ID=$id") or die($conn->error);
                           $row = $resultp->fetch_array();
                           $ID =  $row['ID'];
                           $firstname =  $row['firstname'];
                           $lastname =  $row['lastname'];
                           }

    ?>