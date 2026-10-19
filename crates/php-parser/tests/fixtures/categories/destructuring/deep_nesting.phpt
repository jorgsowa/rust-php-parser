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
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 12,
                                      "end": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 14
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Array": [
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "c"
                                              },
                                              "span": {
                                                "start": 17,
                                                "end": 19
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 17,
                                            "end": 19
                                          }
                                        },
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": null,
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "d"
                                                        },
                                                        "span": {
                                                          "start": 22,
                                                          "end": 24
                                                        }
                                                      }
                                                    },
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
                                            }
                                          },
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
                                  }
                                },
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
                        }
                      },
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
