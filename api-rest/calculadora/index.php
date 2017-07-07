<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/calculator.js"></script>
    </head>
    <body>
        <div class=" cont" id="calculator">
	<!-- Screen and clear key -->
        <div class="c">
            <button class="btn-info button clear">C</button>
        </div>
            <div class="display">
                <input class="screen" type="text" value="0"  >
            </div>
                <div class="key">
                <button class="btn-info button numbers">7</button>
                <button class="btn-info button numbers">8</button>
		<button class="btn-info button numbers">9</button>
		<button class="btn-info button operator">+</button>
                <button class="btn-info button numbers">4</button>
		<button class="btn-info button numbers">5</button>
		<button class="btn-info button numbers">6</button>
		<button class="btn-info button operator">-</button>
		<button class="btn-info button numbers">1</button>
		<button class="btn-info button numbers">2</button>
		<button class="btn-info button numbers">3</button>
		<button class="btn-info button operator">÷</button>
		<button class="btn-info button numbers">0</button>
		<button class="btn-info button operator">.</button>
		<button class="btn-info button result">=</button>
		<button class="btn-info button operator">*</button>
                </div>
                <div class="session-info">
                    <div class="btn-save">
                    <input class="nameSession" type="text">
                    <button class=" btn btn-danger session">Guardar sesion</button>
                    <input class="nameSessionread" type="text">
                    <button class=" btn btn-danger readsession">Recuperar sesión</button>
                    </div>
            </div>
	</div>
       

           
           
        
        
        <?php
        // put your code here
        ?>
    </body>
</html>
