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
                  "end": 10
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
                      "end": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 13
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
                      "end": 17
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 15,
                    "end": 17
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 20
          }
        }
      },
      "span": {
        "start": 7,
        "end": 21
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
                  "end": 26
                }
              },
              "method": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 28,
                  "end": 31
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
                      "end": 34
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 32,
                    "end": 34
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
                      "end": 38
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 36,
                    "end": 38
                  }
                }
              ]
            }
          },
          "span": {
            "start": 22,
            "end": 41
          }
        }
      },
      "span": {
        "start": 22,
        "end": 42
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
                  "end": 46
                }
              },
              "method": {
                "parts": [
                  "bar"
                ],
                "kind": "Unqualified",
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
                      "Variable": "a"
                    },
                    "span": {
                      "start": 52,
                      "end": 54
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 52,
                    "end": 54
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
                      "end": 58
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 56,
                    "end": 58
                  }
                }
              ]
            }
          },
          "span": {
            "start": 43,
            "end": 61
          }
        }
      },
      "span": {
        "start": 43,
        "end": 62
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
                  "end": 70
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
                      "end": 73
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 71,
                    "end": 73
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
                      "end": 77
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 75,
                    "end": 77
                  }
                }
              ]
            }
          },
          "span": {
            "start": 63,
            "end": 80
          }
        }
      },
      "span": {
        "start": 63,
        "end": 81
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
              "end": 90
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 92,
              "end": 94
            }
          }
        ]
      },
      "span": {
        "start": 82,
        "end": 98
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
                  "end": 107
                }
              },
              {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 109,
                  "end": 111
                }
              }
            ]
          },
          "span": {
            "start": 99,
            "end": 114
          }
        }
      },
      "span": {
        "start": 99,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}
