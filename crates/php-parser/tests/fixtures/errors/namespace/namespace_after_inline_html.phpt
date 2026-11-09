===source===
x<?php
namespace A;
===errors===
Namespace declaration statement has to be the very first statement or after any declare call in the script
===php_error===
PHP Fatal error:  Namespace declaration statement has to be the very first statement or after any declare call in the script in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "x"
      },
      "span": {
        "start": 0,
        "end": 1
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 18
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 7,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
