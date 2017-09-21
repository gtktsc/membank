<?php
ob_start();
session_start();
$header_html_1 = '<!DOCTYPE html>
<html>
      <head>
            <meta charset="UTF-8">
            <title>memBank</title>
            <link rel="shortcut icon" 
                  href="favicon.ico" />
            <meta name="description"
                  content="memBank zdeponuj swoje memy w bezpiecznym miejscu">
            <meta name="keywords" 
                  content="mem meme membank">
            <meta name="author" 
                  content="top kek general">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="src/style/main.css"
                  rel="stylesheet">  
                  
       
            <link href="https://fonts.googleapis.com/css?family=Roboto:100,300" 
                  rel="stylesheet">
            
      </head>
      <body>
            <header>
            <a href="index.php">
                  <svg viewBox="0 0 1000 400">
                        <path d="M962.900,260.582 C958.980,264.000 953.579,265.789 946.689,265.953 C936.152,266.277 928.316,
                              260.338 923.183,248.131 L904.338,210.289 L894.611,210.289 L894.611,264.488 L867.053,264.488 L867.053,
                              116.783 L855.097,116.783 L855.097,93.102 L894.611,93.102 L894.611,185.875 L905.756,185.875 L926.223,
                              142.906 L953.579,142.906 L927.438,197.105 L947.297,236.900 C949.456,241.783 952.227,244.145 955.605,
                              243.980 C958.575,243.820 961.279,242.760 963.710,240.807 L962.900,260.582 ZM839.697,264.000 L812.138,
                              264.000 L812.138,190.758 C812.407,183.273 811.328,177.414 808.896,173.180 C806.192,168.949 801.804,
                              166.752 795.725,166.588 C789.104,166.916 784.377,169.437 781.540,174.156 C778.431,179.203 777.012,
                              186.203 777.285,195.152 L777.285,264.000 L749.726,264.000 L749.726,167.320 L737.771,167.320 L737.771,
                              143.395 L766.140,143.395 L771.206,159.264 C777.959,147.709 788.699,141.686 803.425,141.197 C815.447,
                              141.197 824.632,145.187 830.983,153.160 C837.195,161.301 840.102,172.123 839.697,185.631 L839.697,
                              264.000 ZM711.833,265.221 C702.781,265.221 696.838,260.826 694.001,252.037 C687.786,260.990 678.601,
                              265.625 666.442,265.953 C655.633,265.789 646.989,262.291 640.505,255.455 C634.154,248.459 630.911,
                              238.529 630.778,225.670 C630.911,212.486 634.492,202.396 641.518,195.396 C648.541,188.561 658.065,
                              185.143 670.090,185.143 C678.059,185.307 684.949,186.607 690.759,189.049 L690.759,185.875 C691.028,
                              178.391 689.746,172.691 686.909,168.785 C683.667,164.719 677.923,162.602 669.685,162.437 C659.553,
                              162.437 649.554,165.367 639.694,171.227 L639.694,149.010 C649.554,143.803 661.038,141.117 674.143,
                              140.953 C690.081,140.793 701.834,145.023 709.401,153.648 C715.480,160.484 718.450,170.738 718.317,
                              184.410 L718.317,235.436 C718.317,240.318 719.938,242.760 723.181,242.760 C726.287,242.436 728.987,
                              241.379 731.286,239.586 L730.273,258.873 C725.679,262.779 719.533,264.893 711.833,265.221 ZM690.759,
                              223.229 L690.759,207.359 C686.975,205.570 682.178,204.594 676.372,204.430 C664.213,205.406 658.201,
                              211.998 658.337,224.205 C658.875,237.228 664.213,243.820 674.345,243.980 C679.614,243.820 683.667,
                              241.947 686.503,238.365 C689.340,234.787 690.759,229.820 690.759,223.473 L690.759,223.229 ZM594.709,
                              256.920 C586.198,261.967 574.714,264.324 560.261,264.000 L512.033,264.000 L512.033,131.187 L499.470,
                              131.187 L499.470,106.041 L558.842,106.041 C575.997,105.553 588.155,109.379 595.317,117.516 C601.801,
                              124.516 605.176,134.037 605.449,146.080 C604.907,161.869 599.097,172.691 588.022,178.551 C604.771,
                              183.434 613.215,196.373 613.352,217.369 C613.485,236.088 607.272,249.271 594.709,256.920 ZM576.269,
                              151.207 C576.402,145.187 574.851,140.221 571.608,136.314 C568.635,132.736 562.759,131.027 553.979,
                              131.187 L541.213,131.187 L541.213,172.203 L554.790,172.203 C563.028,172.367 568.771,170.578 572.014,
                              166.832 C574.984,163.578 576.402,158.371 576.269,151.207 ZM582.551,215.660 C582.551,207.848 580.930,
                              202.232 577.687,198.814 C574.173,194.584 567.556,192.551 557.829,192.711 L541.213,192.711 L541.213,
                              238.854 L557.626,238.854 C574.648,239.830 582.956,232.102 582.551,215.660 ZM482.448,264.000 L454.890,
                              264.000 L454.890,190.758 C455.295,183.434 454.282,177.574 451.850,173.180 C449.013,168.949 444.824,
                              166.752 439.287,166.588 C433.341,166.752 428.883,169.193 425.913,173.912 C422.940,178.635 421.521,
                              185.551 421.657,194.664 L421.657,264.000 L394.099,264.000 L394.099,190.758 C394.504,183.434 393.491,
                              177.574 391.059,173.180 C388.222,168.949 384.033,166.752 378.496,166.588 C372.549,166.752 368.091,
                              169.193 365.122,173.912 C362.148,178.635 360.730,185.551 360.866,194.664 L360.866,264.000 L333.308,
                              264.000 L333.308,167.320 L321.352,167.320 L321.352,143.395 L349.721,143.395 L354.787,159.264 C360.594,
                              148.033 371.131,142.014 386.398,141.197 C399.636,140.709 409.702,146.244 416.591,157.799 C422.670,
                              147.545 432.869,142.014 447.189,141.197 C460.969,141.361 470.828,146.488 476.774,156.578 C480.691,
                              162.926 482.581,172.691 482.448,185.875 L482.448,264.000 ZM298.049,214.195 L245.363,214.195 C247.795,
                              233.238 256.980,242.680 272.922,242.516 C285.349,242.191 296.428,238.205 306.154,230.553 L304.938,
                              253.258 C294.401,261.723 281.838,265.953 267.248,265.953 C251.037,265.789 238.676,260.094 230.166,
                              248.863 C221.788,237.797 217.532,222.740 217.399,203.697 C217.669,183.842 222.060,168.461 230.571,
                              157.555 C238.945,146.652 250.293,141.117 264.614,140.953 C278.662,141.281 289.807,146.324 298.049,
                              156.090 C306.287,165.855 310.476,179.123 310.612,195.885 C311.151,208.580 306.965,214.684 298.049,
                              214.195 ZM283.864,192.467 C283.459,173.588 277.041,163.902 264.614,163.414 C253.130,162.926 246.579,
                              173.424 244.958,194.908 L282.041,194.908 C283.389,194.908 283.997,194.096 283.864,192.467 ZM197.541,
                              264.000 L169.982,264.000 L169.982,190.758 C170.388,183.434 169.375,177.574 166.943,173.180 C164.106,
                              168.949 159.917,166.752 154.379,166.588 C148.433,166.752 143.975,169.193 141.005,173.912 C138.032,
                              178.635 136.614,185.551 136.750,194.664 L136.750,264.000 L109.191,264.000 L109.191,190.758 C109.597,
                              183.434 108.583,177.574 106.152,173.180 C103.315,168.949 99.126,166.752 93.588,166.588 C87.642,
                              166.752 83.184,169.193 80.214,173.912 C77.241,178.635 75.823,185.551 75.959,194.664 L75.959,
                              264.000 L48.400,264.000 L48.400,167.320 L36.445,167.320 L36.445,143.395 L64.814,143.395 L69.880,
                              159.264 C75.687,148.033 86.224,142.014 101.491,141.197 C114.729,140.709 124.794,146.244 131.684,
                              157.799 C137.763,147.545 147.961,142.014 162.282,141.197 C176.062,141.361 185.921,146.488 191.867,
                              156.578 C195.784,162.926 197.674,172.691 197.541,185.875 L197.541,264.000 Z" class="svg-text"/>
                  </svg>
            </a>
                  <nav>
                        <ul class = "menu">
                              <a href="index.php"><li>przegladaj</li></a>';

      if(isset($_SESSION["logged"]) && $_SESSION["logged"]==true && isset($_SESSION["userName"])){
            $header_html_1= $header_html_1.'<a href="add.php"><li>dodaj</li></a></ul>
            <div class = "user">
                  <span id = "user-menu-button">Konto</span>
                  <div id = "hidden-menu" class = "hidden">
                        <ul>
                              <a href="src/procedures/logout.php"><li>wyloguj</li></a>
                              <a href="ustawienia.php"><li>ustawienia</li></a>                              
                              <a href="autor.php?autor='.$_SESSION["userName"].'"><li>moje</li></a>                              
                        </ul>
                  </div>

            </div>
      </nav>

      <script src="src/script/header.js"></script>
      
      </header>';
      }else{
            $header_html_1= $header_html_1.'</ul>
            <div class = "user">
                  <span id = "user-menu-button">Konto</span>
                  <div id = "hidden-menu" class = "hidden">
                        <ul>
                              <a href="stworz.php"><li>stwórz</li></a>
                              <a href="zaloguj.php"><li>zaloguj</li></a>
                        </ul>
                  </div>

            </div>
      </nav>

      <script src="src/script/header.js"></script>
      
      </header>';
      }

      require_once "src/procedures/functions.php";      
    function renderHeader() {
        echo $GLOBALS['header_html_1'];
    }

?>       