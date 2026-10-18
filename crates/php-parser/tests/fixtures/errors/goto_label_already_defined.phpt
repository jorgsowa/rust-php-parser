===source===
<?php
a:
while (true) {
    a:
}
function f() {
    b:
    if (true) {
        b:
    }
}
===errors===
Label 'b' already defined
Label 'a' already defined
===php_error===
PHP Fatal error:  Label 'a' already defined in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "a",
          "span": {
            "start": 6,
            "end": 7
          }
        }
      },
      "span": {
        "start": 6,
        "end": 8
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 16,
              "end": 20
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "a",
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 9,
        "end": 32
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 42,
              "end": 43
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Label": {
                  "name": "b",
                  "span": {
                    "start": 52,
                    "end": 53
                  }
                }
              },
              "span": {
                "start": 52,
                "end": 54
              }
            },
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 63,
                      "end": 67
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Label": {
                              "name": "b",
                              "span": {
                                "start": 79,
                                "end": 80
                              }
                            }
                          },
                          "span": {
                            "start": 79,
                            "end": 81
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 69,
                      "end": 87
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 59,
                "end": 87
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
