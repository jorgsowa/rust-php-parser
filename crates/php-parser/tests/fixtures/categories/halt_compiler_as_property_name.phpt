===source===
<?php
$obj->__halt_compiler = 1;
echo $obj->__halt_compiler, $obj->__HALT_COMPILER(), $obj?->__halt_compiler, "$obj->__halt_compiler";
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 6,
                        "end": 10
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "__halt_compiler"
                      },
                      "span": {
                        "start": 12,
                        "end": 27
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 30,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "obj"
                  },
                  "span": {
                    "start": 38,
                    "end": 42
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "__halt_compiler"
                  },
                  "span": {
                    "start": 44,
                    "end": 59
                  }
                }
              }
            },
            "span": {
              "start": 38,
              "end": 59
            }
          },
          {
            "kind": {
              "MethodCall": {
                "object": {
                  "kind": {
                    "Variable": "obj"
                  },
                  "span": {
                    "start": 61,
                    "end": 65
                  }
                },
                "method": {
                  "kind": {
                    "Identifier": "__HALT_COMPILER"
                  },
                  "span": {
                    "start": 67,
                    "end": 82
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 61,
              "end": 84
            }
          },
          {
            "kind": {
              "NullsafePropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "obj"
                  },
                  "span": {
                    "start": 86,
                    "end": 90
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "__halt_compiler"
                  },
                  "span": {
                    "start": 93,
                    "end": 108
                  }
                }
              }
            },
            "span": {
              "start": 86,
              "end": 108
            }
          },
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 111,
                            "end": 115
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "__halt_compiler"
                          },
                          "span": {
                            "start": 117,
                            "end": 132
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 111,
                      "end": 132
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 110,
              "end": 133
            }
          }
        ]
      },
      "span": {
        "start": 33,
        "end": 134
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134
  }
}
