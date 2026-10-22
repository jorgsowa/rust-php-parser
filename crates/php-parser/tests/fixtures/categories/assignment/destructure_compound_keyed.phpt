===source===
<?php
['k' => $a] += 1;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '+=' (T_PLUS_EQUAL) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "+=" in Standard input code on line 2
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
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 7,
                          "end": 10
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 14,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 7,
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
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 21,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
