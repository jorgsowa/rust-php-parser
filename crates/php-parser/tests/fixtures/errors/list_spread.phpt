===source===
<?php list(...$x) = $arr;
===errors===
Spread operator is not supported in assignments
===php_error===
PHP Fatal error:  Spread operator is not supported in assignments in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 14,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
