===source===
<?php
['k' => $a] = &$b;
===errors===
Cannot assign by reference to a destructuring pattern
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 2
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
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 21,
                  "end": 23
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
