<!--
 | index.php
 |
 | Author:    Ryan M. Lederman <lederman@gmail.com>
 | Copyright: Copyright (c) 2024
 | Version:   0.0.1
 | License:   The MIT License (MIT)
 |
 | Permission is hereby granted, free of charge, to any person obtaining a copy of
 | this software and associated documentation files (the "Software"), to deal in
 | the Software without restriction, including without limitation the rights to
 | use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 | the Software, and to permit persons to whom the Software is furnished to do so,
 | subject to the following conditions:
 |
 | The above copyright notice and this permission notice shall be included in all
 | copies or substantial portions of the Software.
 |
 | THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 | IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 | FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 | COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 | IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 | CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 -->

<?php
    $pageTitle = "BimmerCode G8X Ambient Lighting Helper";
    $pageDesc  = "A web-based tool which makes customizing your BMW's ambient lighting colors using BimmerCode easier.";
    $instructions = "<b>Instructions:</b> Choose the desired color(s), then screenshot, print or write down the values listed at the bottom of the page. Finally, use BimmerCode to write the values to your BMW G8X<em>(carefully)</em>!";
?>

<!doctype html>
<html lang="en">
    <head>
        <title><?php echo($pageTitle);?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="author" content="Ryan M. Lederman <lederman@gmail.com>">

        <meta property="og:title" content="<?php echo($pageTitle);?>">
        <meta property="og:description" content="<?php echo($pageDesc);?>">
        <meta property="og:url" content="">
        <meta property="og:type" content="website">
        <meta property="og:image" content="">

        <!--<link rel="icon" href="favicon.png">
        <link rel="icon" href="favicon.ico" sizes="any">
        <link rel="icon" href="icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="manifest" href="icons.webmanifest">-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/colorjoe.css">
        <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
        <script type="text/javascript" src="js/colorjoe.min.js"></script>
        <script type="text/javascript">
            function onColorChange(rowNumber, color, ssBegin) {
                const tr      = $(`#resultRow${rowNumber}`);
                const hex     = color.hex();
                var colorText = hex.substr(ssBegin, 2);
                if (colorText === "ff") {
                    colorText = "fe";
                }
                tr.find("td.value").text(colorText);
                var colorTd = tr.find("td.color");
                if (colorTd) {
                    colorTd.css("background", color.css());
                }
            }
            /* initialize the color pickers. */
            $(() => {
                const joe1 = colorjoe.rgb('rgbPicker1', '#0066b2', [
                    'currentColor',
                    ['fields', {space: 'RGB', limit: 255, fix: 0}, 'dec']
                ]);
                joe1.on('change', color => {
                    onColorChange(1, color, 1);
                    onColorChange(2, color, 3);
                    onColorChange(3, color, 5);
                });
                joe1.update();
                const joe2 = colorjoe.rgb('rgbPicker2', '#013d78', [
                    'currentColor',
                    ['fields', {space: 'RGB', limit: 255, fix: 0}, 'dec']
                ]);
                joe2.on('change', color => {
                    onColorChange(4, color, 1);
                    onColorChange(5, color, 3);
                    onColorChange(6, color, 5);
                });
                joe2.update();
                const joe3 = colorjoe.rgb('rgbPicker3', '#e22719', [
                    'currentColor',
                    ['fields', {space: 'RGB', limit: 255, fix: 0}, 'dec']
                ]);
                joe3.on('change', color => {
                    onColorChange(7, color, 1);
                    onColorChange(8, color, 3);
                    onColorChange(9, color, 5);
                });
                joe3.update();
            });
        </script>
    </head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VTC7PMJ943"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-VTC7PMJ943');
    </script>
    <body>
        <div class="wrapper">
            <div class="title">
                <?php echo($pageTitle);?>
            </div>
            <div class="intro">
                <p><?php echo($instructions);?></p>
            </div>
            <div class="picker-container card">
                <h3>1. Doors &amp; Dash</h3>
                <div id="rgbPicker1"></div>
            </div>
            <div class="picker-container card">
                <h3>2. Footwells</h3>
                <div id="rgbPicker2"></div>
            </div>
            <div class="picker-container card">
                <h3>3. Map Light</h3>
                <div id="rgbPicker3"></div>
            </div>
            <div class="results card">
                <h3>
                    Results
                </h3>
                <table id="resultsTable">
                    <tr>
                        <th>Byte #</th>
                        <th>Value</th>
                        <th>Color</th>
                    </tr>
                    <tr id="resultRow1">
                        <td>18</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow2">
                        <td>19</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow3" class="separator">
                        <td>20</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow4">
                        <td>23</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow5">
                        <td>24</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow6" class="separator">
                        <td>25</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow7">
                        <td>28</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow8">
                        <td>29</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow9" class="separator">
                        <td>30</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                </table>
                <div class="steps">
                    <p>
                        Body Domain Controller (BDC_BODY3)&nbsp;&RightArrow;&nbsp;
                        360A/LIC_LCI_COLOR_LIBRARY_DATA&nbsp;&RightArrow;&nbsp;
                        360D/LIC_LCI_COLOR_PROFILES_DATA&nbsp;&RightArrow;&nbsp;
                        G20G21G26G28G80_Lichpacket_code1
                    </p>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>Copyright (&copy;) <?php echo(date("Y"));?> Ryan M. Lederman. <em>BimmerCode</em> is a copyright of SG Software GmbH & Co. KG, which is neither affiliated with nor endorses this website.<br/>Through your use of this website, you agree that you are doing so at your own risk, and additionally agree to all of the terms of the <a target="_blank" href="https://mit-license.org/">MIT License</a>.<br/>Utilizes the <a target="_blank" href="https://github.com/bebraw/colorjoe">colorjoe</a> JavaScript library.</p>
        </div>
    </body>
</html>
