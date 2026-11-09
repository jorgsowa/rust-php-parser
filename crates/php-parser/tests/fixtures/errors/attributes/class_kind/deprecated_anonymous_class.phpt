===source===
<?php
$a = new #[Deprecated] class {};
===errors <=7.4===
expected identifier, found end of file
===errors 8.4===
Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)
===errors >=8.5===
Cannot apply #[\Deprecated] to class class@anonymous
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Deprecated] to class class@anonymous in Standard input code on line 2
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
                  "Variable": "a"
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
                  "Variable": "a"
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
                                  "Deprecated"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 27
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 17,
                                "end": 27
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 37
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
