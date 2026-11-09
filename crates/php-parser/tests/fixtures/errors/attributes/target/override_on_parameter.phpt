===source===
<?php
class C {
    public function m(#[Override] $a) {}
}
===errors <=7.4===
expected variable, found '}'
===errors 8.3-8.4===
Attribute "Override" cannot target parameter (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target parameter (allowed targets: method, property)
===errors >=8.6===
Attribute "Override" cannot target parameter (allowed targets: method, property, class constant)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target parameter (allowed targets: method) in Standard input code on line 3
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target parameter (allowed targets: method, property) in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  Attribute "Override" cannot target parameter (allowed targets: method, property, class constant) in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": null,
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 38,
                        "end": 38
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 50,
                          "end": 52
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Override"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 40,
                              "end": 48
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 40,
                            "end": 48
                          }
                        }
                      ],
                      "span": {
                        "start": 38,
                        "end": 52
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
