===source===
<?php
$x = <<<END
    Hello {$obj->name}!
    $arr[0] items
    END;
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
                    "label": "END",
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
                                  "start": 29,
                                  "end": 33,
                                  "start_line": 3,
                                  "start_col": 11
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 35,
                                  "end": 39,
                                  "start_line": 3,
                                  "start_col": 17
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 39,
                            "start_line": 3,
                            "start_col": 11
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
                                  "start": 46,
                                  "end": 50,
                                  "start_line": 4,
                                  "start_col": 4
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 51,
                                  "end": 52,
                                  "start_line": 4,
                                  "start_col": 9
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 46,
                            "end": 53,
                            "start_line": 4,
                            "start_col": 4
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
                  "end": 67,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 67,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 68,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68,
    "start_line": 1,
    "start_col": 0
  }
}
