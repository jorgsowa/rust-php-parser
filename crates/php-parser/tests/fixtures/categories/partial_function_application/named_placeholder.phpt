===source===
<?php $fn = foo(s: ?, i: ?);
===php_error <=8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 1
===ast >=8.6===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "args": [
                      {
                        "name": {
                          "parts": [
                            "s"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "kind": "Placeholder",
                        "span": {
                          "start": 16,
                          "end": 20
                        }
                      },
                      {
                        "name": {
                          "parts": [
                            "i"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 22,
                            "end": 23
                          }
                        },
                        "kind": "Placeholder",
                        "span": {
                          "start": 22,
                          "end": 26
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
