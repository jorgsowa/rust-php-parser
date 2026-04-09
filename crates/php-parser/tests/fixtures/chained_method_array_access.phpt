===source===
<?php $obj->getItems()[0]->name; $a->b()['key']->c();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
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
                              "Identifier": "getItems"
                            },
                            "span": {
                              "start": 12,
                              "end": 20,
                              "start_line": 1,
                              "start_col": 12
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 23,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "property": {
                "kind": {
                  "Identifier": "name"
                },
                "span": {
                  "start": 27,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 33,
                              "end": 35,
                              "start_line": 1,
                              "start_col": 33
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 37,
                              "end": 38,
                              "start_line": 1,
                              "start_col": 37
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 40,
                        "start_line": 1,
                        "start_col": 33
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "key"
                      },
                      "span": {
                        "start": 41,
                        "end": 46,
                        "start_line": 1,
                        "start_col": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 47,
                  "start_line": 1,
                  "start_col": 33
                }
              },
              "method": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 49,
                  "end": 50,
                  "start_line": 1,
                  "start_col": 49
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 33,
            "end": 52,
            "start_line": 1,
            "start_col": 33
          }
        }
      },
      "span": {
        "start": 33,
        "end": 53,
        "start_line": 1,
        "start_col": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
