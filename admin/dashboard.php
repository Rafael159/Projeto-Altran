<?php
    spl_autoload_register(function($classe) {
        require('../classes/'.$classe.'.class.php');	
    });
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Sistema de agendamento de consultas"/>		
        <meta name="keywords" content="sistema, agendamento, consultas, médico, consultório"/>
        
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/fonts.css">        
        <link rel="stylesheet" href="../css/app.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">  
		
		<!-- Fullcalendar -->
		<link href="../css/fullcalendar/fullcalendar.min.css" rel='stylesheet' />
		<link href="../css/fullcalendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />
		<link href="../css/fullcalendar/myfullcalendar.css" rel='stylesheet'/>

        <title>Dashboard Admin</title>
    </head>
    <body style="background:#ccc">
        <div class="container-fluid nopadding">
            <?php require_once('../require/header.php'); ?>

            <div class="row d-flex justify-content-center nopadding">
        		<div class='col-lg-10'>
                	<div id='calendar'><!--o calendário vem aqui--></div>
                </div>
            </div>
        </div>

        <script src="../js/jquery.js"></script>		
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/app.js" crossorigin="anonymous"></script>
        <!-- <script src="../js/jquery.mask.js" crossorigin="anonymous"></script> -->
		
		<script src="../fullcalendar/moment.min.js"></script>
		<script src="../fullcalendar/jqueryCalendar.min.js"></script>
		<script src="../fullcalendar/fullcalendar.min.js "></script>
		<script src="../fullcalendar/pt-br.js"></script>
		
		<!-- <script src="../fullcalendar/fullcalendar.min.js" crossorigin="anonymous"></script> -->
        <script src="../js/calendario.js" crossorigin="anonymous"></script>
    </body>
</html>