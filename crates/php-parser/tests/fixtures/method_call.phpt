===source===
<?php $obj->getName(); $builder->setName('foo')->build();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "getName"
                },
                "span": {
                  "start": 12,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "builder"
                      },
                      "span": {
                        "start": 23,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 23
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "setName"
                      },
                      "span": {
                        "start": 33,
                        "end": 40,
                        "start_line": 1,
                        "start_col": 33
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "foo"
                          },
                          "span": {
                            "start": 41,
                            "end": 46,
                            "start_line": 1,
                            "start_col": 41
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 41,
                          "end": 46,
                          "start_line": 1,
                          "start_col": 41
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 23,
                  "end": 47,
                  "start_line": 1,
                  "start_col": 23
                }
              },
              "method": {
                "kind": {
                  "Identifier": "build"
                },
                "span": {
                  "start": 49,
                  "end": 54,
                  "start_line": 1,
                  "start_col": 49
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 23,
            "end": 56,
            "start_line": 1,
            "start_col": 23
          }
        }
      },
      "span": {
        "start": 23,
        "end": 57,
        "start_line": 1,
        "start_col": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57,
    "start_line": 1,
    "start_col": 0
  }
}
