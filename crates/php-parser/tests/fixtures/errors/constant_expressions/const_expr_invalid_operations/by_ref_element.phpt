===source===
<?php
const Q = [&$a];
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "Q",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "ByRef": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 18,
                          "end": 20
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 20
                    }
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 21
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 21
            }
          }
        ]
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
