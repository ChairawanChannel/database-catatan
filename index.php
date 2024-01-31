<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$judul = $notes = $kategori = "";
$judul_err = $notes_err = $kategori_err = "";

// Connect to the database
$link = mysqli_connect('localhost', 'root', '', 'db_notes');

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Judul
    $input_judul = trim($_POST["judul"]);
    if (empty($input_judul)) {
        $judul_err = "Masukkan Judul.";
    } else {
        $judul = $input_judul;
    }

    // Validate notes
    $input_notes = trim($_POST["notes"]);
    if (empty($input_notes)) {
        $notes_err = "Masukkan Nama notes.";
    } else {
        $notes = $input_notes;
    }

    // Validate Kategori
    $input_kategori = trim($_POST["kategori"]);
    if (empty($input_kategori)) {
        $kategori_err = "Masukkan Kategori.";
    } else {
        $kategori = $input_kategori;
    }

    // Check input errors before inserting into the database
    if (empty($judul_err) && empty($notes_err) && empty($kategori_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO notes (judul, notes, kategori) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_judul, $param_notes, $param_kategori);

            // Set parameters
            $param_judul = $judul;
            $param_notes = $notes;
            $param_kategori = $kategori;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to the landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.0.0-web/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Catatan Aplikasi</h1>
        <hr>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group mb-3">
                <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                    <span class="help-block">
                        <?php echo $judul_err; ?>
                    </span>
                </div>
                <div class="form-group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" id="" cols="20" rows="5" <?php echo $notes; ?>></textarea>
                    <span class="help-block">
                        <?php echo $notes_err; ?>
                    </span>
                </div>
                <div class="form-group <?php echo (!empty($kategori_err)) ? 'has-error' : ''; ?>">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?php echo $kategori; ?>">
                    <span class="help-block">
                        <?php echo $kategori_err; ?>
                    </span>
                </div>
                <div class="d-flex center-content-end p-3 text-center">
                    <input type="submit" class="btn btn-primary me-2" value="Submit">
                    <a href="update.php" class="btn btn-secondary me-2">Edit</a>
                    <a href="tampil.php" class="btn btn-success me-2">Tampil</a>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
        </form>
    </div>
</body>

</html>