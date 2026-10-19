===source===
<?php
list($a, $b, $c) = getValues();
list($x, , $z) = $array;
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
                            "start": 11,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
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
                            "start": 15,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 17
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 19,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "getValues"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 25,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 34
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 25,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
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
                            "Variable": "x"
                          },
                          "span": {
                            "start": 43,
                            "end": 45
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 45
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 47,
                            "end": 48
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 48
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "z"
                          },
                          "span": {
                            "start": 49,
                            "end": 51
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 51
                      }
                    }
                  ]
                },
                "span": {
                  "start": 38,
                  "end": 52
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "array"
                },
                "span": {
                  "start": 55,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 38,
            "end": 61
          }
        }
      },
      "span": {
        "start": 38,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
