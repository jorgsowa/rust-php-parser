===config===
min_php=8.4
===source===
<?php
namespace N;
class C extends \P {
    public $e = 1 { get => 2; }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 25,
              "end": 26
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "FullyQualified",
            "span": {
              "start": 35,
              "end": 37
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 51,
                      "end": 53
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 56,
                      "end": 57
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 67,
                            "end": 68
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 69
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 44,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
