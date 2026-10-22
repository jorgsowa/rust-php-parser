===source===
<?php
function f() {
    static $a;
    static $a, $b = 1, $b;
}
static $c; static $c;
===errors >=8.3===
Duplicate declaration of static variable $a
Duplicate declaration of static variable $b
Duplicate declaration of static variable $c
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 4
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 35
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 47,
                        "end": 49
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 47,
                      "end": 49
                    }
                  },
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 51,
                        "end": 53
                      }
                    },
                    "default": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 56,
                        "end": 57
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 57
                    }
                  },
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 59,
                        "end": 61
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 59,
                      "end": 61
                    }
                  }
                ]
              },
              "span": {
                "start": 40,
                "end": 62
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "c",
              "span": {
                "start": 72,
                "end": 74
              }
            },
            "default": null,
            "span": {
              "start": 72,
              "end": 74
            }
          }
        ]
      },
      "span": {
        "start": 65,
        "end": 75
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "c",
              "span": {
                "start": 83,
                "end": 85
              }
            },
            "default": null,
            "span": {
              "start": 83,
              "end": 85
            }
          }
        ]
      },
      "span": {
        "start": 76,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}
