<?php

include 'vendor/autoload.php';
include 'config/config.php';

/* Load service */
/** @var \YOUniversal $yOUniversal */
$yOUniversal = $container['yOUniversal'];

/* Sample input text */
$input = "This is the title

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean auctor nisl nunc, nec lacinia nunc accumsan sit amet. Etiam ante tortor, ultricies ac risus at, gravida condimentum metus. Aenean rutrum lacinia lacus id venenatis. Mauris vel elit urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam vel mi a dolor suscipit imperdiet. In semper, eros sit amet commodo commodo, nibh leo aliquet orci, ut iaculis sem magna ac dui. Proin vitae metus vel nunc semper bibendum nec id velit. Maecenas laoreet ligula at pellentesque faucibus. Ut vitae metus eget neque varius facilisis. Sed vulputate dolor orci, sed ornare nisl auctor id.

Praesent commodo et velit ac sagittis. Praesent laoreet suscipit purus ac gravida. Curabitur sit amet augue vel erat finibus finibus. Morbi porta, ex id vulputate blandit, tellus velit ullamcorper augue, non laoreet lorem lectus sit amet ex. Morbi nec pellentesque risus, ac pretium elit. Curabitur euismod turpis at dui aliquam, eu mattis quam ornare. Nulla efficitur elementum lacus, in sollicitudin lacus ultrices vitae. Integer imperdiet ornare elit eu rhoncus. Vestibulum eu dolor non felis maximus tempus vitae eget felis. Sed id arcu eu ipsum imperdiet aliquet a mattis leo. Cras porttitor pharetra dolor, in dapibus quam malesuada et. Sed in aliquet lorem.

Phasellus viverra feugiat risus, sed aliquet elit consequat ultricies. Pellentesque non vulputate erat. Nam rutrum rhoncus felis sit amet dictum. Maecenas semper eros ullamcorper tortor elementum, vel suscipit orci fermentum. Etiam diam nisl, luctus quis sapien tempor, placerat sollicitudin elit. Mauris gravida sapien in erat tincidunt, quis scelerisque quam pharetra. Suspendisse sem mi, venenatis vel sapien a, imperdiet viverra mi. Proin sagittis justo at felis malesuada fringilla. Sed vitae pellentesque augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.

Proin vel ultrices velit, vitae placerat massa. Fusce pretium, metus sit amet commodo varius, justo diam maximus libero, vel facilisis risus leo a sem. Etiam eget pretium arcu, sed ultricies nisl. Sed bibendum rhoncus placerat. Ut sodales dignissim mauris, quis consectetur orci dapibus non. Etiam luctus turpis quis bibendum lobortis. Aliquam sagittis mi felis, et commodo dolor eleifend quis. Vivamus id consectetur sapien. Nam et libero vel urna auctor sollicitudin. Pellentesque eu urna sed nisi commodo cursus a et sapien.

This is a numbered list:
1. ectetur adipis
2. ed aliquet elit
3. bero vitae metus
4. ugiat risus, sed aliquet elit conse

t amet, consectetur adipiscing elit. Aenean auctor nisl nunc, nec lacinia nunc accumsan sit amet. Etiam ante tortor, ultricies ac ris

This is a roman numeral list:
i. ectetur adipis
ii. ed aliquet elit
iii. bero vitae metus
iv. ugiat risus, sed aliquet elit conse
v. ugiat risus, sed aliquet elit conse

This is a roman numeral list:
I. ectetur adipis
II. ed aliquet elit
III. bero vitae metus
IV. ugiat risus, sed aliquet elit conse
V. ugiat risus, sed aliquet elit conse

This list is not numbered:
- this
- list
- is
- not
- numbered

Sed lacinia libero vitae metus euismod, ac interdum eros facilisis. Sed tempor consectetur scelerisque. Pellentesque vestibulum in lacus quis semper. Donec et urna lorem. Proin tempus condimentum odio, porta cursus lorem gravida ut. Praesent ultricies, augue sit amet scelerisque pulvinar, quam augue mattis magna, ut imperdiet risus tortor quis nulla. Etiam sit amet auctor libero. Sed scelerisque lacus vitae erat aliquam imperdiet. Nulla interdum pharetra libero, eget accumsan nulla pulvinar vitae. Integer facilisis velit a odio eleifend volutpat et non justo. Pellentesque quis mauris aliquam, posuere metus in, luctus velit. Phasellus ut imperdiet erat. Vestibulum ut semper massa. Proin fermentum neque et mattis ullamcorper.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean auctor nisl nunc, nec lacinia nunc accumsan sit amet. Etiam ante tortor, ultricies ac risus at, gravida condimentum metus. Aenean rutrum lacinia lacus id venenatis. Mauris vel elit urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam vel mi a dolor suscipit imperdiet. In semper, eros sit amet commodo commodo, nibh leo aliquet orci, ut iaculis sem magna ac dui. Proin vitae metus vel nunc semper bibendum nec id velit. Maecenas laoreet ligula at pellentesque faucibus. Ut vitae metus eget neque varius facilisis. Sed vulputate dolor orci, sed ornare nisl auctor id.

Praesent commodo et velit ac sagittis. Praesent laoreet suscipit purus ac gravida. Curabitur sit amet augue vel erat finibus finibus. Morbi porta, ex id vulputate blandit, tellus velit ullamcorper augue, non laoreet lorem lectus sit amet ex. Morbi nec pellentesque risus, ac pretium elit. Curabitur euismod turpis at dui aliquam, eu mattis quam ornare. Nulla efficitur elementum lacus, in sollicitudin lacus ultrices vitae. Integer imperdiet ornare elit eu rhoncus. Vestibulum eu dolor non felis maximus tempus vitae eget felis. Sed id arcu eu ipsum imperdiet aliquet a mattis leo. Cras porttitor pharetra dolor, in dapibus quam malesuada et. Sed in aliquet lorem.

Phasellus viverra feugiat risus, sed aliquet elit consequat ultricies. Pellentesque non vulputate erat. Nam rutrum rhoncus felis sit amet dictum. Maecenas semper eros ullamcorper tortor elementum, vel suscipit orci fermentum. Etiam diam nisl, luctus quis sapien tempor, placerat sollicitudin elit. Mauris gravida sapien in erat tincidunt, quis scelerisque quam pharetra. Suspendisse sem mi, venenatis vel sapien a, imperdiet viverra mi. Proin sagittis justo at felis malesuada fringilla. Sed vitae pellentesque augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.

Proin vel ultrices velit, vitae placerat massa. Fusce pretium, metus sit amet commodo varius, justo diam maximus libero, vel facilisis risus leo a sem. Etiam eget pretium arcu, sed ultricies nisl. Sed bibendum rhoncus placerat. Ut sodales dignissim mauris, quis consectetur orci dapibus non. Etiam luctus turpis quis bibendum lobortis. Aliquam sagittis mi felis, et commodo dolor eleifend quis. Vivamus id consectetur sapien. Nam et libero vel urna auctor sollicitudin. Pellentesque eu urna sed nisi commodo cursus a et sapien.

Sed lacinia libero vitae metus euismod, ac interdum eros facilisis. Sed tempor consectetur scelerisque. Pellentesque vestibulum in lacus quis semper. Donec et urna lorem. Proin tempus condimentum odio, porta cursus lorem gravida ut. Praesent ultricies, augue sit amet scelerisque pulvinar, quam augue mattis magna, ut imperdiet risus tortor quis nulla. Etiam sit amet auctor libero. Sed scelerisque lacus vitae erat aliquam imperdiet. Nulla interdum pharetra libero, eget accumsan nulla pulvinar vitae. Integer facilisis velit a odio eleifend volutpat et non justo. Pellentesque quis mauris aliquam, posuere metus in, luctus velit. Phasellus ut imperdiet erat. Vestibulum ut semper massa. Proin fermentum neque et mattis ullamcorper.";


$htmlifier = new TextToHtml();
$htmlifier->setInput($input);
$htmlifier->go();

/**
 * Automate the tedious task of converting text to HTML
 * Performs Multi-pass conversion
 *
 * Class TextToHtml
 */
class TextToHtml {

    private $input;
    private $paragraphs;

    public function go()
    {
        /* Convert text to array of lines / paragraphs */
        $this->paragraphs = explode("\n", $this->input);

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

        $this->setPlaintextHeader();

        echo'<pre>';
        var_dump("
        -----------------------INPUT-----------------------------");
        var_dump($this->input);
        var_dump("
        -----------------------OUTPUT-----------------------------");
        var_dump($output);
        echo'</pre>';
        die('Died after debug code');
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
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     *
     */
    private function setPlaintextHeader()
    {
        header("Content-Type: text/plain");
    }
}

