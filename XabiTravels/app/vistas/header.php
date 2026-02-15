<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title><?php echo $page_title ?? 'Xabi Travels - Viaja más lejos'; ?></title>
    
    <link rel="stylesheet" href="../assets/css/styles.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;800&display=swap" rel="stylesheet">
    <?php echo $additional_css ?? ''; ?>
</head>
<body>
    <div class="main_wrapper">
        
        <header class="header-image-container">
            <a href="../public/index.php">
            <img src="../assets/img/bannerxabitravels.png" alt="Cabecera Xabi Travels" class="header-img">
            </a>
        </header>