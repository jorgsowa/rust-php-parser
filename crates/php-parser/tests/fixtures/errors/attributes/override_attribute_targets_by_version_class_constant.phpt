===source===
<?php
class P {
    const X = 1;
}
class C extends P {
    #[\Override] const X = 2;
}
===errors 8.3-8.4===
Attribute "Override" cannot target class constant (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target class constant (allowed targets: method, property)
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method) in Standard input code on line 6
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method, property) in Standard input code on line 6
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 41,
              "end": 42
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
            "kind": "Unqualified",
            "span": {
              "start": 51,
              "end": 52
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 35,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 41,
              "end": 42
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
            "kind": "Unqualified",
            "span": {
              "start": 51,
              "end": 52
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 78,
                      "end": 79
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 61,
                          "end": 70
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 61,
                        "end": 70
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 59,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 35,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}
