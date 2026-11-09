===source===
<?php
foreach ($x as [list($a)]) {}
foreach ($x as $k => list([$a])) {}
===errors===
Cannot mix [] and list()
Cannot mix [] and list()
===php_error===
PHP Fatal error:  Cannot mix [] and list() in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
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
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 27,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 27,
                              "end": 29
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 22,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 21,
              "end": 31
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 33,
              "end": 35
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 45,
              "end": 47
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 51,
              "end": 53
            }
          },
          "value": {
            "kind": {
              "Array": [
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
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 63,
                                  "end": 65
                                }
                              }
                            },
                            "span": {
                              "start": 63,
                              "end": 65
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 62,
                        "end": 66
                      }
                    }
                  },
                  "span": {
                    "start": 62,
                    "end": 66
                  }
                }
              ]
            },
            "span": {
              "start": 57,
              "end": 67
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 69,
              "end": 71
            }
          }
        }
      },
      "span": {
        "start": 36,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
