<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        footer {
            height: auto;
        }

        .grid-2 .insideBadgesType {
            opacity: 1;
        }



        .grid-2 .insideBadgesType {
            transform: translateX(0);
        }

        .grid-2 .inner-card {
            background: #FAFAFA;
            border-radius: 10px 10px 0 0;
            align-content: center;
            border-bottom: 1px solid #004156;
            padding: 20px 10px;
            position: relative;
            border: 1px solid #5555553d;
            border-bottom: 0;
        }

        .grid-2 .badges-column {
            cursor: pointer;
            background: none;
        }

        .grid-2 .badges-column:hover .insideBadgesType {
            transform: translateX(0);

        }

        .grid-2 .upperHeading {
            clip-path: polygon(100% 0, 100% 63%, 52% 100%, 0 65%, 0 0);
            position: relative;
            width: 104%;
            padding: 5px;
            color: #FFF;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            align-items: center;
            justify-content: center;
            text-shadow: 0 0 20px white;
            left: 2px;
            background: #00AEEF;
        }

        .grid-2 .upperHeading .text-center {
            font-style: italic;
            font-weight: revert;
            font-size: 13px;
        }

        .grid-2 .upperHeading .afterClip {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #00AEEF;
            /* clip-path: polygon(100% 0, 100% 63%, 52% 100%, 0 65%, 0 0); */
            z-index: 1;
        }

        /* .grid-2 .hot .afterClip {
            background: #FD362F;
        }

        .grid-2 .green .afterClip {
            background: #67C067;
        }

        .grid-2 .yellow .afterClip {
            background: #DDAD1A;
        } */

        .grid-2 .upperHeading p {
            z-index: 100;
            margin-bottom: 5px;
        }

        .grid-2 .afterBadgeHover {
            background: #004156;
            display: flex;
            align-content: center;
            justify-content: space-around;
            flex-direction: column;
        }

        .grid-2 li {
            list-style: none;
            position: relative;
            padding: 0 0 0 20px;
        }

        .grid-2 i.fa.fa-check {
            position: absolute;
            left: 0;
            top: 5px;
        }

        .grid-2 .innerContext ul {
            padding: 10px;
            color: #FFF;
            line-height: 22px;
            font-size: 11px;
            font-family: monospace;
            overflow-y: scroll;
            min-height: 110px;
            scrollbar-width: none;
        }

        .grid-2 .badgesType {
            background: url(/images/badgesGreyBg.svg);
            background-position-x: 0%;
            background-position-y: 0%;
            background-repeat: repeat;
            background-size: auto;
            width: 80px;
            height: 80px;
            background-size: cover;
            background-position: center;
            cursor: pointer;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .grid-2 .innerType {
            background: #004156;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            /* top: -30px;
            left: 40px; */
            padding: 5px 10px;
            font-size: 11px;
            width: 100px;
            border: 1px solid #8e8e8e;
        }

        .grid-2 .BadgesActionBtn .card {
            display: flex;
            align-content: center;
            justify-content: space-between;
        }

        .AssignBtn {
            background: #317DEE;
            padding: 6px 20px;
            color: #FFF;
            border-radius: 5px;
            align-content: baseline;
        }

        .grid-2 .BadgesActionBtn .card a {
            text-decoration: none;
        }

        .x_content a:focus,
        a:hover {
            color: #eee;
            text-decoration: none;
        }

        .grid-2 .BadgesActionBtn .card .EditBtn {
            background: #EAECFE;
            padding: 4px 20px;
            color: #337AB7;
            border-radius: 3px;
            border: 1px solid #337AB7;
            align-content: baseline;
        }

        .x_content h4 {
            font-size: 16px;
            font-weight: 500;
            position: absolute;
            height: 12%;
            background: #004156;
            top: -10px;
            left: 0;
            color: #fff;
            padding: 9px;
            border-top-left-radius: 6px;

        }

        .grid-2 .thinBorder {
            border: 1px solid #5555553d;
            padding: 15px;
            border-top: 1px solid #004156;
            border-radius: 2px 4px 5px 5px;
        }

        .x_title .flex {
            display: flex;
            align-content: center;
            justify-content: space-between;
        }

        .row.grid-2 {
            display: grid;
            display: grid;
            grid-template-columns: 32% 32% 32%;
            gap: 20px;
        }

        .row.grid-2:before {
            display: none;
        }

        #BadgesModal label {
            font-weight: 400;
        }

        .second .upperHeading {
            background: #FD362F;
        }

        .third .upperHeading {
            background: #67C067;
        }

        .fourth .upperHeading {
            background: #DDAD1A;
        }

        .fifth .upperHeading {
            background: #1EAFC6;
        }

        .ActiveProductBadge .inner-card {
            background: none;
        }

        .ActiveProductBadge {
            background: #FFF;
            border: 2px solid #0F6FFF;
            border-radius: 10px;
        }

        .itemList {
            position: absolute;
            left: 0px;
            font-size: 11px;
            height: 105px;
            background: rgb(255, 255, 255);
            overflow: scroll;
            scrollbar-width: none;
        }

        .itemList label {
            cursor: pointer;
            font-family: sans-serif;

        }

        .itemList input {
            margin: 0 5px 0 0;
        }

        /* Add this CSS for link animation */
        .AssignBtn,
        .EditBtn {
            transition: transform 0.1s ease;
            display: inline-block;
            /* Ensures link behaves like a block element */
        }

        .AssignBtn:active,
        .EditBtn:active {
            transform: translateY(5px);
            /* Adjust the Y translation as per your preference */
        }

        .ColorPalletBox {
            padding: 0 !important;
            border: none !important;
            width: 35px !important;
            height: 35px !important;
            cursor: pointer;
        }

        .ColorPalletBox:active {
            transform: translateY(10px);
        }

        .badgesType.mainFlowerBadges {
            margin-bottom: 10px;
        }


        .submitbutton {
            background: #5CB85C;
            color: #fff;
            border: none;
            padding: 6px 19px;
        }

        .disabled {
            background: grey;
            color: #fff;
            border: none;
            cursor: not-allowed;
            padding: 6px 19px;
        }

        .SwithToDefaultBtn:active {
            transform: translateY(10px);
        }

        .SwithToDefaultBtn {
            font-family: sans-serif;
            background: #f2f5ff;
            border: none;
            color: #337ab7;
            padding: 5px 16px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 4px;
            border: 1px solid #337ab7;
        }



        @media screen and (max-width:1500px) {
            .row.grid-2 {
                grid-template-columns: 49% 49%;
            }
        }

        @media screen and (max-width:520px) {
            .row.grid-2 {
                grid-template-columns: auto auto;
                gap: 20px 10px;

            }

            .x_panel .previewDisplay {
                width: 100%;
            }

            .col-md-12.BadgesActionBtn {
                width: 100%;
            }



            .grid-2 .BadgesActionBtn .card a {
                padding: 3px 5px;
                font-size: 11px;
            }

            .x_title .flex {

                flex-direction: column;
            }

            .grid-2 .BadgesActionBtn .card .EditBtn {
                padding: 3px 5px;
                font-size: 11px;
            }

            .grid-2 .thinBorder {
                padding: 5px 0;
            }

            .x_content h4 {
                font-size: 13px;
                height: 35px;
            }

            .col-lg-6.col-md-12.previewDisplay.right-side {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title" style="position:relative;">
                <div class="row">
                    <div class="flex">
                        <h2> All Assign Badges </h2>
                        <a href="#" data-toggle="modal" data-target="#BadgesModal" data-whatever="@mdo" onclick="badgepopup()" class="btn btn-primary add-new-btn">Add New Badge</a>
                    </div>
                </div>
            </div>

            <div class="x_content">
                <div class="row grid-2">
                    <?php foreach ($badge as $key => $badges) {
                    ?>
                        <div class="col-md-12 customWidth selectmodle<?php echo $badges['id']; ?> ">
                            <form class="productassign<?php echo $badges['id']; ?>" action="">
                                <div class="row inner-card">
                                    <div class="totalBadgesNo">
                                        <h4><?php echo $badges['id']; ?></h4>
                                    </div>
                                    <div class="col-lg-6 col-md-12 previewDisplay left-side">
                                        <div class="card defaultBadges">
                                            <div class="badgesType mainFlowerBadges">
                                                <p class=" defaultItems defaultBG<?php echo $badges['id']; ?>  customByPallet" id="defaultBadge<?php echo $badges['id'] ?>" style="background-color: <?php echo $badges['badge_color'] ?>;" style="background-color: <?php echo $badges['badge_color'] ?>;"><?php echo $badges['title'] ?>
                                                    <span class="before customByPallet " style="background-color: <?php echo $badges['badge_color'] ?>;"></span>
                                                    <span class="after customByPallet" style="background-color: <?php echo $badges['badge_color'] ?>;"></span>
                                                </p>

                                            </div>
                                            <div class="itemList itemList<?php echo $badges['id']; ?>" style="display:none;">
                                                <?php foreach ($pro as $pros) { ?>
                                                    <?php
                                                    $query = "SELECT * FROM tbl_badges_products WHERE badges_id = " . $badges['id'] . " AND pro_id =  " . $pros["prod_id"] . "";
                                                    $result = Yii::app()->db->createCommand($query)->queryAll();
                                                    ?>
                                                    <?php if (empty($result)) { ?>
                                                        <input type="hidden" name="product[<?php echo $pros["prod_id"]; ?>]" value="unchecked">
                                                    <?php } ?>
                                                    <label>
                                                        <input type="checkbox" name="product[<?php echo $pros["prod_id"]; ?>]" <?php if (!empty($result)) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                                        <?php echo $pros["prod_name"]; ?>
                                                    </label>

                                                    <br>
                                                <?php } ?>
                                                <input type="hidden" name="bageid" value="<?php echo $badges['id']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 previewDisplay right-side">
                                        <div class="afterBadgeHover">
                                            <div class=" defaultBG<?php echo $badges['id'] ?> upperHeading customByPallet" style="background-color: <?php echo $badges['badge_color'] ?>;">
                                                <p class="innerType"><?php echo $badges['highlight_title'] ?></p>
                                                <p class="text-center"><?php echo $badges['badge_title'] ?></p>
                                                <div class="customByPallet  "></div>
                                            </div>
                                            <textarea name="desname" id='<?php echo 'desname' . $badges['id'] ?>' style="display:none;"><?php echo $badges['description'] ?></textarea>
                                            <div class="innerContext">
                                                <?php
                                                $string = $badges['description'];
                                                $lines = explode("\n", $string);
                                                $lines = array_filter($lines, 'strlen');
                                                ?>
                                                <ul>
                                                    <?php foreach ($lines as $key => $line) { ?>
                                                        <li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $line; ?> </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                </div>
                                <div class="row thinBorder">
                                    <div class="col-md-12 BadgesActionBtn">
                                        <div class="card">
                                            <div>

                                                <a href="#" data-toggle="modal" data-target="#BadgesModaledit" class="EditBtn" onclick="badgepopupedit('<?php echo $badges['id']; ?>','<?php echo $badges['title'] ?>','<?php echo $badges['badge_color'] ?>','<?php echo $badges['highlight_title'] ?>','<?php echo $badges['badge_title'] ?>')" data-whatever="@mdo">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                            </div>
                                            <div>
                                                <!-- <a href="#" class="AssignBtn addasign<?php echo $badges['id']; ?>">Assign Badge</a> -->
                                                <button type="submit" class="submitbutton disabled  submitbadges<?php echo $badges['id']; ?>">Assign Badge</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $(".selectmodle<?php echo $badges['id']; ?>").click(function() {

                                    $(".customWidth").removeClass("ActiveProductBadge");
                                    $(".selectmodle<?php echo $badges['id']; ?>").toggleClass("ActiveProductBadge");
                                    $(".itemList").hide();
                                    $(".submitbutton").addClass("disabled")
                                    $(".itemList<?php echo $badges['id']; ?>").toggle();
                                    $(".submitbadges<?php echo $badges['id']; ?>").removeClass("disabled")


                                });
                            });

                            // $(document).ready(function() {
                            //     $(".addasign<?php echo $badges['id']; ?>").click(function() {
                            //         $(".itemList<?php echo $badges['id']; ?>").toggle();
                            //     });
                            // });

                            // $(document).ready(function() {
                            //     $(".submitbadges<?php echo $badges['id']; ?>").click(function() {
                            //         $(".itemList<?php echo $badges['id']; ?>").toggle();
                            //     });
                            // });

                            // $(document).ready(function() {
                            //     $(".addasign<?php echo $badges['id']; ?>").click(function() {
                            //         $(".addasign<?php echo $badges['id']; ?>").hide();
                            //         $(".submitbadges<?php echo $badges['id']; ?>").show();                                    
                            //     });
                            // });



                            $(document).ready(function() {
                                // Handle checkbox changes
                                $('input[type="checkbox"]').change(function() {
                                    var productId = $(this).attr('name').match(/\d+/)[0];
                                    if ($(this).is(':checked')) {
                                        $(this).next('input[type="hidden"]').remove();
                                    } else {
                                        $(this).after('<input type="hidden" name="product[' + productId + ']" value="unchecked">');
                                    }
                                });

                                // Handle form submission
                                $('.productassign<?php echo $badges['id']; ?>').submit(function(event) {
                                    event.preventDefault(); // Prevent the default form submission

                                    // Serialize form data
                                    var formData = $(this).serialize();

                                    // Send AJAX request
                                    $.ajax({
                                        type: 'POST',
                                        url: 'managebadges/addproductbadge', // Replace with your PHP file handling the form submission
                                        data: formData,
                                        success: function(response) {

                                            // Handle success response
                                            console.log(response); // Log the response to the console
                                        },
                                        error: function(xhr, status, error) {
                                            // Handle errors
                                            console.error(error); // Log the error to the console
                                        }
                                    });
                                });
                            });
                        </script>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div id="invpopm"></div>



        <!-- Modal Badges Custom color  -->
        <!-- <script>
                document.getElementById('BadgesStatus').addEventListener('change', function() {
                    var selectedValue = this.value;
                    var defaultBadge = document.getElementById('defaultBadge');
                    var badgeContainer = document.getElementById('badgeContainer');
                    var innerType = document.querySelector('.innerType');
                    var itemsTitle = document.querySelector('#defaultBadge');

                    defaultBadge.classList.remove('hotBG', 'newBG', 'newBG2', 'newBG3', 'newBG4');
                    badgeContainer.classList.remove('hotBG', 'newBG', 'newBG2', 'newBG3', 'newBG4');

                    switch (selectedValue) {
                        case 'hot':
                            defaultBadge.classList.add('hotBG');
                            badgeContainer.classList.add('hotBG');
                            innerType.textContent = 'HOT Items';
                            itemsTitle.innerHTML = 'Hot Item<span class="before customByPallet"></span><span class="after customByPallet"></span>';
                            break;
                        case 'new':
                            defaultBadge.classList.add('newBG');
                            badgeContainer.classList.add('newBG');
                            innerType.textContent = 'NEW Arrivals';
                            itemsTitle.innerHTML = '  Arrivals<span class="before customByPallet"></span><span class="after customByPallet"></span>';
                            break;
                        case 'new2':
                            defaultBadge.classList.add('newBG2');
                            badgeContainer.classList.add('newBG2');
                            innerType.textContent = 'Special Offer ';
                            itemsTitle.innerHTML = 'Special<span class="before customByPallet"></span><span class="after customByPallet"></span>';
                            break;
                        case 'new3':
                            defaultBadge.classList.add('newBG3');
                            badgeContainer.classList.add('newBG3');
                            innerType.textContent = 'NEW 3 Stock';
                            itemsTitle.innerHTML = 'Limited<span class="before customByPallet"></span><span class="after customByPallet"></span>';
                            break;
                        case 'new4':
                            defaultBadge.classList.add('newBG4');
                            badgeContainer.classList.add('newBG4');
                            innerType.textContent = 'NEW 4 Items';
                            itemsTitle.innerHTML = 'Exclusive<span class="before customByPallet"></span><span class="after customByPallet"></span>';
                            break;
                        default:
                            defaultBadge.classList.add('newBG');
                            badgeContainer.classList.add('newBG');
                            innerType.textContent = 'NEW';
                            itemsTitle.innerHTML = 'Select Badges<span class="before customByPallet"></span><span class="after customByPallet"></span>';
                    }
                });
            </script> -->
        <!-- Modal Badges Custom color  -->




        <!-- Textarea Limitation  -->
        <script>
            // $(document).ready(function() {
            //     var maxLength = 25; // Maximum character limit
            //     var maxLines = 4; // Maximum number of lines
            //     var descriptionTextarea = $("#description");
            //     var descriptionList = $("#descriptionList");

            //     // Check if textarea is empty when the page loads
            //     if (descriptionTextarea.val().trim() === "") {
            //         descriptionTextarea.val("Save Upto $28"); // Add default line
            //     }

            //     descriptionTextarea.on("input", function() {
            //         var lines = $(this).val().split("\n").filter(line => line.trim() !== ""); // Filter empty lines

            //         // Check if number of lines exceeds the limit
            //         if (lines.length > maxLines) {
            //             // Display popup or error message here
            //             alert("You can only write up to " + maxLines + " lines.");

            //             // Trim lines to maximum allowed
            //             lines = lines.slice(0, maxLines);

            //             // Update textarea value with trimmed lines
            //             $(this).val(lines.join("\n"));
            //         }

            //         // Format the list for display
            //         var formattedList = lines.map(line => {
            //             if (line.length > maxLength) {
            //                 line = line.slice(0, maxLength);
            //             }
            //             return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
            //         }).join("");

            //         // Update the description list
            //         descriptionList.html(formattedList);
            //     });
            // });
        </script>
        <!-- Textarea Limitation  -->

        <!-- Modal Badges Add description  -->

        <!-- color Picker -->
        <!-- <script>
                $(document).ready(function() {
                    const colors = ['#FFBABA', '#94FF94', '#C7C7FF', '#FFFF8F', '#FFA6FF', '#00FFFF', '#D10100', '#BFBFBF', '#FFFFFF', '#7959D4', '#7ED552', '#75BAF5', '#F9C390', '#FCD75F', '#ABA5A5', '#FF9F9E', '#FF840D', '#AD90FF', '#50A7F2', '#FF7675'];
                    const colorPalette = $('#colorPalette');
                    const targetDiv = $('.customByPallet');
                    const resetButton = $('#resetButton');
                    const resetBadgesBtn = $('.ResetBAdgesBtn');
                    let defaultColor = '#00AEEF'; // Set default color
                    colors.forEach(color => {
                        const colorBox = $('<div>').addClass('colorBox').css('background-color', color);
                        colorBox.click(function() {
                            targetDiv.css('background-color', color);
                            targetDiv.find('span').css('background-color', color); // change span color

                            // Change background color of .defaultBG class
                            $('.defaultBG').css('background-color', color);
                        });
                        colorPalette.append(colorBox);
                    });

                    function resetForm() {
                        targetDiv.css('background-color', defaultColor);
                        targetDiv.find('span').css('background-color', defaultColor); // reset span color

                        // Reset input values
                        $('#BadgesStatus').val(''); // Clear input value
                        $('.BadgesHighlights').val(''); // Clear input value
                        $('#BadgesTitle').val(''); // Clear input value
                        $('#description').val('Save Upto $28'); // Reset textarea value

                        // Reset content of div elements
                        $('.defaultBadges .defaultItems').css('background-color', defaultColor);
                        $('.defaultBadges .defaultItems').html('New Item<span class="before customByPallet"></span><span class="after customByPallet"></span>');
                        $('.insideBadgesType #demo').text('NEW');
                        $('.insideBadgesType #badgeDescription').text('Close out Special');
                    }

                    resetButton.click(resetForm);
                    resetBadgesBtn.click(resetForm);

                    const closeColorPaletteButton = $('#closeColorPaletteButton');
                    const openColorPaletteButton = $('#openColorPaletteButton');

                    function showColorPalette() {
                        colorPalette.css('display', 'grid');
                        colorPalette.css('grid-template-columns', 'repeat(10, 1fr)');
                    }

                    function hideColorPalette() {
                        colorPalette.css('display', 'none');
                    }

                    openColorPaletteButton.click(function(event) {
                        event.preventDefault();
                        if (colorPalette.css('display') === 'grid') {
                            hideColorPalette();
                        } else {
                            showColorPalette();
                        }
                    });

                    closeColorPaletteButton.click(function() {
                        hideColorPalette();
                    });

                    openColorPaletteButton.attr('title', 'Select Color');

                    $(document).click(function(event) {
                        const isClickInsideColorPalette = colorPalette.get(0).contains(event.target);
                        const isClickOnOpenButton = openColorPaletteButton.get(0).contains(event.target);
                        if (!isClickInsideColorPalette && !isClickOnOpenButton) {
                            hideColorPalette();
                        }
                    });
                });
            </script> -->
        <!-- color Picker -->



        <!-- For Real Time Updation  -->
        <script>
            // $(document).ready(function() {
            //     // Event listener for the input element with ID "BadgesTitle"
            //     $('#BadgesTitle').on('input', function() {
            //         // Get the value of the input
            //         var inputText = $(this).val();

            //         // Update the text content of the element with ID "badgeDescription"
            //         $('#badgeDescription').text(inputText);
            //     });
            // });
            // $(document).ready(function() {
            //     // Event listener for the input element with ID "BadgesTitle"
            //     $('.BadgesHighlights').on('input', function() {
            //         // Get the value of the input
            //         var inputText = $(this).val();

            //         // Update the text content of the element with ID "badgeDescription"
            //         $('#demo').text(inputText);
            //     });
            // });
            // $(document).ready(function() {
            //     // Event listener for the input element with ID "BadgesStatus"
            //     $('#BadgesStatus').on('input', function() {
            //         // Get the value of the input
            //         var inputText = $(this).val();

            //         // Update the text content of the p tag inside the .badgesType div
            //         var pTag = $('.badgesType #defaultBadge');
            //         var existingBeforeSpan = pTag.find('.before').prop('outerHTML');
            //         var existingAfterSpan = pTag.find('.after').prop('outerHTML');
            //         pTag.html(inputText + existingBeforeSpan + existingAfterSpan);
            //     });
            // });
        </script>
        <!-- For Real Time Updation  -->

        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     // Get the input element
            //     const badgeInput = document.getElementById('badgeInput');

            //     // Get the paragraph element where you want to update the badge name
            //     const badgeParagraph = document.getElementById('defaultBadge');

            //     // Get the reset button
            //     const resetButton = document.getElementById('resetButton');

            //     // Function to reset badge name to default
            //     function resetBadgeName() {
            //         badgeInput.value = ''; // Clear the input field
            //         badgeParagraph.firstChild.textContent = 'New Item'; // Set default badge name
            //     }

            //     // Add an event listener to the input element to update the badge name on input change
            //     badgeInput.addEventListener('input', function() {
            //         badgeParagraph.firstChild.textContent = this.value.trim() || 'New Item'; // Update the text content of the first child node (text node) of the paragraph element
            //     });

            //     // Add event listener to the reset button
            //     resetButton.addEventListener('click', resetBadgeName);
            // });
        </script>

        <script>
            // Add event listener for Add New Badge button
            // document.querySelector('.add-new-btn').addEventListener('click', function() {
            //     // Hide select element
            //     document.querySelector('.BadgesStatus').style.display = 'none';
            //     // Show input element
            //     document.querySelector('.Add-Badge').style.display = 'block';
            // });

            // // Add event listener for Edit button
            // document.querySelector('.EditBtn').addEventListener('click', function() {
            //     // Hide input element
            //     document.querySelector('.Add-Badge').style.display = 'none';
            //     // Show select element
            //     document.querySelector('.BadgesStatus').style.display = 'block';
            // });
        </script>
        <script>
            function badgepopupedit(id, title, badge_color, highlight_title, badge_title) {
                var description = document.getElementById("desname" + id + "").value;
                var lines = description.split("\n").filter(line => line.trim() !== "");
                var formattedDescription = lines.map(line => {
                    return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
                }).join("");

                var modalHtml = '';
                var modalHtml = `
                <div class="modal fade" id="BadgesModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="managebadges/Additembadge" method="post" class="edititembadegs">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body myDivClass"id="myDiv"  >
                                <div class="ProductName">
                                <h5 class="ProductTitle">Big Hit Pro Tempo Deluxe</h5>
                                </div>
                                <div class="col-lg-6 col-md-6 previewDisplay left-side">
                                <div class="card defaultBadges">
                                    <div class="badgesType">
                                        <p class="defaultItems defaultBG${id} customByPallet" id="defaultBadge${id}" style="background-color:${badge_color}">${title}
                                            <span class="before customByPallet" style="background-color:${badge_color}"></span>
                                            <span class="after customByPallet" style="background-color:${badge_color}"></span>
                                        </p>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6 col-md-6 previewDisplay badges-column right-side" id="myDiv" class="myDivClass">
                                <div class="card" >
                                    <div class="insideBadgesType">
                                        <div class="defaultBG${id} upperHeading customByPallet" id="badgeContainer" style="background-color:${badge_color}">
                                            <p class="innerType" id="demo${id}">${highlight_title}</p>
                                            <p class="text-center" id="badgeDescription${id}">${badge_title}</p>
                                        </div>
                                        <div class="innerContext">
                                            <ul id="descriptionList${id}">
                                                ${formattedDescription}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12 ResetBAdgesBtn">
                                <span  id="resetButton${id}" class="SwithToDefaultBtn">Switch to Default <i class="fa fa-refresh" aria-hidden="true"></i></span>
                                </div>
                                
                                <div class="col-md-12">
                                <div class="card">
                                        <div class="form-group Add-Badge" style="display: none;">
                                            <label for="Add-Badge" class="col-form-label">Add Badge</label>
                                            <input type="text" class="Add-Badge" name="Add_Badge" id="badgeInput" placeholder="Enter Your Badge Name.." value="${title}">									
                                            <input type="hidden" name="id" value="${id}">
                                        </div>
                                        <div class="form-group BadgesStatus">
                                            <label for="BadgesStatus" class="col-form-label">Choose a Badge</label>
                                            <input type="text" id="BadgesStatus${id}" name="BadgesStatus" class="form-control" value="${title}" placeholder="New Items"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="BadgesStatus" class="col-form-label">Choose Badges Color</label>
                                            <input type="color" class="ColorPalletBox" id="favcolor closeColorPaletteButton${id}" name="badge_color" value="${badge_color}">									
                                        </div>
                                        <div class="form-group">
                                            <label for="BadgesHighlights" class="col-form-label">Badges Highlights</label>
                                            <input type="text" class="BadgesHighlights${id}" name="BadgesHighlights" value="${highlight_title}" Placeholder=" New..">
                                        </div>
                                        <div class="form-group">
                                            <label for="BadgesStatus" class="col-form-label">Badges Title</label>
                                            <input type="text" id="BadgesTitle${id}" name="BadgesTitle" value="${badge_title}" Placeholder="Close out Special..">
                                        </div>
                                        <div class="form-group ForDescription">
                                            <p class="DesNote"> you can only write 4 Description for this Badges & Press Enter to go no next Line</p>
                                            <label for="description">Description:</label><br>
                                            <div id="descriptionContainer">
                                            <div class="position-relative">
                                                <textarea id="description${id}" class="UpdateBadgesForm" name="description" value="" rows="1">${description}</textarea>
                                            </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                </div>
                            </div>
                                <div class="modal-footer" style="position: static;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Badges</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                `;

                // Append the modal HTML to the body
                $('#invpopm').html(modalHtml);

                // Show the modal using jQuery
                //$('#BadgesModaledit').modal('show');

                $('.edititembadegs').submit(function(event) {
                    // Prevent default form submission
                    event.preventDefault();
                    // Serialize form data
                    var formData = $(this).serialize();
                    var dis = document.getElementById("desname" + id + "").value;
                    formData += "&dis=" + encodeURIComponent(dis);

                    // Send AJAX request
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo Yii::app()->request->baseUrl; ?>/managebadges/Editcatbadge',
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            $('#BadgesModaledit').modal('hide');
                            location.reload(true);

                        },
                        error: function(xhr, status, error) {
                            // Handle errors if any
                            console.error(xhr.responseText);
                            // Optionally, display an error message or perform other actions
                        }
                    });
                });

                $(document).ready(function() {
                    $('#BadgesTitle' + id + '').on('input', function() {

                        var inputText = $(this).val();
                        $('#badgeDescription' + id + '').text(inputText);
                    });
                });

                $(document).ready(function() {

                    $('.BadgesHighlights' + id + '').on('input', function() {

                        var inputText = $(this).val();
                        $('#demo' + id + '').text(inputText);
                    });
                });
                $(document).ready(function() {

                    $('#BadgesStatus' + id + '').on('input', function() {

                        var inputText = $(this).val();


                        var pTag = $('.badgesType #defaultBadge' + id + '');
                        var existingBeforeSpan = pTag.find('.before').prop('outerHTML');
                        var existingAfterSpan = pTag.find('.after').prop('outerHTML');
                        pTag.html(inputText + existingBeforeSpan + existingAfterSpan);
                    });
                });

                $(document).ready(function() {
                    var maxLength = 25; // Maximum character limit
                    var maxLines = 4; // Maximum number of lines
                    var descriptionTextarea = $("#description" + id + "");
                    var descriptionList = $("#descriptionList" + id + "");

                    // Check if textarea is empty when the page loads
                    if (descriptionTextarea.val().trim() === "") {
                        descriptionTextarea.val("Save Upto $28"); // Add default line
                    }

                    descriptionTextarea.on("input", function() {
                        var lines = $(this).val().split("\n").filter(line => line.trim() !== ""); // Filter empty lines

                        // Check if number of lines exceeds the limit
                        if (lines.length > maxLines) {
                            // Display popup or error message here
                            alert("You can only write up to " + maxLines + " lines.");

                            // Trim lines to maximum allowed
                            lines = lines.slice(0, maxLines);

                            // Update textarea value with trimmed lines
                            $(this).val(lines.join("\n"));
                        }

                        // Format the list for display
                        var formattedList = lines.map(line => {
                            if (line.length > maxLength) {
                                line = line.slice(0, maxLength);
                            }
                            return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
                        }).join("");

                        // Update the description list
                        descriptionList.html(formattedList);
                    });
                });
                $(document).ready(function() {
                    // When the color input changes
                    $('input[type="color"]').change(function() {
                        // Get the new color value
                        var newColor = $(this).val();

                        // Update the background color of the elements
                        $('.defaultBG' + id + ' ').css('background-color', newColor);
                        $('.defaultBG' + id + ' .before').css('background-color', newColor);
                        $('.defaultBG' + id + ' .after').css('background-color', newColor);
                    });
                });

                $(document).ready(function() {
                    const colors = ['#FFBABA', '#94FF94', '#C7C7FF', '#FFFF8F', '#FFA6FF', '#00FFFF', '#D10100', '#BFBFBF', '#FFFFFF', '#7959D4', '#7ED552', '#75BAF5', '#F9C390', '#FCD75F', '#ABA5A5', '#FF9F9E', '#FF840D', '#AD90FF', '#50A7F2', '#FF7675'];

                    const targetDiv = $('.defaultBG' + id + '');
                    const resetButton = $('#resetButton' + id + '');
                    const resetBadgesBtn = $('.ResetBAdgesBtn');
                    let defaultColor = '#00AEEF'; // Set default color
                    colors.forEach(color => {
                        const colorBox = $('<div>').addClass('colorBox').css('background-color', color);
                        colorBox.click(function() {
                            targetDiv.css('background-color', color);
                            targetDiv.find('span').css('background-color', color); // change span color

                            // Change background color of .defaultBG class
                            $('.defaultBG').css('background-color', color);
                        });

                    });

                    function resetForm() {
                        targetDiv.css('background-color', defaultColor);
                        targetDiv.find('span').css('background-color', defaultColor); // reset span color

                        // Reset input values
                        $('#BadgesStatus' + id + '').val(''); // Clear input value
                        $('.BadgesHighlights' + id + '').val(''); // Clear input value
                        $('#BadgesTitle' + id + '').val(''); // Clear input value
                        $('#description' + id + '').val('Save Upto $28'); // Reset textarea value
                        $('.ColorPalletBox').val('#00AEEF'); // Reset textarea value

                        // Reset content of div elements
                        $('.defaultBadges .defaultBG' + id + '').css('background-color', defaultColor);
                        $('.defaultBadges .defaultBG' + id + '').html('New Item<span class="before customByPallet"></span><span class="after customByPallet"></span>');
                        $('.insideBadgesType #demo' + id + '').text('NEW');
                        $('.insideBadgesType #badgeDescription' + id + '').text('Close out Special');
                        $('.insideBadgesType #descriptionList' + id + '').html('<li><i class="fa fa-check" aria-hidden="true"></i> Save Upto $28</li>');
                    }

                    resetButton.click(resetForm);
                    resetBadgesBtn.click(resetForm);


                });
            }

            function badgepopup() {

                $(document).ready(function() {
                    $('#BadgesTitle').on('input', function() {
                        var inputText = $(this).val();
                        $('#badgeDescription').text(inputText);
                    });
                });

                $(document).ready(function() {

                    $('.BadgesHighlights').on('input', function() {

                        var inputText = $(this).val();
                        $('#demo').text(inputText);
                    });
                });
                $(document).ready(function() {

                    $('#BadgesStatus').on('input', function() {

                        var inputText = $(this).val();


                        var pTag = $('.badgesType #defaultBadge');
                        var existingBeforeSpan = pTag.find('.before').prop('outerHTML');
                        var existingAfterSpan = pTag.find('.after').prop('outerHTML');
                        pTag.html(inputText + existingBeforeSpan + existingAfterSpan);
                    });
                });

                $(document).ready(function() {
                    var maxLength = 25; // Maximum character limit
                    var maxLines = 4; // Maximum number of lines
                    var descriptionTextarea = $("#description");
                    var descriptionList = $("#descriptionList");

                    // Check if textarea is empty when the page loads
                    if (descriptionTextarea.val().trim() === "") {
                        descriptionTextarea.val("Save Upto $28"); // Add default line
                    }

                    descriptionTextarea.on("input", function() {
                        var lines = $(this).val().split("\n").filter(line => line.trim() !== ""); // Filter empty lines

                        // Check if number of lines exceeds the limit
                        if (lines.length > maxLines) {
                            // Display popup or error message here
                            alert("You can only write up to " + maxLines + " lines.");

                            // Trim lines to maximum allowed
                            lines = lines.slice(0, maxLines);

                            // Update textarea value with trimmed lines
                            $(this).val(lines.join("\n"));
                        }

                        // Format the list for display
                        var formattedList = lines.map(line => {
                            if (line.length > maxLength) {
                                line = line.slice(0, maxLength);
                            }
                            return "<li><i class='fa fa-check' aria-hidden='true'></i> " + line.trim() + "</li>";
                        }).join("");

                        // Update the description list
                        descriptionList.html(formattedList);
                    });
                });
                $(document).ready(function() {
                    // When the color input changes
                    $('input[type="color"]').change(function() {
                        // Get the new color value
                        var newColor = $(this).val();

                        // Update the background color of the elements
                        $('.defaultBGadd ').css('background-color', newColor);
                        $('.defaultBGadd .before').css('background-color', newColor);
                        $('.defaultBGadd .after').css('background-color', newColor);
                    });
                });

                $(document).ready(function() {
                    const colors = ['#FFBABA', '#94FF94', '#C7C7FF', '#FFFF8F', '#FFA6FF', '#00FFFF', '#D10100', '#BFBFBF', '#FFFFFF', '#7959D4', '#7ED552', '#75BAF5', '#F9C390', '#FCD75F', '#ABA5A5', '#FF9F9E', '#FF840D', '#AD90FF', '#50A7F2', '#FF7675'];
                    const colorPalette = $('#colorPalette');
                    const targetDiv = $('.customByPalletadd');
                    const resetButton = $('#resetButton');
                    const resetBadgesBtn = $('.ResetBAdgesBtn');
                    let defaultColor = '#00AEEF'; // Set default color
                    colors.forEach(color => {
                        const colorBox = $('<div>').addClass('colorBox').css('background-color', color);
                        colorBox.click(function() {
                            targetDiv.css('background-color', color);
                            targetDiv.find('span').css('background-color', color); // change span color

                            // Change background color of .defaultBG class
                            $('.defaultBG').css('background-color', color);
                        });
                        colorPalette.append(colorBox);
                    });

                    function resetForm() {
                        targetDiv.css('background-color', defaultColor);
                        targetDiv.find('span').css('background-color', defaultColor); // reset span color

                        // Reset input values
                        $('#BadgesStatus').val(''); // Clear input value
                        $('.BadgesHighlights').val(''); // Clear input value
                        $('#BadgesTitle').val(''); // Clear input value
                        $('#description').val('Save Upto $28'); // Reset textarea value
                        $('.ColorPalletBox').val('#00AEEF'); // Reset textarea value

                        // Reset content of div elements
                        $('.defaultBadges .defaultItemsadd').css('background-color', defaultColor);
                        $('.defaultBadges .defaultItemsadd').html('New Item<span class="before customByPallet"></span><span class="after customByPallet"></span>');
                        $('.insideBadgesType #demo').text('NEW');
                        $('.insideBadgesType #badgeDescription').text('Close out Special');
                        $('.insideBadgesType #descriptionList').html('<li><i class="fa fa-check" aria-hidden="true"></i> Save Upto $28</li>');
                    }

                    resetButton.click(resetForm);
                    resetBadgesBtn.click(resetForm);


                });
            }
        </script>

</body>

</html>