===source===
<?php
$obj->method(1);
$obj?->method(1);
Foo::bar(1);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 12,
                  "end": 18
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
                      "start": 19,
                      "end": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 19,
                    "end": 20
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 23,
                  "end": 27
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 30,
                  "end": 36
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
                      "start": 37,
                      "end": 38
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 37,
                    "end": 38
                  }
                }
              ]
            }
          },
          "span": {
            "start": 23,
            "end": 39
          }
        }
      },
      "span": {
        "start": 23,
        "end": 40
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
                  "start": 41,
                  "end": 44
                }
              },
              "method": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 46,
                  "end": 49
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
                      "start": 50,
                      "end": 51
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 50,
                    "end": 51
                  }
                }
              ]
            }
          },
          "span": {
            "start": 41,
            "end": 52
          }
        }
      },
      "span": {
        "start": 41,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
