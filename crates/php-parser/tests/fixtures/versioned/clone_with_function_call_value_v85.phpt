===config===
min_php=8.5
===source===
<?php $b = clone($obj, ['prop' => strtolower('A')]);
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
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Identifier": "strtolower"
                                    },
                                    "span": {
                                      "start": 34,
                                      "end": 44
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": "A"
                                        },
                                        "span": {
                                          "start": 45,
                                          "end": 48
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 45,
                                        "end": 48
                                      }
                                    }
                                  ]
                                }
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
