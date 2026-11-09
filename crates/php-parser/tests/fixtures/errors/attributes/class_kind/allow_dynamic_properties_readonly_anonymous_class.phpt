===source===
<?php
$b = new #[AllowDynamicProperties] readonly class {};
===errors <=7.4===
expected identifier, found end of file
===errors 8.0-8.1===
'readonly anonymous classes' requires PHP 8.3 or higher
===errors 8.2===
'readonly anonymous classes' requires PHP 8.3 or higher
Cannot apply #[AllowDynamicProperties] to readonly class class@anonymous
===errors 8.3-8.4===
Cannot apply #[AllowDynamicProperties] to readonly class class@anonymous
===errors >=8.5===
Cannot apply #[\AllowDynamicProperties] to readonly class class@anonymous
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "class" or "#[" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly", expecting "class" or "#[" in Standard input code on line 2
===php_error 8.3-8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to readonly class class@anonymous in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\AllowDynamicProperties] to readonly class class@anonymous in Standard input code on line 2
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
                  "Variable": "b"
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
                  "Variable": "b"
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
                            "is_readonly": true
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "AllowDynamicProperties"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 39
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 17,
                                "end": 39
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 58
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 58
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 58
          }
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
