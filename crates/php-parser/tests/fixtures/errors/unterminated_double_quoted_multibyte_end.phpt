===source===
<?php "世世

===errors===
unterminated string literal
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) or ${ (T_DOLLAR_OPEN_CURLY_BRACES) or {$ (T_CURLY_OPEN) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or "${" or "{$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "世世\n"
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
