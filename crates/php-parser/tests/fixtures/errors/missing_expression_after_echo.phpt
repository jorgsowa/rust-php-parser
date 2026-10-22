===source===
<?php echo ;
===errors===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": "Error",
            "span": {
              "start": 11,
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
