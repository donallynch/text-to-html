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

    /** @var string $input */
    private $input;

    /** @var string $output */
    private $output;

    /** @var array $paragraphs */
    private $paragraphs;

    /** @var bool $isOpenInNewWindow Do anchor tags open in new window on click? Default: true */
    private $isOpenInNewWindow = true;

    /**
     * @return array
     */
    public function go()
    {
        if ($this->input === null) {
            return ['status' => 400, 'errors' => 'Input text cannot be empty'];
        }

        /* Convert input text to array of paragraphs */
        $this->paragraphs = explode("\n", $this->input);

        /* Merge multiple newlines into single newline */
        $this->mergeMultipleNewlines();

        /* Replace HTML entities */
        $this->replaceHtmlEntities();

        /* Handle URLs */
        $this->urls();

        /* Handle lists */
        $this->lists();

        /* Additional functions */
        foreach ($this->paragraphs as $key => $value) {
            $this->headings($key, $value);
            $this->strong($key, $value);
            $this->paragraphs($key, $value);
        }

        /* Prepare output */
        $this->prepareOutput();

        return ['status' => 200];
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

    /**
     * Convert paragraphs array to output string
     */
    private function prepareOutput()
    {
        $output = '';
        foreach ($this->paragraphs as $key => $value) {
            $output .= $value;
        }

        $this->output = $output;
    }

    /**
     * @return string
     */
    private function urls()
    {
        /* Foreach line of text */
        for ($i = 0; $i <= count($this->paragraphs)-1; $i++) {

            /* Do we open URLs in New Window or same window? */
            $blank = '';
            if ($this->isOpenInNewWindow) {
                $blank = " target=\"_blank\"";
            }

            /* Replace URL with HTML */
            $text = preg_replace(
                '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',
                "<a href=\"$1\"{$blank}>$3</a>$4",
                $this->paragraphs[$i]
            );

            /* Replace modified paragraph */
            $this->paragraphs[$i] = $text;
        }
    }

    /**
     * Merge multiple newlines into single new line
     */
    private function mergeMultipleNewlines()
    {
        $newlineCount = 0;
        foreach ($this->paragraphs as $key => $value) {
            if ($value === '') {
                $newlineCount++;
            } else {
                $newlineCount = 0;
            }

            if ($newlineCount > 1 && $value === '') {
                unset($this->paragraphs[$key]);
            }
        }

        /* Reset array keys after unset */
        $this->paragraphs = array_values($this->paragraphs);
    }

    /**
     * Identify lines that should be wrapped in H1/H2/H3/H4 HTML tags
     *
     * @param $p
     * @param $q
     */
    private function headings($p, $q)
    {
        $lineLength = strlen($q);

        /* If line is greater than 0 and at most 60 characters */
        if ($lineLength > 16 && $lineLength <= 100 && in_array(substr($this->paragraphs[$p], -1), [':',';'])) {
            $this->paragraphs[$p] = '<h3>' . $this->paragraphs[$p] . '</h3>';
        }
    }

    /**
     * Identifying lines of text that look like lists
     *
     * @return array
     */
    private function lists()
    {
        /* Lists */
        $prev = null;
        for ($i = 0; $i <= count($this->paragraphs)-1; $i++) {

            $string = trim($this->paragraphs[$i]);

            /* Numbers followed by dot-space */
            preg_match('/^[0-9]*[. ]/', $string, $matches, PREG_OFFSET_CAPTURE);

            /* Line starts with dash, dot or hash */
            preg_match('/^[-|.|#]/', $string, $matches1, PREG_OFFSET_CAPTURE);

            /* Line starts with Roman Numeral (uppercase), followed by dot, close-bracket or space */
            preg_match('/^(?:XL|L|L?(?:IX|X{1,3}|X{0,3}(?:IX|IV|V|V?I{1,3})))[.|)| ]/', $string, $matches2, PREG_OFFSET_CAPTURE);

            /* Line starts with Roman Numeral (lowercase), followed by dot, close-bracket or space */
            preg_match('/^(?:xl|l|l?(?:ix|x{1,3}|x{0,3}(?:ix|iv|v|v?i{1,3})))[.|)| ]/', $string, $matches3, PREG_OFFSET_CAPTURE);

            $current = array_merge($matches, $matches1, $matches2, $matches3);

            /* If current list */
            if (count($current) > 0) {
                $pre = '';
                if (count($prev) === 0) {
                    $pre = '<ol>';
                }

                $this->paragraphs[$i] = $pre . '
    <li>' . $this->paragraphs[$i] . '</li>';
            }

            if (count($current) === 0 && (is_array($prev) && count($prev) > 0)) {
                $this->paragraphs[$i] = $this->paragraphs[$i] . '
</ol>
';
            }

            $prev = $current;
        }
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
        if ($ending === ':' ) {
            $this->paragraphs[$p] = '<strong>' . $this->paragraphs[$p] . '</strong>';
        }
    }

    /**
     * Identify lines that should be wrapped in P HTML tags
     *
     * @param $p
     * @param $line
     * @return mixed
     */
    private function paragraphs($p, $line)
    {
        $size = count($this->paragraphs);

        /* If it's the last line/paragraph of the input file; wrap in p tags */
        if ($p + 1 === $size) {
            $this->paragraphs[$p] = '<p>
' . $this->paragraphs[$p] . '
</p>
';
        }

        /* If the line is empty; wrap previous line/paragraph in P tags */
        if ($line === '') {
            $this->paragraphs[$p-1] = '<p>
' . $this->paragraphs[$p-1] . '
</p>
';
        }
    }

    /**
     * Replace commas, quotes etc with HTML entities
     */
    private function replaceHtmlEntities()
    {
        /* Foreach line of text */
        for ($i = 0; $i <= count($this->paragraphs)-1; $i++) {
            $text = str_replace('&', "&amp;", $this->paragraphs[$i]);
            $text = str_replace("’", "&apos;", $text);
            $text = str_replace("`", "&apos;", $text);
            $text = str_replace("'", "&apos;", $text);
            $text = str_replace('"', "&quot;", $text);
            $text = str_replace('<', "&lt;", $text);
            $text = str_replace('>', "&gt;", $text);

            $text = str_replace('©', "&copy;", $text);

            /* Replace modified paragraph */
            $this->paragraphs[$i] = $text;
        }
    }
}

