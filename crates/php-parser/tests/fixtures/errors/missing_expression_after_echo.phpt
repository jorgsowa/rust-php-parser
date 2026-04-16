===source===
<?php echo ;
===errors===
expected expression
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
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
