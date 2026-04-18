===config===
min_php=8.5
===source===
<?php $b = clone($obj, ['prop' => ['nested' => 1]]);
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
                                "Array": [
                                  {
                                    "key": {
                                      "kind": {
                                        "String": "nested"
                                      },
                                      "span": {
                                        "start": 35,
                                        "end": 43
                                      }
                                    },
                                    "value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 47,
                                        "end": 48
                                      }
                                    },
                                    "unpack": false,
                                    "span": {
                                      "start": 35,
                                      "end": 48
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 34,
                                "end": 49
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 24,
                              "end": 49
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 50
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 51
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
