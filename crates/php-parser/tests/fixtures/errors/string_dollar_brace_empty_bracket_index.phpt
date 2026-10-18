===source===
<?php $x = "${arr[]}";
===errors===
empty index in string interpolation
===php_error===
PHP Parse error:  syntax error, unexpected token "]" in Standard input code on line 1
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
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 14,
                                "end": 17
                              }
                            },
                            "index": {
                              "kind": "Error",
                              "span": {
                                "start": 18,
                                "end": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 20
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
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
