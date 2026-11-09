===source===
<?php
#[AllowDynamicProperties] function h() {}
===errors >=8.2===
Attribute "AllowDynamicProperties" cannot target function (allowed targets: class)
===php_error >=8.2===
PHP Fatal error:  Attribute "AllowDynamicProperties" cannot target function (allowed targets: class) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 47
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 41,
              "end": 42
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
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 30
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 30
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
