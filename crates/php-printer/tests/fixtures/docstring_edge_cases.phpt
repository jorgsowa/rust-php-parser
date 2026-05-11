===source===
<?php

// Heredoc with simple content
<<<EOS
Hello World
EOS;

// Heredoc with variable interpolation
<<<EOS
Hello $name
EOS;

// Heredoc with property access
<<<EOS
{$obj->prop}
EOS;

// Heredoc with carriage return in content
<<<EOS
Line1\rLine2
EOS;

// Heredoc with tab
<<<EOS
Col1	Col2
EOS;

// Heredoc with escaped dollar
<<<EOS
Price: \$100
EOS;

// Heredoc with escaped backslash
<<<EOS
Path: \\file.txt
EOS;

// Heredoc with complex expression
<<<EOS
{$arr[0]->method()}
EOS;

// Nowdoc with special characters
<<<'EOS'
$var won't be interpolated
EOS;

// Empty heredoc
<<<EOS
EOS;

// Heredoc with multiple lines and variables
<<<EOS
Line1: $a
Line2: $b
Line3: $c
EOS;

===print===
<?php
// Heredoc with simple content
<<<EOS
Hello World
EOS;
// Heredoc with variable interpolation
<<<EOS
Hello $name
EOS;
// Heredoc with property access
<<<EOS
{$obj->prop}
EOS;
// Heredoc with carriage return in content
<<<EOS
Line1\rLine2
EOS;
// Heredoc with tab
<<<EOS
Col1	Col2
EOS;
// Heredoc with escaped dollar
<<<EOS
Price: \$100
EOS;
// Heredoc with escaped backslash
<<<EOS
Path: \\file.txt
EOS;
// Heredoc with complex expression
<<<EOS
{$arr[0]->method()}
EOS;
// Nowdoc with special characters
<<<'EOS'
$var won't be interpolated
EOS;
// Empty heredoc
<<<EOS

EOS;
// Heredoc with multiple lines and variables
<<<EOS
Line1: $a
Line2: $b
Line3: $c
EOS;
