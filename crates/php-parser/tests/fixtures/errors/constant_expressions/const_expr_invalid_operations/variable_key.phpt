===source===
<?php
const R = [$x => 1];
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
              "name": "R",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    },
                    "kind": {
                      "Value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 23,
                          "end": 24
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 24
                    }
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
