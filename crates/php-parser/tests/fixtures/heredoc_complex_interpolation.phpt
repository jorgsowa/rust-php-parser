===source===
<?php
$x = <<<EOT
Hello {$obj->getName()}
Item: {$arr[0]['key']}
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
                            "MethodCall": {
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
                              "method": {
                                "kind": {
                                  "Identifier": "getName"
                                },
                                "span": {
                                  "start": 31,
                                  "end": 38,
                                  "start_line": 3,
                                  "start_col": 13
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 25,
                            "end": 40,
                            "start_line": 3,
                            "start_col": 7
                          }
                        }
                      },
                      {
                        "Literal": "\nItem: "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "arr"
                                      },
                                      "span": {
                                        "start": 49,
                                        "end": 53,
                                        "start_line": 4,
                                        "start_col": 7
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 54,
                                        "end": 55,
                                        "start_line": 4,
                                        "start_col": 12
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 49,
                                  "end": 56,
                                  "start_line": 4,
                                  "start_col": 7
                                }
                              },
                              "index": {
                                "kind": {
                                  "String": "key"
                                },
                                "span": {
                                  "start": 57,
                                  "end": 62,
                                  "start_line": 4,
                                  "start_col": 15
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 49,
                            "end": 63,
                            "start_line": 4,
                            "start_col": 7
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 68,
                  "start_line": 2,
                  "start_col": 5
                }
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
      },
      "span": {
        "start": 6,
        "end": 69,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69,
    "start_line": 1,
    "start_col": 0
  }
}
