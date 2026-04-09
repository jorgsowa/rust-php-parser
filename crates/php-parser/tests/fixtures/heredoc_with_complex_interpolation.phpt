===source===
<?php
$x = <<<EOT
Hello {$obj->name}!
$arr[0] items
EOT;
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Hello "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "obj"
                                },
                                "span": {
                                  "start": 25,
                                  "end": 29,
                                  "start_line": 3,
                                  "start_col": 7
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 31,
                                  "end": 35,
                                  "start_line": 3,
                                  "start_col": 13
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 25,
                            "end": 35,
                            "start_line": 3,
                            "start_col": 7
                          }
                        }
                      },
                      {
                        "Literal": "!\n"
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "arr"
                                },
                                "span": {
                                  "start": 38,
                                  "end": 42,
                                  "start_line": 4,
                                  "start_col": 0
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 43,
                                  "end": 44,
                                  "start_line": 4,
                                  "start_col": 5
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 45,
                            "start_line": 4,
                            "start_col": 0
                          }
                        }
                      },
                      {
                        "Literal": " items"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 55,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 55,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 56,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}
