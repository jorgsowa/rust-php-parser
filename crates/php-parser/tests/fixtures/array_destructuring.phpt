===source===
<?php
[$a, $b] = $pair;
[$first, , $third] = $arr;
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
                            "Variable": "b"
                          },
                          "span": {
                            "start": 11,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "pair"
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
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
                            "Variable": "first"
                          },
                          "span": {
                            "start": 25,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 31
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 33,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "third"
                          },
                          "span": {
                            "start": 35,
                            "end": 41
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 41
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 42
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 45,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 49
          }
        }
      },
      "span": {
        "start": 24,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
