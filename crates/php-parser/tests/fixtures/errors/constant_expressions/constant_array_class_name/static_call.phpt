===source===
<?php
[]::foo();
===errors===
Illegal class name
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
