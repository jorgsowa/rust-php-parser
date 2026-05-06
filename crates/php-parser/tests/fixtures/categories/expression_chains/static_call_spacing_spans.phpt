===source===
<?php
// Bug #5: Function call span should cover full call including args
foo(1, 2);

// Bug #6: Static call with whitespace
Math :: sqrt(4);

// Bug #7: Nullsafe property access
$obj?->prop;
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
                  "start": 74,
                  "end": 77
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
                      "start": 78,
                      "end": 79
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 78,
                    "end": 79
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 81,
                      "end": 82
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 81,
                    "end": 82
                  }
                }
              ]
            }
          },
          "span": {
            "start": 74,
            "end": 83
          }
        }
      },
      "span": {
        "start": 74,
        "end": 84
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Math"
                },
                "span": {
                  "start": 125,
                  "end": 129
                }
              },
              "method": {
                "kind": {
                  "Identifier": "sqrt"
                },
                "span": {
                  "start": 133,
                  "end": 137
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 138,
                      "end": 139
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 138,
                    "end": 139
                  }
                }
              ]
            }
          },
          "span": {
            "start": 125,
            "end": 140
          }
        }
      },
      "span": {
        "start": 125,
        "end": 141
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 179,
                  "end": 183
                }
              },
              "property": {
                "kind": {
                  "Identifier": "prop"
                },
                "span": {
                  "start": 186,
                  "end": 190
                }
              }
            }
          },
          "span": {
            "start": 179,
            "end": 190
          }
        }
      },
      "span": {
        "start": 179,
        "end": 191
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 191
  }
}
