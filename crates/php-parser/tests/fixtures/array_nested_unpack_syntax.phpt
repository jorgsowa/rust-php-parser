===source===
<?php [...[...[1, 2]], 3];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "kind": {
                            "Spread": {
                              "kind": {
                                "Array": [
                                  {
                                    "key": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 15,
                                          "end": 16
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 15,
                                      "end": 16
                                    }
                                  },
                                  {
                                    "key": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 18,
                                          "end": 19
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 18,
                                      "end": 19
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 14,
                                "end": 20
                              }
                            }
                          },
                          "span": {
                            "start": 11,
                            "end": 20
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 10,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 21
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 23,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 24
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
