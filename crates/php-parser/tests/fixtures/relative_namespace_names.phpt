===source===
<?php
namespace App\Services;
$obj = new namespace\MyClass();
namespace\helper_func();
echo namespace\SOME_CONST;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Services"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 28
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 30,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "MyClass"
                          ],
                          "kind": "Relative",
                          "span": {
                            "start": 41,
                            "end": 58
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 58
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 37,
                  "end": 60
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 60
          }
        }
      },
      "span": {
        "start": 30,
        "end": 61
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "helper_func"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 62,
                      "end": 83
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 83
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 62,
            "end": 85
          }
        }
      },
      "span": {
        "start": 62,
        "end": 86
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Name": {
                "parts": [
                  "SOME_CONST"
                ],
                "kind": "Relative",
                "span": {
                  "start": 92,
                  "end": 112
                }
              }
            },
            "span": {
              "start": 92,
              "end": 112
            }
          }
        ]
      },
      "span": {
        "start": 87,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
