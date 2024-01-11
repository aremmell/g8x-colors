<!--
    index.php (https://github.com/aremmell/g8x-colors) v0.0.2
 -->

<?php
    const PAGE_TITLE = "BimmerCode G8X Ambient Lighting Helper";
    const PAGE_DESC  = "A web-based tool which makes customizing your G8X BMW's ambient lighting colors using BimmerCode easier.";
    const INSTRUCTIONS = "<b>Instructions:</b> Choose the desired color(s), then screenshot, print or write down the values listed at the bottom of the page. Finally, use <a target=\"_blank\" href=\"https://bimmercode.app/\">BimmerCode</a> to write the values to your BMW G8X<em>(carefully)</em>!";

    const COLOR_1_TITLE = "1. Doors &amp; Dash";
    const COLOR_2_TITLE = "2. Footwells";
    const COLOR_3_TITLE = "3. Map Light";

    const RESULTS_TITLE = "Results";
    const RESULTS_COL_1 = "Byte #";
    const RESULTS_COL_2 = "Value";
    const RESULTS_COL_3 = "Color";

    const STEP_SEPARATOR = "&nbsp;&RightArrow;&nbsp;</br>";

    const FOOTER_CONTENTS = "Copyright (&copy;) 2024 Ryan M. Lederman. <em>BimmerCode</em> is a copyright of SG Software GmbH & Co. KG, which is neither affiliated with nor endorses this website.<br/>Through your use of this website, you agree that you are doing so at your own risk, and additionally agree to all of the terms of the <a target=\"_blank\" href=\"https://github.com/aremmell/g8x-colors/blob/master/LICENSE\">MIT License</a>.<br/>Fork me on <a target=\"_blank\" href=\"https://github.com/aremmell/g8x-colors\">GitHub</a>.";

    $bimmerCodePath = array(
        0 => "Body Domain Controller (BDC_BODY3)",
        1 => "360A/LIC_LCI_COLOR_LIBRARY_DATA",
        2 => "360D/LIC_LCI_COLOR_PROFILES_DATA",
        3 => "G20G21G26G28G80_Lichpacket_code1"
    );

    function getCurrentURL(): string
    {
        return "https://" . $_SERVER['HTTP_HOST'] . "/";
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title><?php echo(PAGE_TITLE);?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <meta property="og:title" content="<?php echo(PAGE_TITLE);?>">
        <meta property="og:description" content="<?php echo(PAGE_DESC);?>">
        <meta property="og:url" content="<?php echo(getCurrentURL());?>">
        <meta property="og:type" content="website">

        <link rel="icon" href="img/favicon.png">
        <link rel="icon" href="img/favicon.svg" type="image/svg+xml">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/colorjoe.css">
        <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
        <script type="text/javascript" src="js/colorjoe.min.js"></script>
        <script type="text/javascript">
            function printResults() {
                var tmp = window.open('', '', 'width=370', 'height=370');
                tmp.document.write(`<html><head><link rel=\"stylesheet\" href=\"css/index.css\"></head><body><div class=\"results\">${$("div.results").html()}</div></body></html>`);
                tmp.document.close();
                tmp.print();
            }
            function onColorChange(rowNumber, color, ssBegin) {
                const tr = $(`#resultRow${rowNumber}`);
                const hex = color.hex();
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
                <?php echo(PAGE_TITLE);?>
            </div>
            <div class="intro">
                <p><?php echo(INSTRUCTIONS);?></p>
            </div>
            <div class="picker-container card">
                <h3><?php echo(COLOR_1_TITLE);?></h3>
                <div id="rgbPicker1"></div>
            </div>
            <div class="picker-container card">
                <h3><?php echo(COLOR_2_TITLE);?></h3>
                <div id="rgbPicker2"></div>
            </div>
            <div class="picker-container card">
                <h3><?php echo(COLOR_3_TITLE);?></h3>
                <div id="rgbPicker3"></div>
            </div>
            <div class="results card">
                <h3>
                <?php echo(RESULTS_TITLE);?>
                </h3>
                <table id="resultsTable">
                    <tr>
                        <th><?php echo(RESULTS_COL_1);?></th>
                        <th><?php echo(RESULTS_COL_2);?></th>
                        <th><?php echo(RESULTS_COL_3);?></th>
                    </tr>
                    <tr id="resultRow1">
                        <td class="byte">18</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow2">
                        <td class="byte">19</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow3" class="separator">
                        <td class="byte">20</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow4">
                        <td class="byte">23</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow5">
                        <td class="byte">24</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow6" class="separator">
                        <td class="byte">25</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow7">
                        <td class="byte">28</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow8">
                        <td class="byte">29</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                    <tr id="resultRow9" class="separator">
                        <td class="byte">30</td>
                        <td class="value">0</td>
                        <td class="color"></td>
                    </tr>
                </table>
                <div class="steps">
                    <p>
                        <?php
                            $stepCount = count($bimmerCodePath);
                            foreach ($bimmerCodePath as $key => $value) {
                                echo($value);
                                if ($key < $stepCount - 1) {
                                    echo(STEP_SEPARATOR);
                                }
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="button-container">
                <button type="button" onclick="printResults();">
                    Print Results
                </button>
            </div>
        </div>
        <div class="footer">
            <p><?php echo(FOOTER_CONTENTS);?></p>
        </div>
    </body>
</html>
