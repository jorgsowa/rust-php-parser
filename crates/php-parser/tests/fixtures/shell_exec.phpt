===source===
<?php
$out = `ls -la`;
$cmd = `echo $var`;
$complex = `{$obj->getCmd()} --flag`;
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
                  "Variable": "out"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Literal": "ls -la"
                    }
                  ]
                },
                "span": {
                  "start": 13,
                  "end": 21,
                  "start_line": 2,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "cmd"
                },
                "span": {
                  "start": 23,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Literal": "echo "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "var"
                        },
                        "span": {
                          "start": 36,
                          "end": 40,
                          "start_line": 3,
                          "start_col": 13
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 30,
                  "end": 41,
                  "start_line": 3,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 41,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 23,
        "end": 43,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "complex"
                },
                "span": {
                  "start": 43,
                  "end": 51,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 56,
                                "end": 60,
                                "start_line": 4,
                                "start_col": 13
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getCmd"
                              },
                              "span": {
                                "start": 62,
                                "end": 68,
                                "start_line": 4,
                                "start_col": 19
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 70,
                          "start_line": 4,
                          "start_col": 13
                        }
                      }
                    },
                    {
                      "Literal": " --flag"
                    }
                  ]
                },
                "span": {
                  "start": 54,
                  "end": 79,
                  "start_line": 4,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 79,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 80,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80,
    "start_line": 1,
    "start_col": 0
  }
}
