===source===
<?php
Foo::BAR;
Foo::$instance;
Foo::create();
self::$x;
parent::__construct();
static::factory();
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
                "name": "BAR",
                "span": {
                  "start": 11,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 16,
                  "end": 19
                }
              },
              "member": {
                "name": "instance",
                "span": {
                  "start": 21,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 30
          }
        }
      },
      "span": {
        "start": 16,
        "end": 31
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
                  "start": 32,
                  "end": 35
                }
              },
              "method": {
                "name": "create",
                "span": {
                  "start": 37,
                  "end": 43
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 32,
            "end": 45
          }
        }
      },
      "span": {
        "start": 32,
        "end": 46
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Identifier": "self"
                },
                "span": {
                  "start": 47,
                  "end": 51
                }
              },
              "member": {
                "name": "x",
                "span": {
                  "start": 53,
                  "end": 55
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 55
          }
        }
      },
      "span": {
        "start": 47,
        "end": 56
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "parent"
                },
                "span": {
                  "start": 57,
                  "end": 63
                }
              },
              "method": {
                "name": "__construct",
                "span": {
                  "start": 65,
                  "end": 76
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 57,
            "end": 78
          }
        }
      },
      "span": {
        "start": 57,
        "end": 79
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
                  "start": 80,
                  "end": 86
                }
              },
              "method": {
                "name": "factory",
                "span": {
                  "start": 88,
                  "end": 95
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 80,
            "end": 97
          }
        }
      },
      "span": {
        "start": 80,
        "end": 98
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 98
  }
}
