<?php

namespace App\Services;

/**
 * Automate the tedious task of converting text to HTML
 * Performs Multi-pass conversion
 *
 * Class TextToHtml
 * @package App\Services
 */
class TextToHtml {

    private $input;
    private $output;
    private $paragraphs;

    /** @var bool $isOpenInNewWindow Do anchor tags open in new window on click? Default: true */
    private $isOpenInNewWindow = true;

    public function go()
    {
        if ($this->input === null) {
            return ['status' => 400, 'errors' => 'Input text cannot be empty'];
        }

        // foreach line of text
        $paragraphs = explode("\n", $this->input);
        $output = '';

        /* Foreach line of text */
        for ($i = 0; $i <= count($paragraphs)-1; $i++) {

            /* Do we open URLs in New Window or same window? */
            $blank = '';
            if ($this->isOpenInNewWindow) {
                $blank = " target=\"_blank\"";
            }

            /* Replace URL with HTML */
            $text = preg_replace(
                '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',
                "<a href=\"$1\"{$blank}>$3</a>$4",
                $paragraphs[$i]
            );

            /* Replace ’` etc with &apos; */
            $text = str_replace("’", "&apos;", $text);
            $text = str_replace("`", "&apos;", $text);

            /* Add line of text to output */
            $output .= $text . "\n";
        }

        /* Convert text to array of lines / paragraphs */
        $this->paragraphs = explode("\n", $output);

        $prev = null;
        for ($i = 0; $i <= count($this->paragraphs)-1; $i++) {

            $current = $this->lists($this->paragraphs[$i]);

            /* If current list */
            if (count($current) > 0) {
                $pre = '';
                if (count($prev) === 0) {
                    $pre = '
<p>
    <ol>';
                }

                $this->paragraphs[$i] = $pre . '
        <li>' . $this->paragraphs[$i] . '</li>';
            }

            if (count($current) === 0 && (is_array($prev) && count($prev) > 0)) {
                $this->paragraphs[$i] = $this->paragraphs[$i] . '
    </ol>
</p>
';
            }

            $prev = $current;
        }

        foreach ($this->paragraphs as $p => $q) {
            //$this->h1($p, $q);
            $this->strong($p, $q);
            $this->paragraphs($p, $q);
        }

        /* Prepare output */
        $output = '';
        foreach ($this->paragraphs as $key => $value) {
            $output .= $value;
        }

        $this->output = $output;

        return ['status' => 200];
    }

    /**
     * Identify lines that should be wrapped in H1 HTML tags
     *
     * @param $p
     * @param $q
     */
    private function h1($p, $q)
    {
        $lineLength = strlen($q);

        /* If line is greater than 0 and at most 60 characters */
        if ($lineLength > 0 && $lineLength <= 60) {
            $this->paragraphs[$p] = '<h1>' . $this->paragraphs[$p] . '</h1>';
        }
    }

    /**
     * Identifying lines of text that look like lists
     *
     * @param $q
     * @return array
     */
    private function lists($q)
    {
        $string = trim($q);

        /* Numbers followed by dot-space */
        preg_match('/^[0-9]*[. ]/', $string, $matches, PREG_OFFSET_CAPTURE);

        /* Line starts with dash, dot or hash */
        preg_match('/^[-|.|#]/', $string, $matches1, PREG_OFFSET_CAPTURE);

        /* Line starts with Roman Numeral (uppercase), followed by dot, close-bracket or space */
        preg_match('/^(?:XL|L|L?(?:IX|X{1,3}|X{0,3}(?:IX|IV|V|V?I{1,3})))[.|)| ]/', $string, $matches2, PREG_OFFSET_CAPTURE);

        /* Line starts with Roman Numeral (lowercase), followed by dot, close-bracket or space */
        preg_match('/^(?:xl|l|l?(?:ix|x{1,3}|x{0,3}(?:ix|iv|v|v?i{1,3})))[.|)| ]/', $string, $matches3, PREG_OFFSET_CAPTURE);

        return array_merge($matches, $matches1, $matches2, $matches3);
    }

    /**
     * Identify lines that should be wrapped in strong HTML tags
     *
     * @param $p
     * @param $q
     */
    private function strong($p, $q)
    {
        $ending = substr(trim($q), -1);

        /* If line ends with :, ; */
        if ($ending === ':' || $ending === ';') {
            $this->paragraphs[$p] = '<strong>' . $this->paragraphs[$p] . '</strong>';
        }
    }

    /**
     * Identify lines that should be wrapped in P HTML tags
     *
     * @param $p
     * @param $q
     * @return mixed
     */
    private function paragraphs($p, $q)
    {
        $size = count($this->paragraphs);

        /* If it's the last line/paragraph of the input file; add a closing </p> tag at the end */
        if ($p+1 === $size) {
            $this->paragraphs[$p] = '<p>
' . $this->paragraphs[$p] . '
</p>
';
        }

        /* If the line is empty; wrap previous line/paragraph in P tags */
        if ($q === '') {
            $this->paragraphs[$p-1] = '<p>
' . $this->paragraphs[$p-1] . '
</p>
';
        }
    }

    /**
     * @param $paragraphs
     */
    public function setParagraphs($paragraphs)
    {
        $this->paragraphs = $paragraphs;
    }

    /**
     * @param $input
     * @return bool
     */
    public function setInput($input)
    {
        if (strlen($input) === 0) {
            return false;
        }

        $this->input = $input;

        return true;
    }

    /**
     * Public setter for isOpenInNewWindow
     *
     * @param $value
     */
    public function setIsOpenInNewWindow($value)
    {
        $this->isOpenInNewWindow = $value;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }
}

