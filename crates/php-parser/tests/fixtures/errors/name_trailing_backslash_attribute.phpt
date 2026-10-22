===source===
<?php
#[\App\] function f() {}
===errors >=8.0===
expected identifier, found ']'
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "\", expecting "]" in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 30
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 24,
              "end": 25
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "App"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 8,
                  "end": 12
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 15,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
