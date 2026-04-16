===source===
<?php Foo::class; self::class; static::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "member": {
                "name": "class",
                "span": {
                  "start": 11,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "self"
                },
                "span": {
                  "start": 18,
                  "end": 22
                }
              },
              "member": {
                "name": "class",
                "span": {
                  "start": 24,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 29
          }
        }
      },
      "span": {
        "start": 18,
        "end": 30
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
                  "start": 31,
                  "end": 37
                }
              },
              "member": {
                "name": "class",
                "span": {
                  "start": 39,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 44
          }
        }
      },
      "span": {
        "start": 31,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
