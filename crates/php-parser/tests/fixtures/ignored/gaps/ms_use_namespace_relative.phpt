===source===
<?php
use namespace\A;
===errors >=8.5===
expected name, found namespace-relative name
===php_error===
PHP Parse error:  syntax error, unexpected namespace-relative name "namespace\A" in Standard input code on line 2
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
                  "A"
                ],
                "kind": "Relative",
                "span": {
                  "start": 10,
                  "end": 21
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 21
              }
            }
          ]
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
