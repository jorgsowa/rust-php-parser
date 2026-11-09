===source===
<?php
(1.5)::f();
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
                  "Parenthesized": {
                    "kind": {
                      "Float": 1.5
                    },
                    "span": {
                      "start": 7,
                      "end": 10
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "method": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
