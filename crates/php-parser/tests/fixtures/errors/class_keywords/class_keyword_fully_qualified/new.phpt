===source===
<?php
new \parent;
===errors===
'\parent' is an invalid class name
===php_error===
PHP Fatal error:  '\parent' is an invalid class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "parent"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 10,
                      "end": 17
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 17
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
