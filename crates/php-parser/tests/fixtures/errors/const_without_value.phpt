===source===
<?php const X;
===errors===
expected '=', found ';'
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '=' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "=" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "X",
              "span": {
                "start": 12,
                "end": 13
              }
            },
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
