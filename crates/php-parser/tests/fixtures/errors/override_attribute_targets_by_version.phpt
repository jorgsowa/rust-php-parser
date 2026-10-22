===source===
<?php
class P {
    public $p;
    const X = 1;
    function m() {}
}
class C extends P {
    #[\Override] public $p;
    #[\Override] const X = 2;
    #[\Override] function m() {}
}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
===errors 8.3-8.4===
Attribute "Override" cannot target property (allowed targets: method)
Attribute "Override" cannot target class constant (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target class constant (allowed targets: method, property)
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target property (allowed targets: method) in Standard input code on line 8
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method, property) in Standard input code on line 9
===ast===
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
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 41,
                      "end": 42
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 47
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 61,
                      "end": 62
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 67
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 76,
              "end": 77
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
              "start": 86,
              "end": 87
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
                      "start": 114,
                      "end": 116
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
                          "start": 96,
                          "end": 105
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 96,
                        "end": 105
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 94,
                "end": 116
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 141,
                      "end": 142
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 145,
                      "end": 146
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
                          "start": 124,
                          "end": 133
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 124,
                        "end": 133
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 122,
                "end": 147
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 174,
                      "end": 175
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 154,
                          "end": 163
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 154,
                        "end": 163
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 152,
                "end": 180
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 70,
        "end": 182
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 182
  }
}
