<?php
declare(strict_types=1);

class CustomString
{
    /**
     * Concatenates two strings with provided glue
     *
     * @param string $str1
     * @param string $str2
     * @param string $glue
     * @return string
     */
    public function strConcat(string $str1, string $str2, string $glue = ""): string
    {
        return $str1 . $glue . $str2;
    }

    /**
     * Returns length of provided string
     *
     * @param string $str
     * @return int
     */
    public function strLength(string $str): int
    {
        $i = 0;

        while (isset($str[$i])) {
            $i++;
        }

        return $i;
    }

    /**
     * Returns true if string are matching
     *
     * @param string $str1
     * @param $str2
     * @return bool
     */
    public function strCompare(string $str1, string $str2): bool
    {
        $str1Len = $this->strLength($str1);
        $str2Len = $this->strLength($str2);

        if ($str1Len == $str2Len) {
            for ($i = 0; $i < $str1Len; $i++) {
                if ($str1[$i] == $str2[$i]) {
                    if ($i == $str1Len - 1) {
                        return true;
                    }
                } else {
                    break;
                }
            }
        }
        return false;
    }

    /**
     * Return substring of provided string
     * Offset starts from 0
     *
     * @param string $str
     * @param int $offset
     * @param int|null $limit
     * @return string
     */
    public function subString(string $str, int $offset, int $limit = null): string
    {
        $strLen = $this->strLength($str);

        $returnString = "";
        $j = 0;
        for ($i = $offset; $i < $strLen; $i++) {
            if ($j === $limit) {
                break;
            }
            $returnString .= $str[$i];
            $j++;
        }

        return $returnString;
    }

    /**
     * Trims provided char(list of characters) from beginning and end of string
     *
     * @param string $str
     * @param string $char
     * @return string
     */
    public function strTrim(string $str, string $char): string
    {
        $strLen = $this->strLength($str);
        $charLen = $this->strLength($char);

        $returnString = $str;

        if ($strLen >= $charLen && $strLen - $charLen >= 0) {
            $substr = $this->subString($str, 0, $charLen);

            if ($this->strCompare($substr, $char)) {
                $returnString = $this->subString($str, $charLen);


            }
            $retStrLen = $this->strLength($returnString);

            $endOffset = $retStrLen - $charLen;
            if ($retStrLen >= $charLen && $endOffset >= 0) {
                $retSubStr = $this->subString($returnString, $endOffset);

                if ($this->strCompare($retSubStr, $char)) {
                    $returnString = $this->subString($returnString, 0, $endOffset);
                }
            }
        }
        return $returnString;
    }

    /**
     * Splits string with provided char
     *
     * @param string $str
     * @param string $char
     * @return array
     */
    public function strExplode(string $str, string $char): array
    {
        $strLen = $this->strLength($str);
        $charLen = $this->strLength($char);

        $j = 0;
        $returnArray[$j] = "";
        if ($strLen > $charLen && $charLen > 0) {
            for ($i = 0; $i < $strLen; $i++) {
                if ($str[$i] == $char[0]) {
                    $sample = $this->subString($str, $i, $charLen);
                    if ($this->strCompare($sample, $char)) {
                        $i += $charLen;
                        ++$j;
                        $returnArray[$j] = "";
                    }
                }
                $returnArray[$j] .= $str[$i];
            }
        } else {
            $returnArray[$j] = $str;
        }

        return $returnArray;

    }

    /**
     * Creates string from provided array of strings
     *
     * @param array $arr
     * @param string $char
     * @return string
     */
    public function strImplode(array $arr, string $char): string
    {
        $singleton = true;
        $returnString = '';
        foreach ($arr as $item) {
            if ($singleton) {
                $returnString = $item;
                $singleton = false;
            } else {
                $returnString = $this->strConcat($returnString, $item, $char);
            }
        }

        return $returnString;
    }

    /**
     * Replace all parts of string where search word appears with provided string
     *
     * @param string $str
     * @param string $searchFor
     * @param string $replaceWith
     * @return string
     */
    public function strReplace(string $str, string $searchFor, string $replaceWith): string
    {
        $strLen = $this->strLength($str);
        $searchForLen = $this->strLength($searchFor);

        $returnString = "";
        if ($strLen > $searchForLen && $searchForLen > 0) {
            for ($i = 0; $i < $strLen; $i++) {
                if ($str[$i] == $searchFor[0]) {
                    $sample = $this->subString($str, $i, $searchForLen);
                    if ($this->strCompare($sample, $searchFor)) {
                        $i += $searchForLen - 1;
                        $returnString .= $replaceWith;
                    } else {
                        $returnString .= $str[$i];
                    }
                } else {
                    $returnString .= $str[$i];
                }
            }
        } else {
            $returnString = $str;
        }
        return $returnString;
    }
}

?>
