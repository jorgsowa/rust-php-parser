===source===
<?php
\self::f();
===errors===
'\self' is an invalid class name
===php_error===
PHP Fatal error:  '\self' is an invalid class name in Standard input code on line 2
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
                  "Name": {
                    "parts": [
                      "self"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 6,
                      "end": 11
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
