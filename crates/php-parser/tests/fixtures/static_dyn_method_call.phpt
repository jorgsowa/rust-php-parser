===source===
<?php

Foo::$method();
Foo::$method(1, 2);
static::$fn();
$obj::$fn();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 7,
                  "end": 10
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 12,
                  "end": 19
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 21
          }
        }
      },
      "span": {
        "start": 7,
        "end": 22
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 28,
                  "end": 35
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
                      "start": 36,
                      "end": 37
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 36,
                    "end": 37
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 39,
                    "end": 40
                  }
                }
              ]
            }
          },
          "span": {
            "start": 23,
            "end": 41
          }
        }
      },
      "span": {
        "start": 23,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 43,
                  "end": 49
                }
              },
              "method": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 51,
                  "end": 54
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 43,
            "end": 56
          }
        }
      },
      "span": {
        "start": 43,
        "end": 57
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 58,
                  "end": 62
                }
              },
              "method": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 64,
                  "end": 67
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 58,
            "end": 69
          }
        }
      },
      "span": {
        "start": 58,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
