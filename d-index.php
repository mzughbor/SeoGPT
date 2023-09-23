<!DOCTYPE html>
<html>
<head>
<title>PHP Code in HTML</title>
</head>
<body>
<?php

function checkKeyphraseInText($keyphrase, $text) {
    // Remove commas and periods from the keyphrase and text
    $keyphrase = str_replace(['.', ',', '-', '،', '/', '\\', '|', '!', '?', '؟', '`', '"', "'"], '', $keyphrase);
    $text = str_replace(['.', ',', '-', '،', '/', '\\', '|', '!', '?', '؟', '`', '"', "'"], '', $text);

    // Split the keyphrase into individual words
    $keyphraseWords = explode(' ', $keyphrase);

    // Remove empty elements from the array
    $keyphraseWords = array_filter($keyphraseWords, 'strlen');

    // Initialize an array to store missing words
    $missingWords = [];

    // Loop through each word in the keyphrase
    foreach ($keyphraseWords as $word) {
        // Check if the word exists in the text
        if (stripos($text, $word) === false) {
            // Word not found, add it to the missingWords array
            $missingWords[] = $word;
        }
    }

    // Check if any words were missing
    if (!empty($missingWords)) {
        return $missingWords; // Return the array of missing words
    }

    return true; // All words found, return true
}



$keyphrase = 'تمريرات صاروخية - نهائية دوري نايل';
$text = 'أبدع التمريرات في نهائي دوري نايل! تعرّف على تأثيرها القوي والأداء المذهل للفرق واللاعبين في هذه البطولة الحاسمة. استمتع بأحداث المباريات واكتشف الأداء الرائع. تفضل بتصفح المقال الآن وانطلق نحو أروع اللحظات!';

$result = checkKeyphraseInText($keyphrase, $text);

if ($result === true) {
    echo "All words in the keyphrase exist in the text.";
} else {
    // Handle the case where some words are missing
    echo "The following words are missing: " . implode(', ', $result);
}


  
?>
</body>
</html>
