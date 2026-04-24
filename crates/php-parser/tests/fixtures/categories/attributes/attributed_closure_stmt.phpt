===source===
<?php
#[A] function() {};
#[A] fn() => 42;
#[A] static function() {};
#[A] static fn() => 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [],
              "return_type": null,
              "body": [],
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 8,
                      "end": 9
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 8,
                    "end": 9
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "return_type": null,
              "body": {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 39,
                  "end": 41
                }
              },
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 28,
                    "end": 29
                  }
                }
              ]
            }
          },
          "span": {
            "start": 26,
            "end": 41
          }
        }
      },
      "span": {
        "start": 26,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": true,
              "by_ref": false,
              "params": [],
              "use_vars": [],
              "return_type": null,
              "body": [],
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 45,
                    "end": 46
                  }
                }
              ]
            }
          },
          "span": {
            "start": 43,
            "end": 68
          }
        }
      },
      "span": {
        "start": 43,
        "end": 69
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": true,
              "by_ref": false,
              "params": [],
              "return_type": null,
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 90,
                  "end": 91
                }
              },
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 72,
                      "end": 73
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 72,
                    "end": 73
                  }
                }
              ]
            }
          },
          "span": {
            "start": 70,
            "end": 91
          }
        }
      },
      "span": {
        "start": 70,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
