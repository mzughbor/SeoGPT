<!DOCTYPE html>
<html>
<head>
<title>PHP Code in HTML</title>
</head>
<body>
<?php

// note / this function cheack in all given text not only first 156 chracters...
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




function checkKeyphraseInMetaDescription($keyphrase, $meta_description) {

    // Specify the maximum allowed length for the meta description
    $max_length = 156; // You can adjust this value as needed

    // Extract the text to search for keyphrases from the 156th character onwards
    //$text_to_search = mb_substr($meta_description, $max_length);

    // Extract the text from the beginning up to the 156th character
    $text_to_search = mb_substr($meta_description, 0, $max_length);

    // Check if the keyphrase exists in the extracted text and return array of missing words or True...
    $key_forgetten = checkKeyphraseInText($keyphrase, $text_to_search);
    
    // Get the length of the result
    $keyphraseResultLength = is_array($key_forgetten) ? count($key_forgetten) : 0;
    echo($keyphraseResultLength);
    echo("<br>");

    if ($keyphraseResultLength != 0) {
        echo("<p> if </p>");
        // Add the keyphrase to the beginning of the meta description
        $meta_description = implode('، ', $key_forgetten) . ' / ' . $meta_description;
    }
    echo('YES');
    return $meta_description;
}


$keyphrase = 'مران عواد الزمالك';
// Get the current post's meta description
$seo_title = '"تقرير مفصل عن مران عواد الزمالك فقط على Wedti.com"';
$meta_description = 'تعرف على تدريبات عولاد الزمالك المثيرة وكيف يساهم في تحقيق الفوز لفريقه.';
echo($keyphrase);
echo("<br>");
echo($meta_description);
echo("<br>");
$meta_description = checkKeyphraseInMetaDescription($keyphrase, $meta_description);
echo("<br>");
echo($meta_description);

  
?>
</body>
</html>
