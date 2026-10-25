===source===
<?php
const X = "Foo"::class;
echo ('Bar')::class, true::class, null::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "X",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "String": "Foo"
                    },
                    "span": {
                      "start": 16,
                      "end": 21
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 23,
                      "end": 28
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 28
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 28
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "String": "Bar"
                      },
                      "span": {
                        "start": 36,
                        "end": 41
                      }
                    }
                  },
                  "span": {
                    "start": 35,
                    "end": 42
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 44,
                    "end": 49
                  }
                }
              }
            },
            "span": {
              "start": 35,
              "end": 49
            }
          },
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Bool": true
                  },
                  "span": {
                    "start": 51,
                    "end": 55
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 57,
                    "end": 62
                  }
                }
              }
            },
            "span": {
              "start": 51,
              "end": 62
            }
          },
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": "Null",
                  "span": {
                    "start": 64,
                    "end": 68
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 70,
                    "end": 75
                  }
                }
              }
            },
            "span": {
              "start": 64,
              "end": 75
            }
          }
        ]
      },
      "span": {
        "start": 30,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
