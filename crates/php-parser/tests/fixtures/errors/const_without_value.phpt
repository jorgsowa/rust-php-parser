===source===
<?php const X;
===errors===
expected '=', found ';'
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "X",
            "value": {
              "kind": "Error",
              "span": {
                "start": 13,
                "end": 14
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 14
            }
          }
        ]
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
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "=" in Standard input code on line 1
