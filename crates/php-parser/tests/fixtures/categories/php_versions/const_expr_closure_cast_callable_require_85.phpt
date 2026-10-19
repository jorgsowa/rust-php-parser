===source===
<?php
const A = static function () {};
const B = strlen(...);
const C = (int) "1";
===errors 8.4===
'closures in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'casts in constant expressions' requires PHP 8.5 or higher
===ast 8.4===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": true,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 37
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 38
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 45,
                "end": 46
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "strlen"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 49,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 55
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 60
              }
            },
            "attributes": [],
            "span": {
              "start": 45,
              "end": 60
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 61
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 68,
                "end": 69
              }
            },
            "value": {
              "kind": {
                "Cast": [
                  "Int",
                  {
                    "kind": {
                      "String": "1"
                    },
                    "span": {
                      "start": 78,
                      "end": 81
                    }
                  }
                ]
              },
              "span": {
                "start": 72,
                "end": 81
              }
            },
            "attributes": [],
            "span": {
              "start": 68,
              "end": 81
            }
          }
        ]
      },
      "span": {
        "start": 62,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
