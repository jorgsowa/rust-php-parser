===source===
<?php
namespace A {
    static $a;
}
namespace B {
    static $a;
}
===errors===
Duplicate declaration of static variable $a
===php_error===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "StaticVar": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 31,
                          "end": 33
                        }
                      },
                      "default": null,
                      "span": {
                        "start": 31,
                        "end": 33
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 34
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 47,
              "end": 48
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "StaticVar": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 62,
                          "end": 64
                        }
                      },
                      "default": null,
                      "span": {
                        "start": 62,
                        "end": 64
                      }
                    }
                  ]
                },
                "span": {
                  "start": 55,
                  "end": 65
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 37,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
