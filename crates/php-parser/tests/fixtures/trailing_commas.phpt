===source===
<?php
$arr = [1, 2, 3,];
foo($a, $b, $c,);
function bar($x, $y,) {}
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
                  "Variable": "arr"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 14,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 15
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
                            "start": 17,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 18
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
                            "start": 20,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 13,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 25,
                      "end": 28
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 28
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 29,
                        "end": 31
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 31
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 33,
                        "end": 35
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 35
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    }
                  },
                  "span": {
                    "start": 37,
                    "end": 39
                  }
                }
              ]
            }
          },
          "span": {
            "start": 25,
            "end": 41
          }
        }
      },
      "span": {
        "start": 25,
        "end": 42
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "bar",
            "span": {
              "start": 52,
              "end": 55
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 56,
                  "end": 58
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 56,
                "end": 58
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 60,
                  "end": 62
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 60,
                "end": 62
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
