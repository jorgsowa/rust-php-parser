===source===
<?php }
===errors===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting end of file in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unmatched '}' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": "Error",
      "span": {
        "start": 5,
        "end": 5
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 5
  }
}
