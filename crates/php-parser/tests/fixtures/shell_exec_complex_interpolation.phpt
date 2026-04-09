===source===
<?php
$a = `ls {$dirs['home']}`;
$b = `{$obj->getCommand()} --flag=$value`;
$c = `echo $arr[0]`;
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
                  "Variable": "a"
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
                  "ShellExec": [
                    {
                      "Literal": "ls "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "dirs"
                              },
                              "span": {
                                "start": 16,
                                "end": 21,
                                "start_line": 2,
                                "start_col": 10
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "home"
                              },
                              "span": {
                                "start": 22,
                                "end": 28,
                                "start_line": 2,
                                "start_col": 16
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 16,
                          "end": 29,
                          "start_line": 2,
                          "start_col": 10
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 31,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33,
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
                  "Variable": "b"
                },
                "span": {
                  "start": 33,
                  "end": 35,
                  "start_line": 3,
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
                                "start": 40,
                                "end": 44,
                                "start_line": 3,
                                "start_col": 7
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getCommand"
                              },
                              "span": {
                                "start": 46,
                                "end": 56,
                                "start_line": 3,
                                "start_col": 13
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 40,
                          "end": 58,
                          "start_line": 3,
                          "start_col": 7
                        }
                      }
                    },
                    {
                      "Literal": " --flag="
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 67,
                          "end": 73,
                          "start_line": 3,
                          "start_col": 34
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 38,
                  "end": 74,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 74,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 76,
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
                  "Variable": "c"
                },
                "span": {
                  "start": 76,
                  "end": 78,
                  "start_line": 4,
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
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 87,
                                "end": 91,
                                "start_line": 4,
                                "start_col": 11
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 92,
                                "end": 93,
                                "start_line": 4,
                                "start_col": 16
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 87,
                          "end": 94,
                          "start_line": 4,
                          "start_col": 11
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 81,
                  "end": 95,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 76,
            "end": 95,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 76,
        "end": 96,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96,
    "start_line": 1,
    "start_col": 0
  }
}
