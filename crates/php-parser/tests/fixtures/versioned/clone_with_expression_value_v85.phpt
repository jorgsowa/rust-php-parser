===config===
min_php=8.5
===source===
<?php $b = clone($obj, ['prop' => 1 + 2]);
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
                                "String": "prop"
                              },
                              "span": {
                                "start": 24,
                                "end": 30
                              }
                            },
                            "value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 34,
                                      "end": 35
                                    }
                                  },
                                  "op": "Add",
                                  "right": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 38,
                                      "end": 39
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 34,
                                "end": 39
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 24,
                              "end": 39
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 40
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 41
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
