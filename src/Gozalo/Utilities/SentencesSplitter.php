<?php
namespace Gozalo\Utilities;

class SentencesSplitter {

    /**
     * Split a string into 
     * @param  string $string   String to split into sentences
     * @return array            Array of sentences 
     */
    public static function split ($string)
    {
        
        // Initially split string using regex
        $regex_split = preg_split('/([\.\?!][\'|"]?(?![0-9a-z])\s?)/i', $string, -1,
                                  PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        // Concatenate the delimiters to the string
        $tmp_sentences = array();
        for ($i=0; $i < count($regex_split); $i+=2) {
            $tmp_sentences[] = trim($regex_split[$i]) . trim($regex_split[$i+1]);
        }

        // Join quotes as one sentence. Example:
        $sentences = array();
        $sentence = "";
        for($i = 0; $i < count($tmp_sentences); $i++) {
            if(substr_count($tmp_sentences[$i], '"') % 2 == 1) {
                if($sentence != "") {
                    $sentence = $sentence . " " . $tmp_sentences[$i];
                    $sentences[] = $sentence;
                    $sentence = "";
                } else {
                    $sentence = $tmp_sentences[$i];
                }
            } else {
                $sentences[] = $tmp_sentences[$i];
            }
        }
        return $sentences;
    }

}