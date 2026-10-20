===source===
<?php
use X\A\;
===errors >=8.5===
expected identifier, found ';'
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "{" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "X",
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
