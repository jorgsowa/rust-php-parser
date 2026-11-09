===source===
<?php
class P {
    public $p;
}
class C extends P {
    #[\Override] public $p;
}
===errors 8.3-8.4===
Attribute "Override" cannot target property (allowed targets: method)
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target property (allowed targets: method) in Standard input code on line 6
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
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 29
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 39,
              "end": 40
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
              "start": 49,
              "end": 50
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
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
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 29
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 39,
              "end": 40
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
              "start": 49,
              "end": 50
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 77,
                      "end": 79
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 59,
                          "end": 68
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 59,
                        "end": 68
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 57,
                "end": 79
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
