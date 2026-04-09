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
                        "end": 14,
                        "start_line": 1,
                        "start_col": 12
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "key"
                      },
                      "span": {
                        "start": 15,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 12
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
                        "end": 25,
                        "start_line": 1,
                        "start_col": 23
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "prop"
                      },
                      "span": {
                        "start": 27,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 27
                      }
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 23
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
                        "end": 35,
                        "start_line": 1,
                        "start_col": 33
                      }
                    },
                    "member": "static"
                  }
                },
                "span": {
                  "start": 33,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 33
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 45,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
