<head>
    <style>
        #detail-container
            {
                width: 104.5%;
                margin-left: -28px ;
                margin-top: -40px;
/*                padding:0px !important;
                position:absolute;*/
            }
    </style>
</head>    

<?php

$lvlroot = "../";
// Including Head.
include_once($lvlroot . "assets/php/dbq.php");

include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
//
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
// Including Php database.
// function defined in js/autocomplete.js

?> 
<div id="detail-container">
<?php

$pdf = file_get_contents('pdf.html');
echo $pdf;
?>
</div>    
<?php  // Including Js actions, put in the end.
    include_once($lvlroot . "Body/JsFoot.php");
    // Including End Header.
    include_once($lvlroot . "Body/EndPage.php");
?>
