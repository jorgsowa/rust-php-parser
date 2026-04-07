===source===
<?php [[$a, $b], [$c, $d]] = $arr;
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 8,
                                  "end": 10
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 8,
                                "end": 10
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 12,
                                  "end": 14
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 12,
                                "end": 14
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 7,
                          "end": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 15
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 18,
                                  "end": 20
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 18,
                                "end": 20
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 22,
                                  "end": 24
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 22,
                                "end": 24
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 17,
                          "end": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 17,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 29,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
