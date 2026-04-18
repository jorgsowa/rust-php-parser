===config===
min_php=8.5
===source===
<?php $x = (void)1 + 2;
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Cast": [
                          "Void",
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 11,
                        "end": 18
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
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
===php_error===
PHP Parse error:  syntax error, unexpected token "(void)" in Standard input code on line 1
