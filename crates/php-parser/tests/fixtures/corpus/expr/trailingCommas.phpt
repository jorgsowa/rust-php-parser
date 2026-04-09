===source===
<?php

foo($a, $b, );
$foo->bar($a, $b, );
Foo::bar($a, $b, );
new Foo($a, $b, );
unset($a, $b, );
isset($a, $b, );
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 7,
                  "end": 10,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 11,
                      "end": 13,
                      "start_line": 3,
                      "start_col": 4
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 13,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 15,
                      "end": 17,
                      "start_line": 3,
                      "start_col": 8
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 15,
                    "end": 17,
                    "start_line": 3,
                    "start_col": 8
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 20,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 22,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 22,
                  "end": 26,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 28,
                  "end": 31,
                  "start_line": 4,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 32,
                      "end": 34,
                      "start_line": 4,
                      "start_col": 10
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 32,
                    "end": 34,
                    "start_line": 4,
                    "start_col": 10
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 36,
                      "end": 38,
                      "start_line": 4,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 36,
                    "end": 38,
                    "start_line": 4,
                    "start_col": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 22,
            "end": 41,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 43,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 43,
                  "end": 46,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "method": "bar",
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 52,
                      "end": 54,
                      "start_line": 5,
                      "start_col": 9
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 52,
                    "end": 54,
                    "start_line": 5,
                    "start_col": 9
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 56,
                      "end": 58,
                      "start_line": 5,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 56,
                    "end": 58,
                    "start_line": 5,
                    "start_col": 13
                  }
                }
              ]
            }
          },
          "span": {
            "start": 43,
            "end": 61,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 63,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 67,
                  "end": 70,
                  "start_line": 6,
                  "start_col": 4
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 71,
                      "end": 73,
                      "start_line": 6,
                      "start_col": 8
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 71,
                    "end": 73,
                    "start_line": 6,
                    "start_col": 8
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 75,
                      "end": 77,
                      "start_line": 6,
                      "start_col": 12
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 75,
                    "end": 77,
                    "start_line": 6,
                    "start_col": 12
                  }
                }
              ]
            }
          },
          "span": {
            "start": 63,
            "end": 80,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 63,
        "end": 82,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 88,
              "end": 90,
              "start_line": 7,
              "start_col": 6
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 92,
              "end": 94,
              "start_line": 7,
              "start_col": 10
            }
          }
        ]
      },
      "span": {
        "start": 82,
        "end": 99,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 105,
                  "end": 107,
                  "start_line": 8,
                  "start_col": 6
                }
              },
              {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 109,
                  "end": 111,
                  "start_line": 8,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 99,
            "end": 114,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 99,
        "end": 115,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115,
    "start_line": 1,
    "start_col": 0
  }
}
