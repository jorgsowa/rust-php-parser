===source===
<?php 'unclosed string
===errors===
unterminated string literal
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ''unclosed string' (T_ENCAPSED_AND_WHITESPACE), expecting end of file in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected string content "unclosed string", expecting end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "unclosed string"
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
