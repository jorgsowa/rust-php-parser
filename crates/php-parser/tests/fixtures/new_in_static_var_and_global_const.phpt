===config===
min_php=8.1
===source===
<?php
const C = new Foo();
const D = 1, E = new Bar(1, 2);

function f() {
    static $a = new Cache();
    static $b = new Store(), $c = new Other();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "C",
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Identifier": "Foo"
                    },
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
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
    {
      "kind": {
        "Const": [
          {
            "name": "D",
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 37,
                "end": 38
              }
            },
            "attributes": [],
            "span": {
              "start": 33,
              "end": 38
            }
          },
          {
            "name": "E",
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Identifier": "Bar"
                    },
                    "span": {
                      "start": 48,
                      "end": 51
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 52,
                          "end": 53
                        }
                      },
                      "unpack": false,
                      "by_ref": false,
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    },
                    {
                      "name": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 55,
                          "end": 56
                        }
                      },
                      "unpack": false,
                      "by_ref": false,
                      "span": {
                        "start": 55,
                        "end": 56
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 44,
                "end": 57
              }
            },
            "attributes": [],
            "span": {
              "start": 40,
              "end": 57
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 58
      }
    },
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "a",
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Identifier": "Cache"
                            },
                            "span": {
                              "start": 95,
                              "end": 100
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 102
                      }
                    },
                    "span": {
                      "start": 86,
                      "end": 102
                    }
                  }
                ]
              },
              "span": {
                "start": 79,
                "end": 103
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "b",
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Identifier": "Store"
                            },
                            "span": {
                              "start": 124,
                              "end": 129
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 120,
                        "end": 131
                      }
                    },
                    "span": {
                      "start": 115,
                      "end": 131
                    }
                  },
                  {
                    "name": "c",
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Identifier": "Other"
                            },
                            "span": {
                              "start": 142,
                              "end": 147
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 149
                      }
                    },
                    "span": {
                      "start": 133,
                      "end": 149
                    }
                  }
                ]
              },
              "span": {
                "start": 108,
                "end": 150
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 60,
        "end": 152
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 152
  }
}
