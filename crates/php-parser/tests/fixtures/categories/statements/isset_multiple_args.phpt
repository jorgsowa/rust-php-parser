===source===
<?php isset($a['key'], $b->prop, $c::$static);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "key"
                      },
                      "span": {
                        "start": 15,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 21
                }
              },
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 23,
                        "end": 25
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "prop"
                      },
                      "span": {
                        "start": 27,
                        "end": 31
                      }
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 31
                }
              },
              {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 33,
                        "end": 35
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "static"
                      },
                      "span": {
                        "start": 37,
                        "end": 44
                      }
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 44
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 45
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
