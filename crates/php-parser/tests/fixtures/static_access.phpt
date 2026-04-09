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
                  "end": 9,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "member": "BAR"
            }
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 2,
        "start_col": 0
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
                  "end": 19,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "member": "instance"
            }
          },
          "span": {
            "start": 16,
            "end": 30,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 32,
        "start_line": 3,
        "start_col": 0
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
                  "end": 35,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": "create",
              "args": []
            }
          },
          "span": {
            "start": 32,
            "end": 45,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 32,
        "end": 47,
        "start_line": 4,
        "start_col": 0
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
                  "end": 51,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "member": "x"
            }
          },
          "span": {
            "start": 47,
            "end": 55,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 47,
        "end": 57,
        "start_line": 5,
        "start_col": 0
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
                  "end": 63,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "method": "__construct",
              "args": []
            }
          },
          "span": {
            "start": 57,
            "end": 78,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 57,
        "end": 80,
        "start_line": 6,
        "start_col": 0
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
                  "end": 86,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "method": "factory",
              "args": []
            }
          },
          "span": {
            "start": 80,
            "end": 97,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 80,
        "end": 98,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 98,
    "start_line": 1,
    "start_col": 0
  }
}
