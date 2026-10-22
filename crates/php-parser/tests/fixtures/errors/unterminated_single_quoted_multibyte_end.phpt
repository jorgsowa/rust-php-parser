===source===
<?php 'héllo

===errors===
unterminated string literal
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ''héllo' (T_ENCAPSED_AND_WHITESPACE), expecting end of file in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected string content "héllo", expecting end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "héllo\n"
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
