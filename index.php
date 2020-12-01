<!doctype html>
<html lang="en">
<?php
    include('process.php');
    $conn = OpenCon();
    echo "Connected Successfully";
    CloseCon($conn);
    ?>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </head>

  <body>
  <?php require_once 'process.php'; ?>
  <div class="container">
  <?php

     $dbhost = "localhost";
     $dbuser = "root";
     $dbpass = "";
     $db = "schooldb";
     $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
     $results = $conn->query("SELECT * FROM student") or die($conn->error);
     $resultt = $conn->query("SELECT * FROM teacher") or die($conn->error);
     $resultc = $conn->query("SELECT * FROM classes") or die($conn->error);
     $resultp = $conn->query("SELECT * FROM person") or die($conn->error);

     /*
     pre_r($resultc->fetch_assoc());
     pre_r($resultt->fetch_assoc());
     pre_r($results->fetch_assoc());
     pre_r($resultp->fetch_assoc());
     */
?>

<div class="column justify-content-center">
  <table class="table table-sm">
    <thead>
      <tr class="table-info">
        <th>Student ID</th>
        <th>Student class</th>
        <th>Student class ID</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>

  <?php while($row = $results->fetch_assoc()): ?>
  
    <tr>
      <td> <?php echo $row['ID'] ?> </td>
      <td> <?php echo $row['class'] ?> </td>
      <td> <?php echo $row['classID'] ?> </td>
      <td> 
        <a href="index.php?edit=<?php echo $row['ID'];?>"
           class="btn btn-info">Edit</a>
        <a href="process.php?delete=<?php echo $row['ID'];?>"
           class="btn btn-danger">Delete</a>
     </td>
    </tr>

<?php endwhile; ?> 

<thead>
      <tr class="table-info">
        <th>Teacher ID</th>
        <th>Teacher description</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>

  <?php while($row = $resultt->fetch_assoc()): ?>
  
  <tr>
    <td> <?php echo $row['ID'] ?> </td>
    <td> <?php echo $row['description'] ?> </td>
    <td> 
    <a href="index.php?editt=<?php echo $row['ID'];?>"
           class="btn btn-info">Edit</a>
        <a href="process.php?deletet=<?php echo $row['ID'];?>"
           class="btn btn-danger">Delete</a>
     </td>
  </tr>

<?php endwhile; ?> 

<thead>
      <tr class="table-info">
        <th>Class ID</th>
        <th>Class</th>
        <th>Class Teacher's ID</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>

  <?php while($row = $resultc->fetch_assoc()): ?>
  
  <tr>
    <td> <?php echo $row['classID'] ?> </td>
    <td> <?php echo $row['class'] ?> </td>
    <td> <?php echo $row['IDt'] ?> </td>
    <td> 
    <a href="index.php?editc=<?php echo $row['id'];?>"
           class="btn btn-info">Edit</a>
        <a href="process.php?deletec=<?php echo $row['classID'];?>"
           class="btn btn-danger">Delete</a>
     </td>
  </tr>

<?php endwhile; ?> 

<thead>
      <tr class="table-info">
        <th>First name</th>
        <th>Last name</th>
        <th>ID</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>

  <?php while($row = $resultp->fetch_assoc()): ?>
  
    <tr>
      <td> <?php echo $row['firstname'] ?> </td>
      <td> <?php echo $row['lastname'] ?> </td>
      <td> <?php echo $row['ID'] ?> </td>
      <td> 
      <a href="index.php?editp=<?php echo $row['id'];?>"
           class="btn btn-info">Edit</a>
        <a href="process.php?deletep=<?php echo $row['ID'];?>"
           class="btn btn-danger">Delete</a>
       </td>
    </tr>

<?php endwhile; ?> 

  </table>
</div>


<?php
     function pre_r($array){
       echo '<pre>';
       print_r($array);
       echo '<pre>';

     }

  ?>

  <div class="column justify-content-start">
    <form action="process.php" method="POST">
        <div class="form-group">
       <h3> <span class="badge badge-dark">Student</span></h3>
        <div class="col-sm-3">
        <input type="text" name="fnames" class="form-control"
          value="<?php echo $firstname ?>"  placeholder="Enter student's first name">
        <input type="text" name="lnames" class="form-control"
        value="<?php echo $lastname ?>" placeholder="Enter student's last name">
        <input type="int" name="IDs" class="form-control"
        value="<?php echo $ID ?>" placeholder="Enter student's ID">
        <input type="text" name="classnames" class="form-control" 
        value="<?php echo $class ?>"placeholder="Enter student's class">
        <input type="int" name="classID" 
        value="<?php echo $classID ?>"class="form-control" placeholder="Enter class ID">
        <?php
        if ($updates == true):
       ?>
        <button type="submit" class="btn btn-info" name="saves">Update</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="saves">Save</button>
        <?php endif; ?>
        </div>
        </div>
    </form>
</div>

<div class="column justify-content-center">
    <form action="process.php" method="POST">
        <div class="form-group">
        <h3> <span class="badge badge-dark">Teacher</span></h3>
        <div class="col-sm-3">
        <input type="text" name="fnamet" class="form-control"
        value="<?php echo $firstname ?>" placeholder="Enter teacher's first name">
        <input type="text" name="lnamet" class="form-control" 
        value="<?php echo $lastname ?>"placeholder="Enter teacher's last name">
        <input type="int" name="IDt" class="form-control"
        value="<?php echo $ID ?>" placeholder="Enter teacher's ID">
        <input type="text" name="description" class="form-control" 
        value="<?php echo $description ?>"placeholder="Enter teacher's description">
        <input type="int" name="ct" class="form-control"
        value="<?php echo $classID ?>" placeholder="Enter teacher's classes">
        <?php
        if ($updatet == true):
       ?>
        <button type="submit" class="btn btn-info" name="savet">Update</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="savet">Save</button>
        <?php endif; ?>
        </div>
        </div>
    </form>
</div>

<div class="column justify-content-center">
    <form action="process.php" method="POST">
       <div class="form-group">
       <h3> <span class="badge badge-dark">Class</span></h3>
        <div class="col-sm-3">
        <input type="text" name="classname" class="form-control" value="Enter class's name">
        <input type="int" name="classID" class="form-control" value="Enter class ID">
        <input type="int" name="IDt" class="form-control" value="Enter teacher's ID">
        <button type="submit" class="btn btn-primary" name="savec">Save</button>
        </div> 
        </div>
    </form>

  </div>
  </div>
  </body>
  
</html>