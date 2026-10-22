===source===
<?php
#[DelayedTargetValidation] #[NoDiscard] class C {
    #[DelayedTargetValidation] #[NoDiscard] public $p;
    #[DelayedTargetValidation] #[NoDiscard] const X = 1;
}
===errors <=7.4===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting end of file in Standard input code on line 5
===ast <=7.4===
{
  "stmts": [
    {
      "kind": "Error",
      "span": {
        "start": 168,
        "end": 168
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 168
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 52,
              "end": 53
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
                      "start": 107,
                      "end": 109
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
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 62,
                          "end": 85
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 62,
                        "end": 85
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 89,
                          "end": 98
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 89,
                        "end": 98
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 60,
                "end": 109
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 161,
                      "end": 162
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 165,
                      "end": 166
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 117,
                          "end": 140
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 117,
                        "end": 140
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 144,
                          "end": 153
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 144,
                        "end": 153
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 115,
                "end": 167
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 31
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 31
              }
            },
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 35,
                  "end": 44
                }
              },
              "args": [],
              "span": {
                "start": 35,
                "end": 44
              }
            }
          ]
        }
      },
      "span": {
        "start": 46,
        "end": 169
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 169
  }
}
