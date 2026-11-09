===source===
<?php
#[SensitiveParameter] function g() {}
===errors >=8.2===
Attribute "SensitiveParameter" cannot target function (allowed targets: parameter)
===php_error >=8.2===
PHP Fatal error:  Attribute "SensitiveParameter" cannot target function (allowed targets: parameter) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 43
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 37,
              "end": 38
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
                  "SensitiveParameter"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 26
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 26
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
