===source===
<?php $y = $x |> strlen(...);
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 1
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
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
                        "Variable": "x"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "strlen"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 17,
                                    "end": 23
                                  }
                                }
                              },
                              "span": {
                                "start": 17,
                                "end": 23
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
