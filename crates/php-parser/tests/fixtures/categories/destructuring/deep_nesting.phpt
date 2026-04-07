===source===
<?php [$a, [$b, [$c, [$d]]]] = $arr;
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9
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
                                          "start": 17,
                                          "end": 19
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 17,
                                        "end": 19
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
                                          "start": 21,
                                          "end": 25
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 21,
                                        "end": 25
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 16,
                                  "end": 26
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 16,
                                "end": 26
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 11,
                          "end": 27
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 31,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
