===source===
<?php
$e = new \Exception('error');
\App\Services\Logger::log('msg');
$x = \strlen('hello');
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
                  "Variable": "e"
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
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "\\Exception"
                      },
                      "span": {
                        "start": 15,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 9
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "error"
                          },
                          "span": {
                            "start": 26,
                            "end": 33,
                            "start_line": 2,
                            "start_col": 20
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 26,
                          "end": 33,
                          "start_line": 2,
                          "start_col": 20
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "\\App\\Services\\Logger"
                },
                "span": {
                  "start": 36,
                  "end": 56,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "method": "log",
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "msg"
                    },
                    "span": {
                      "start": 62,
                      "end": 67,
                      "start_line": 3,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 62,
                    "end": 67,
                    "start_line": 3,
                    "start_col": 26
                  }
                }
              ]
            }
          },
          "span": {
            "start": 36,
            "end": 68,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 36,
        "end": 70,
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
                  "Variable": "x"
                },
                "span": {
                  "start": 70,
                  "end": 72,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "\\strlen"
                      },
                      "span": {
                        "start": 75,
                        "end": 82,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "hello"
                          },
                          "span": {
                            "start": 83,
                            "end": 90,
                            "start_line": 4,
                            "start_col": 13
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 83,
                          "end": 90,
                          "start_line": 4,
                          "start_col": 13
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 75,
                  "end": 91,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 91,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 70,
        "end": 92,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92,
    "start_line": 1,
    "start_col": 0
  }
}
