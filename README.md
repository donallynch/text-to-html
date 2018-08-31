# text-to-html
Automate the tedious task of converting text to HTML

# Provide the following plain text as input:
Title:
1. this
2. is
3. A
4. Test
5. http://www.google.com

Roman:
I) Roman
II) Numerals
III) Are
IV) Cool

This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. 

The end.

# The output will be the following HTML:
<strong>Title:</strong>
<ol>
    <li>1. this</li>
    <li>2. is</li>
    <li>3. A</li>
    <li>4. Test</li>
    <li>5. <a href="http://www.google.com" target="_blank">www.google.com</a></li>
</ol>
<strong>Roman:</strong>
<ol>
    <li>I) Roman</li>
    <li>II) Numerals</li>
    <li>III) Are</li>
    <li>IV) Cool</li>
</ol>
<p>
This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. This is a paragraph of text. 
</p>
<p>
The end.
</p>
