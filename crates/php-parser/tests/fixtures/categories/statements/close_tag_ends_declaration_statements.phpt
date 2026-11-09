===source===
<?php namespace A ?>
<?php use B\C ?>
<?php const X = 1 ?>
<?php function f() { global $a ?><?php static $b ?><?php unset($a) ?><?php goto l ?><?php l: }
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
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "B",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 31,
                  "end": 34
                }
              },
              "alias": null,
              "span": {
                "start": 31,
                "end": 34
              }
            }
          ]
        }
      },
      "span": {
        "start": 27,
        "end": 34
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "X",
              "span": {
                "start": 50,
                "end": 51
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 54,
                "end": 55
              }
            },
            "attributes": [],
            "span": {
              "start": 50,
              "end": 55
            }
          }
        ]
      },
      "span": {
        "start": 44,
        "end": 55
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 74,
              "end": 75
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 87,
                      "end": 89
                    }
                  }
                ]
              },
              "span": {
                "start": 80,
                "end": 89
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 105,
                        "end": 107
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 105,
                      "end": 107
                    }
                  }
                ]
              },
              "span": {
                "start": 98,
                "end": 107
              }
            },
            {
              "kind": {
                "Unset": [
                  {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 122,
                      "end": 124
                    }
                  }
                ]
              },
              "span": {
                "start": 116,
                "end": 125
              }
            },
            {
              "kind": {
                "Goto": {
                  "name": "l",
                  "span": {
                    "start": 139,
                    "end": 140
                  }
                }
              },
              "span": {
                "start": 134,
                "end": 140
              }
            },
            {
              "kind": {
                "Label": {
                  "name": "l",
                  "span": {
                    "start": 149,
                    "end": 150
                  }
                }
              },
              "span": {
                "start": 149,
                "end": 151
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 65,
        "end": 153
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 153
  }
}
