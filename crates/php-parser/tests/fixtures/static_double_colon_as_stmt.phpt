===source===
<?php
static::$prop;
static::method();
static::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "member": {
                "name": "prop",
                "span": {
                  "start": 14,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 21,
                  "end": 27
                }
              },
              "method": {
                "name": "method",
                "span": {
                  "start": 29,
                  "end": 35
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 21,
            "end": 37
          }
        }
      },
      "span": {
        "start": 21,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 39,
                  "end": 45
                }
              },
              "member": {
                "name": "class",
                "span": {
                  "start": 47,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 52
          }
        }
      },
      "span": {
        "start": 39,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
