<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$judul = $notes = $kategori =  "";
$judul_err = $notes_err = $kategori_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["no"]) && !empty($_POST["no"])){
    // Get hidden input value
    $no = $_POST["no"];
    
    // Validate name
    $input_judul = trim($_POST["judul"]);
    if(empty($input_judul)){
        $name_err = "Please enter a judul.";
    } elseif(!filter_var($input_judul, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $judul_err = "Please enter a valid judul.";
    } else{
        $judul = $input_judul;
    }
    
    // Validate address address
    $input_notes = trim($_POST["notes"]);
    if(empty($input_notes)){
        $notes_err = "Please enter an notes.";     
    } else{
        $notes = $input_notes;
    }

    $input_kategori = trim($_POST["kategori"]);
    if(empty($input_kategori)){
        $kategori_err = "Please enter an kategori.";     
    } else{
        $kategori = $input_kategori;
    }

    // Check input errors before inserting in database
    if (empty($judul_err) && empty($notes_err) && empty($kategori_err)) {
        // Prepare an update statement
        $sql = "UPDATE notes SET judul=?, notes=?, kategori=? WHERE no=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_judul, $param_notes, $param_kategori);
            
            // Set parameters
            $param_judul = $judul;
            $param_notes = $notes;
            $param_kategori = $kategori;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["no"]) && !empty(trim($_GET["no"]))){
        // Get URL parameter
        $no =  trim($_GET["no"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM notes WHERE no = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_no);
            
            // Set parameters
            $param_no = $no;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $judul = $row['judul'];
                $notes = $row['notes'];
                $kategori = $row['kategori'];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                            <label>Judul Buku</label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                            <span class="help-block"><?php echo $judul_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
                            <label>notes</label>
                            <input type="text" name="notes" class="form-control" value="<?php echo $notes; ?>">
                            <span class="help-block"><?php echo $notes_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($kategori_err)) ? 'has-error' : ''; ?>">
                            <label>Tahun Terbit</label>
                            <input type="text" name="kategori" class="form-control" value="<?php echo $kategori; ?>">
                            <span class="help-block"><?php echo $kategori_err;?></span>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>