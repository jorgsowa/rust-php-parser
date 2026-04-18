===config===
min_php=8.5
===source===
<?php $b = clone($obj, ['a' => 1, 'b' => 2, 'c' => 3]);
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
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 17,
                        "end": 21
                      }
                    },
                    {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 24,
                                "end": 27
                              }
                            },
                            "value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 31,
                                "end": 32
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 24,
                              "end": 32
                            }
                          },
                          {
                            "key": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 34,
                                "end": 37
                              }
                            },
                            "value": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 41,
                                "end": 42
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 34,
                              "end": 42
                            }
                          },
                          {
                            "key": {
                              "kind": {
                                "String": "c"
                              },
                              "span": {
                                "start": 44,
                                "end": 47
                              }
                            },
                            "value": {
                              "kind": {
                                "Int": 3
                              },
                              "span": {
                                "start": 51,
                                "end": 52
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 44,
                              "end": 52
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 53
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 54
          }
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
