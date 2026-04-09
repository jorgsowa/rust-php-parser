===source===
<?php $x = "{$obj->items[0]->name}"; 
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
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "PropertyAccess": {
                                        "object": {
                                          "kind": {
                                            "Variable": "obj"
                                          },
                                          "span": {
                                            "start": 13,
                                            "end": 17,
                                            "start_line": 1,
                                            "start_col": 13
                                          }
                                        },
                                        "property": {
                                          "kind": {
                                            "Identifier": "items"
                                          },
                                          "span": {
                                            "start": 19,
                                            "end": 24,
                                            "start_line": 1,
                                            "start_col": 19
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 24,
                                      "start_line": 1,
                                      "start_col": 13
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 25,
                                      "end": 26,
                                      "start_line": 1,
                                      "start_col": 25
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 13,
                                "end": 27,
                                "start_line": 1,
                                "start_col": 13
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "name"
                              },
                              "span": {
                                "start": 29,
                                "end": 33,
                                "start_line": 1,
                                "start_col": 29
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 13
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 35,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
