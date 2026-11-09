===source===
<?php
$e = new #[NoDiscard] class {};
===errors <=7.4===
expected identifier, found end of file
===errors >=8.5===
Attribute "NoDiscard" cannot target class (allowed targets: function, method)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Attribute "NoDiscard" cannot target class (allowed targets: function, method) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": "Error",
                      "span": {
                        "start": 14,
                        "end": 14
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "NoDiscard"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 26
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 17,
                                "end": 26
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 36
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
